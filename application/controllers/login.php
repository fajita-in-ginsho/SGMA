<?php

class Login extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		
	}
	
	function index($retry=false){
		$data['main_content'] = 'login_form';
		$data['title'] = 'Login';
		$data['retry'] = $retry;
		$this->load->view('includes/template', $data);
	}
	
	function validate_credentials(){
		if($this->users_model->validate()){
			$data = array(
			    'username'=> $this->input->post('username')
			  , 'userId' => $this->users_model->getIdByUsername($this->input->post('username'))    
			  , 'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			
			redirect('site/home'); 
		}else{
			$this->index(true);
		}
	}
	
	function signup(){
		$data['main_content'] = "signup_form";
		$data['title'] = 'Sign up';
		$this->load->view('includes/template', $data);
	}
	
	/**
	 * 
	 */
	function create_member(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'trim|required|matches[password]');
		
		if($this->form_validation->run()==FALSE){
			$data['main_content'] = 'signup_form';
			$data['title'] = 'Sign up';
			$this->load->view('signup_form');
		}else{
			// insert data in users table.
			
			$insert_data_users = array(
				'first_name' => $this->input->post('first_name')
			  , 'last_name' => $this->input->post('last_name')
			  , 'username' => $this->input->post('username')
			  , 'password' => $this->input->post('password')
			  , 'email_address' => $this->input->post('email_address')
			);
			
			$user_id = $this->users->insert($insert_data_users);
			
			$data['main_content'] = 'signup_successful_page';
			$data['title'] = 'Signup Succeeded!';
			$this->load->view('includes/template', $data);
		}
			
	
	}
	
	function logout(){
		$this->session->unset_userdata('is_logged_in');
		$this->session->sess_destroy();
		$data['main_content'] = 'logout_successful_page';
		$data['title'] = 'Logged out!';
		$this->load->view('includes/template', $data);
	}
	
}

?>
