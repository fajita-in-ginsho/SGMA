
<?php
require_once(APPPATH .'/core/my_usersessioncontroller.php'); 
require_once(APPPATH .'/models/tournament_group_chart_model.php');

class Tournament extends My_UserSessionController{

	function __construct(){
		parent::__construct();
		$this->isLoggedIn();
	}
	
	function open(){
		$cup_name = urldecode($this->uri->segment(3));
		$tournament_name = urldecode($this->uri->segment(4));
		
		// get tournament id
		$tournament_id = $this->tournaments_model->getIdByNames(
			$cup_name, $tournament_name
		);
		
		$is_ajax_request = false;
		if(isset($_GET['ajax']) && $_GET['ajax']){
		    if(isset($_GET['cup'])){
		        $cup_name = $_GET['cup'];
		    }
		    if(isset($_GET['tournament'])){
		        $tournament_name = $_GET['tournament'];
		    }
		    
		    $is_ajax_request = true;
		}
		
		if(isset($tournament_id) && $tournament_id != -1){
			
			$data['tournament'] = $this->tournaments_model->getById($tournament_id);
			$data['participants'] = $this->participants_model->getByTournamentId($tournament_id);
			$data['games'] = $this->games_model->getByTournamentId($tournament_id);
			
			$additionalColmns = array(
			    array("name"=>"Additional", "field"=>"additional", "width"=>"80px")
			);
			$chart = new Tournament_Group_Chart_Model($tournament_id, $data['participants'], $additionalColmns);
			$data['chart'] = $chart;
			$data['chart_json_file'] = 'tournament_view.json';
            $response['json'] = json_encode($data);
			if($is_ajax_request){
			    if($data['tournament']->type == "Group"){
			        $this->load->view('tournaments/gruop_tournament_form_json', $response);
			    }else if($data['tournament']->type == "Knock-out"){
			        $this->load->view('tournaments/gruop_tournament_form_json', $response);
			    }else{
			        $this->load->view('tournaments/gruop_tournament_form_json', $response);
			    }
			}else{
			    $fp = fopen('tournament_view.json', 'w');
			    fwrite($fp, json_encode($data));
			    fclose($fp);
			    	
			    // ajax が有効であればこのページの特定の場所に、そうでなければ新しいページに
			    if($data['tournament']->type == "Group"){
			        $data['main_content'] = 'tournaments/gruop_tournament_form';
			    }else if($data['tournament']->type == "Knock-out"){
			        $data['main_content'] = 'tournaments/gruop_tournament_form';
			    }else{
			        redirect("site/home");
			    }
			    $data['title'] = $cup_name . $tournament_name;
			    $this->load->view('includes/template', $data);
			}
			
		}else{
		    if($is_ajax_request){
		        redirect("site/home");
		    }
		}
	}
	
	function createForm(){
	    
	    $cups = $this->cups_model->getAll();
	    // for loop makes array of id
	    $data['cup_names']["-"] = "-";
	    foreach($cups as $cup){
	        $data['cup_names'][$cup->name] = $cup->name;
	    }
	    
	    $tournamentTypes = $this->tournamenttype_model->getAll();
	    foreach($tournamentTypes as $tournamentType){
	        $data['tournament_types'][$tournamentType->name] = $tournamentType->name;
	    }

	    $data['main_content'] = 'tournament_create_form';
	    $data['title'] = 'Create Tournament';
	    $data['copyright'] = true; 
        $this->load->view('includes/template', $data);
	    
	}
	
	function create(){
	    //TODO:
	    // without timezone_set, it shows (maybe) britsh time by default.
	    //date_default_timezone_set('Asia/Tokyo');
	    
	    $tournament_name = $this->input->post('tournament_name');
        $cup_name = $this->input->post('cup_names');
        $tournament_type = $this->input->post('tournament_types');
        
        $cup = $this->cups_model->getByName($cup_name);
        $tournament_type = $this->tournamenttype_model->getByName($tournament_type);
        if(isset($tournament_type)){
            $replace_content = array(
                    "id" => 0
                    , "name" => $tournament_name
                    , "tournamentTypeId" => $tournament_type->id
                    , "cupId" => (isset($cup) ? $cup->id : -1)
                    , "createdBy" => $this->session->userdata('userId')
                    , "createdOn" => date( 'Y-m-d H:i:s' )
            );
            //$this->db->set('createdOn', 'Now()', false);
            $this->tournaments_model->replace($replace_content);
        }else{
            // TODO:
            // show fadeout small dialog for error
        }
        redirect('site/home');
	    
	}
	
	function update(){
	    $is_ajax_request = false;
	    if(isset($_POST['ajax']) && $_POST['ajax']){
	        if(isset($_POST['tournamentId'])){
	            $tournamentId = $_POST['tournamentId'];
	        }
	        if(isset($_POST['field'])){
	            $field = $_POST['field'];
	        }
	        if(isset($_POST['value'])){
	            $field = $_POST['value'];
	        }
	        $is_ajax_request = true;
	    }
	    
	}
}

?>	