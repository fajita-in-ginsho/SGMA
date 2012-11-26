<?php 
require_once(BASEPATH . '/core/Controller.php');

class My_UserSessionController extends CI_Controller {
	
    function __construct(){
		parent::__construct();
		$this->lang->load('tournament');
		$this->lang->load('error');
		$this->lang->load('home');
	}
	
	function redirectNeedToLoginPageIfNotLoggedIn(){
		if(!$this->isLoggedIn()){
			$this->loadNeedToLoginPage();
		}
	}
	
	function loadNeedToLoginPage(){
	    $this->lang->load('error');
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

}

?>
