
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
	            
	            // send emails to notify related peoples.
	            ///*
	            $game = $this->games_model->getById($data['gameId']);
	            $mailers = $this->get_mailers($game);
	            foreach($mailers['receivers'] as $user_receiver){
	                if($this->mail_add_comment($mailers['sender'], $user_receiver, $data['comment']) == false){
	                    // email error.
	                    $comment = "
    	                    $this->lang->line('app_email_fail_to_send')
    	                    $user_receiver->username ( $user_receiver->email_address )
	                    ";
	                    $this->comments_model->add($data['threadId'], $comment, $this->users_model->getIdByUsername("admin"));
	                }
	            }
	            //*/
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

	    $is_ajax_request = (isset($_GET['ajax']) && $_GET['ajax'] === 'true');
	    
	    if($is_ajax_request){
	        $data['gameId'] = $_GET['gameId'];
	        $data['datetime'] = ConvJsToPhp::jsDateToPhp(json_decode($_GET['datetime']));
	        $data['threadId'] = $_GET['threadId'];
	    }else{
	        $data['gameId'] = urldecode($this->uri->segment(3));
	        $data['datetime'] = urldecode($this->uri->segment(4));
	        $data['threadId'] = urldecode($this->uri->segment(5));
	    }
	    
	    $game = $this->games_model->getById($data['gameId']);
	    $data['current_date'] = $game->date;
	    $data['tournamentId'] = $game->tournamentId;
	    
	    if(!isset($game)){
	        // error
	        return;
	    }
	    
	    // send email to opponent and admins.
	    // get related people
	    $mailers = $this->get_mailers($game);
	    
	    // send emails.
	    foreach($mailers['receivers'] as $user_receiver){
	        if($this->mail_change_date($mailers['sender'], $user_receiver, $data['current_date'], $data['datetime']) == false){
	            
	            // mail error.
	            $comment = "
    	            $this->lang->line('tournament_comment_change_date_mail_error')
    	            $user_receiver->username ( $user_receiver->email_address )
	            ";
	            $this->comments_model->add($threadId, $comment, $this->users_model->getIdByUsername("admin"));
	        }
	    }
	    
	    $comment = $this->lang->line('tournament_comment_change_date_beginning') .
            	    " ". $this->lang->line('tournament_comment_change_date_from') . " " . 
            	    "{$data['current_date']}" .
            	    " ". $this->lang->line('tournament_comment_change_date_beginning') . " ". 
            	    "{$data['datetime']}";

	    $this->comments_model->add($data['threadId'], $comment, $this->session->userdata('userId'));
	    
	    $update_dataset = array(
	        'date' => $data['datetime']
	    );
	    $this->games_model->updateForId($data['gameId'], $update_dataset);
	    
	}
	
	/*
	 * get user obj of sender as 'sender' and
	 * get user obj of receivers as 'recievers' and return as array.
	 * note that receiver is plural.
	 */
	function get_mailers($game){
	    
	    $players = $this->players_model->getByGameId($game->id);
	    
	    foreach($players as $player){
	        $users_obj[$player->userId] = $this->users_model->getById($player->userId);
	    }
	     
	    // creator is admin
	    $tournament = $this->tournaments_model->getById($game->tournamentId);
	    $creator = $this->users_model->getById($tournament->createdBy);
	    if(isset($creator)){
	        $users_obj[$creator->id] = $creator;
	    }
	    
	    // TODO: email to organizers is TODO
	     
	    // exclude me.
	    $user_me = $this->users_model->getById($this->session->userdata('userId'));
	    unset($users_obj[$user_me->id]);
	    
	    return array('sender' => $user_me, 'receivers' => $users_obj);
	}
	
	function mail_change_date($user_sender, $user_receiver, $current_date, $current_date){
	     
	    $to = $user_receiver->email_address;
	    $from = $user_sender->email_address;
	    $subject = $this->lang->line('app_email_change_date_subject') . $user_sender->username;
	    
	    $message = "
    	    <html><body>
    	    {$this->lang->line('app_email_dear')} $user_receiver->username, 
            <br>
    	    $user_sender->username {$this->lang->line('app_email_change_date_message')}  
    	    <br>
    	    {$this->lang->line('app_email_before')} $current_date
    	    <br> 
    	    {$this->lang->line('app_email_after')}  $requesting_date 
    	    <br>
    	    </body></html>
	    ";
	    
	    $additional_header = "";
	    //$additional_header .= "From: " . $from . "\r\n";
	    $additional_header .= "MIME-Version: 1.0\r\n";
	    $additional_header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	     
	     
	    if(mail($to, $subject, $message, $additional_header)){
	        // successfully sent
	        $ret = true;
	    }else{
	        $ret = false;
	    }
	    return $ret;
	}
	
	function mail_add_comment($user_sender, $user_receiver, $comment){
	    
	    $to = $user_receiver->email_address;
	    $from = $user_sender->email_address;
	    $subject = $this->lang->line('app_email_add_comment_subject') . $user_sender->username;
	     
	    $message = "
    	    <html><body>
    	    {$this->lang->line('app_email_dear')} $user_receiver->username,
    	    <br>
    	    $user_sender->username {$this->lang->line('app_email_add_comment_message')}
    	    <br>
    	    <br>
    	    $comment
    	    <br>
    	    </body></html>
	    ";
	     
	    $additional_header = "";
	    //$additional_header .= "From: " . $from . "\r\n";
	    $additional_header .= "MIME-Version: 1.0\r\n";
	    $additional_header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	    
	    
	    if(mail($to, $subject, $message, $additional_header)){
    	    // successfully sent
    	    $ret = true;
	    }else{
	        $ret = false;
	    }
	    return $ret;
	}
	
}


?>




