
<?php 

class Tournament extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->isLoggedIn();
	}
	
	function open(){
		$data['cup_name'] = urldecode($this->uri->segment(3));
		$data['tournament_name'] = urldecode($this->uri->segment(4));
		
		// get tournament id
		$data['tournament_id'] = $this->tournaments_model->getIdByNames($data['cup_name'], $data['tournament_name']);
		$this->load->model('tournament_model');
		if(isset($data['tournament_id']) && $data['tournament_id'] != -1){
			
			$this->tournament_model->initialize($data['tournament_id']);
			$data['tournament_obj'] = $this->tournament_model;
			//$data['tournament_obj'] = new Tournament_Model();
			//$data['tournament_obj'].initialize($data['tournament_id']);
			//$data['games'] = $this->games_model->getByTournamentId($data['tournament_id']);
			// get columns info
			
			// TODO: dynamically select a tournament form.
			// get participants info
			if($data['tournament_obj']->data['tournamentType'] == "Group"){
				$data['main_content'] = 'tournaments/gruop_tournament_form';
			}else if($data['tournament_obj']->data['tournamentTypeId'] == "Group"){
				$data['main_content'] = 'tournaments/gruop_tournament_form';
			}else{
				redirect("site/goToHome");
			}
			
			$data['title'] = $data['cup_name'] . $data['tournament_name'];
			$this->load->view('includes/template', $data);
		}else{
			redirect("site/goToHome");
		}
		
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