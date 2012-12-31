<?php 
require_once(BASEPATH . '/core/Controller.php');

class My_UserSessionController extends CI_Controller {
	
    function __construct(){
		parent::__construct();
		$this->lang->load('main');
		$this->lang->load('tournament');
		$this->lang->load('error');
		$this->lang->load('home');
		$this->lang->load('app_email');
	}
	
	function redirectNeedToLoginPageIfNotLoggedIn(){
		if(!$this->isLoggedIn()){
			$this->loadNeedToLoginPage();
		}
	}
	
	function loadErrorPage($error_message){
	    $data['main_content'] = 'errors/error_message';
	    $data['title'] = $this->lang->line('error_title_message');
	    $data['copyright'] = true;
	    $data['error_message'] = $error_message;
	    $this->load->view('includes/template', $data);
	}
	
	function loadNeedToLoginPage(){
	    $data['main_content'] = 'errors/need_login';
	    $data['title'] = $this->lang->line('error_need_to_login');
	    $this->load->view('includes/template', $data);
	}
	
	function loadSessionExpiredPage(){
	    $data['main_content'] = 'errors/session_expired_page';
	    $data['title'] = $this->lang->line('error_no_permission_page_title');
	    $this->load->view('includes/template', $data);
	}
	
	function isLoggedIn(){
	    $is_logged_in = $this->session->userdata('is_logged_in');
	    if(isset($is_logged_in) && $is_logged_in == true){
	        
	    }else{
	        $is_logged_in = false;
	    }
	    return $is_logged_in;
	}
	
	function isNotifyEmail(){
	    $isNotify = true;
	    $email_notification = $this->session->userdata('email_notification');
	    if($email_notification == false){ // userdata returns false when it doesn't exist.
	        $isNotify = true;
	    }else if($email_notification == "true"){
	        $isNotify = true;
	    }else if($email_notification == "false"){
	        $isNotify = false;
	    }
	    return $isNotify;
	}

}

?>
