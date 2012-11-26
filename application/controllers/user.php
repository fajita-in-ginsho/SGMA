
<?php 
require_once(APPPATH .'/core/my_usersessioncontroller.php');

class User extends My_UserSessionController{

	function __construct(){
		parent::__construct();
	}
	
	function open($username){
	    $is_ajax_request = (isset($_GET['ajax']) && $_GET['ajax'] === 'true');
	    if($is_ajax_request){
	        $data['username'] = $_GET['username'];
	    }else{
	        $data['username'] = urldecode($this->uri->segment(3));
	    }
	    
	    $userId = $this->users_model->getIdByUsername($username);
	    $data['user'] = $this->users_model->getById($userId);
	    
	    $data['no_games_past'] = 3;
	    $data['games_past'] = $this->players_model->getGamesByUserId($userId, "r.description != 'Not Yet Played'");
	    $data['no_games_future'] = 3;
	    $data['games_future'] = $this->players_model->getGamesByUserId($userId, "r.description = 'Not Yet Played'");
	    
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
