<?php 
require_once(BASEPATH . '/core/Controller.php');

class My_UserSessionController extends CI_Controller {
	
    function __construct(){
		parent::__construct();
		$this->isLoggedIn();
	}
	
	function isLoggedIn(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(isset($is_logged_in) && $is_logged_in == true){
			
		}else{
			$data['main_content'] = 'errors/session_expired_page';
			$data['title'] = 'Expired!';
			$this->load->view('includes/template', $data);
		}
	}

}

?>
