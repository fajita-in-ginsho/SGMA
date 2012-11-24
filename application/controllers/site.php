<?php 
require_once(APPPATH .'/core/my_usersessioncontroller.php');

class Site extends My_UserSessionController{

	function __construct(){
		parent::__construct();
	}
	
	function home(){
		$data['main_content'] = 'home_page';
		$data['title'] = 'Home';
		$data['username'] = $this->session->userdata('username');
		$userId = $this->users_model->getIdByUsername($data['username']);
		if(!isset($userId)){
		    error_log("could not retrieve userId for {$data['username']}");
		    return;
		}
		$data['hasAdminRight'] = $this->users_model->hasAdminRight($userId);
		$data['tournaments'] = $this->tournaments_model->getByUserId($userId);
		$data['tournaments_json'] = json_encode($data['tournaments']);
		$this->load->view('includes/template', $data);
	}
	
	function tournament(){
		$data['tournament_name'] = $this->uri->segment(3);
		
		// get tournament id
		// get tournament type
		// TODO: dynamically select a tournament form.
		// get participants info
		// get games info.
		// get columns info
		$data['main_content'] = 'tournamets/gruop_tournament_form';
		$data['title'] = $data['tournament_name'];
		$this->load->view('includes/template', $data);
	}
	
}


?>	