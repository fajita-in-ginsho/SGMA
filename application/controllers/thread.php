
<?php 
require_once(APPPATH .'/core/my_usersessioncontroller.php');
require_once(APPPATH .'helpers/conv_js_to_php.php');


class Thread extends My_UserSessionController{

	function __construct(){
		parent::__construct();
		$this->redirectNeedToLoginPageIfNotLoggedIn();
	}
	
	function open($threadId){

	    $is_ajax_request = false;
	    if(count($_POST) > 0){
	        $is_ajax_request = ($_POST['ajax'] === 'true');
	        $threadId = $_POST['threadId'];
	        $data['username_of_selected_row'] = $_POST['username_of_selected_row'];
	        $data['username_of_selected_column'] = $_POST['username_of_selected_column'];
	    }
	    
	    if(!$is_ajax_request){
	        $threadId = urldecode($this->uri->segment(3));
	    }
	    
	    $data['main_content'] = 'thread_form';
	    $data['title'] = 'History Thread';
	    $orderBy['attr'] = 'createdOn';
	    $orderBy['order'] = 'DESC';
	    $data['comments'] = $this->comments_model->getCommentsByThreadId($threadId, $orderBy);
	    $data['copyright'] = false; // see footer.php
	    // in this case, return text.html response in both ajax and non-ajax request.
	    if($is_ajax_request){
	        $data['isAjax'] = "true";  // MEMO: passing boolean could not be retrieved in javascript side.
	        $this->load->view('includes/template', $data);
	    }else{
	        $data['isAjax'] = "false";
	        $this->load->view('includes/template', $data);
	    }
	}
	
	
	function addComment($threadId){
	    
	    $is_ajax_request = false;
	    if(count($_POST) > 0){
	        $is_ajax_request = ($_POST['ajax'] === 'true');
	        $threadId = $_POST['threadId'];
	        $data['comment'] = $_POST['comment'];
	        $result['comment'] = $data['comment'];
	        $data['gameId'] = $_POST['gameId'];
	    }
	     
	    if(!$is_ajax_request){
	        $threadId = urldecode($this->uri->segment(3));
	    }
	    
	    
	    // if threadId is -1 , create one and get the threadId.
	    if($threadId == -1){
	        // TBD: it's okay(easier) to always create thread as you create a new game.
	        // then I dont need code below.
	        $createdId = $this->thread_model->create($this->session->userdata('userId'));
	        if(isset($createdId)){
	            $threadId = $createdId;
	        }
	        if($threadId != -1){
	            $update_dataset = array('threadId' => $threadId);
	            $this->games_model->updateForId($data['gameId'], $update_dataset);
	        }
	    }
	    
	    $data['threadId'] = $threadId;
	    
	    if($threadId != -1){
	        // add comment on the given threadId
	        $data['commentId'] = $this->comments_model->add($threadId, $data['comment'], $this->session->userdata('userId'));
	        if(isset($data['commentId'])){
	            
	            $commentObj = $this->comments_model->getById($data['commentId']);
	            $userObj = $this->users_model->getById($commentObj->createdBy);
	            $data['commentOn'] = $commentObj->createdOn;
	            $data['username'] = $userObj->username;
	            $data['result'] = true;
	        } else{
	            $data['result'] = false;
	        }
	    }else{
	        $data['result'] = false;
	    }
	     
	    
	    $json_result = json_encode($data);
	    echo $json_result;
	}
	
	function changeDateForm(){

	    $is_ajax_request = false;
	    if(count($_GET) > 0){
	        $is_ajax_request = ($_GET['ajax'] === 'true');
	        $data['gameId'] = $_GET['gameId'];
	    }
	    
	    $data['main_content'] = 'thread_change_date_form';
	    $data['title'] = 'Change Date Form';
	    $data['copyright'] = false; // see footer.php
	    
	    //TODO: get current game date/time, so that default value can be set.
	    $data['current_date'] = $this->games_model->getById($data['gameId']);
	    $data['current_time'] = $data['current_date'];
	    // in this case, return text.html response in both ajax and non-ajax request.
	    if($is_ajax_request){
	        $data['isAjax'] = "true";  // MEMO: passing boolean could not be retrieved in javascript side.
	        $this->load->view('includes/template', $data);
	    }else{
	        $data['isAjax'] = "false";
	        $this->load->view('includes/template', $data);
	    }
	}
	
