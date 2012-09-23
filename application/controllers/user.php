
<?php 
require_once(APPPATH .'/core/my_usersessioncontroller.php');

class User extends My_UserSessionController{

	function __construct(){
		parent::__construct();
		$this->isLoggedIn();
	}
	
	function open($username){
	    $retrieved_username = urldecode($this->uri->segment(3));
	    //echo "get the $gameId information and returned!";
	    
	    $is_ajax_request = false;
	    if(isset($_GET['ajax']) && $_GET['ajax']){
	        $is_ajax_request = true;
	    }else{
	        $is_ajax_request = false;
	    }
	    
	    if(isset($_GET['username'])){
	        $data['username'] = $_GET['username'];
	    }
	    
	    $userId = $this->users_model->getIdByUsername($username);
	    $data['user'] = $this->users_model->getById($userId);
	    
	    $data['no_games_past'] = 3;
	    $data['games_past'] = $this->players_model->getGamesByUserId($userId, "AND r.description != 'Not Yet Played'");
	    $data['no_games_future'] = 3;
	    $data['games_future'] = $this->players_model->getGamesByUserId($userId, "and r.description = 'Not Yet Played'");
	    
	    $data['main_content'] = 'user_form';
	    $data['title'] = "About " . $data['user']->username;
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
	
	
}


?>
