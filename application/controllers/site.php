<?php 

class Site extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->isLoggedIn();
	}
	
	function home(){
		$data['main_content'] = 'home_page';
		$data['title'] = 'Home';
		$data['username'] = $this->session->userdata('username');
		$userId = $this->users_model->getIdByUsername($this->session->userdata('username'));
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