	function requestChangeDate(){
	    // TODO: interantinalize lanuage
	    $is_ajax_request = (isset($_GET['ajax']) && $_GET['ajax'] === 'true');
	    
	    if($is_ajax_request){
	        $data['gameId'] = $_GET['gameId'];
	        $data['datetime'] = ConvJsToPhp::jsDateToPhp(json_decode($_GET['datetime']));
	        $requesting_date = $data['datetime'];
	        $data['threadId'] = $_GET['threadId'];
	    }else{
	        $data['gameId'] = urldecode($this->uri->segment(3));
	        $data['datetime'] = urldecode($this->uri->segment(4));
	        $data['threadId'] = urldecode($this->uri->segment(5));
	    }
	    $data['gameId'] = $_GET['gameId'];
	    
	    $game = $this->games_model->getById($data['gameId']);
	    //$data['current_date'] = $this->games_model->getDate($data['gameId']);
	    $current_date = $game->date;
	    $data['tournamentId'] = $game->tournamentId;
	    
	    if(!isset($game)){
	        // error
	        return;
	    }
	    
	    // send email to opponent and admins.
	    // get related people
	    // users is associative array. key is userId, val is user
	    $users = $this->players_model->getByGameId($game->gameId);
	    foreach($users as $user){
	        $users_info[$user->userId] = $this->users_model->getById($user->userId);
	    }
	    $tournament = $this->tournaments_model->getById($game->tournamentId);
	    $creator = $this->users_model->getById($tournament->createdBy);
	    if(isset($creator)){
	        $users_info[$creator->id] = $creator;
	    }
	    
	    // exclude me.
	    $user_me = $this->users_model->getById($this->session->userdata('userId'));
	    unset($users_info[$user_me->id]);
	    
	    $commentChangeRequest = "I changed the date of the game
	    from  $current_date to $requesting_date.
	    ";
	    $this->comments_model->add($data['threadId'], $commentChangeRequest, $this->session->userdata('userId'));
	    
	    $ret = true;
	    // send emails.
	    foreach($users_info as $user_info){
	        // send it to the user.
	        
	        $to = $user_info->email_address;
	        $from = $user_me->email_address;
	        $subject = "Reqeust for Game date by $user_info->username";
	        
	        $site_url_approve = site_url("thread/approveChangeDate");
	        $site_url_disapprove = site_url("thread/disapproveChangeDate");
	        
	        $message = '<html><body>';
            $message .= "
	        Dear $user_info->username, <br>
	        
	        The game between you and $user_me->username has changed as following.<br>
	        
	        Before  : $current_date <br>
	        and Now : $requesting_date <br>
	        "
	        ;
	        $message .= '</body></html>';
	        $additional_header = "";
	        //$additional_header .= "From: " . $from . "\r\n";
	        $additional_header .= "MIME-Version: 1.0\r\n";
	        $additional_header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	        
	        
	        if(mail($to, $subject, $message, $additional_header)){
	            // successfully sent
	        }else{
	            // error to send.
	            $commentEmailNotSend = "Error detected while sending email to $user_info->username 
	            at $user_info->email_address.
	            ";
	            $this->comments_model->add($data['threadId'], $commentEmailNotSend, $this->users_model->getIdByUsername("admin"));
	            $ret = false;
	            break;
	        }
	        
	    }
	    
	    $update_dataset = array(
	        'date' => $requesting_date
	    );
	    $this->games_model->updateForId($data['gameId'], $update_dataset);
	    
	    if($is_ajax_request){
	        echo $ret;
	    }else{
	        echo $ret;
	    }
	}
	
	
}


?>




