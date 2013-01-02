<?php 
require_once(APPPATH .'/core/my_usersessioncontroller.php');

class Site extends My_UserSessionController{

	function __construct(){
		parent::__construct();
	}
	
	function home(){
	    $this->redirectNeedToLoginPageIfNotLoggedIn();
		$data['main_content'] = 'home_page';
		$data['title'] = 'Home';
		$data['username'] = $this->session->userdata('username');
		$userId = $this->users_model->getIdByUsername($data['username']);
		if(!isset($userId)){
		    $this->loadNeedToLoginPage();
		    return;
		}
		$data['hasAdminRight'] = $this->users_model->hasAdminRight($userId);
		
		$data['participating_tournaments'] = $this->tournaments_model->getByParticipantUserId($userId);
		if(!isset($data['participating_tournaments'])) $data['participating_tournaments'] = array();
		
		$data['administrable_tournaments'] = $this->tournaments_model->getByAdministratorUserId($userId);
		if(!isset($data['administrable_tournaments'])) $data['administrable_tournaments'] = array();
		
		$this->load->view('includes/template', $data);
	}
	
}


?>	