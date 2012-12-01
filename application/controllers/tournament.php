
<?php
require_once(APPPATH .'/core/my_usersessioncontroller.php'); 
require_once(APPPATH .'/models/tournament_group_chart_model.php');

class Tournament extends My_UserSessionController{

	function __construct(){
		parent::__construct();
	}
	
	function open(){
	    
	    // additional columns
	    // attribute you can add has to be either users or paticipants.
	    
	    $is_ajax_request = (isset($_GET['ajax']) && $_GET['ajax'] === 'true');

	    $additionalColumnsInFront = array();
	    $additionalColumnsInBack = array();
	    
	    if($is_ajax_request){
	        $cup_name = $_GET['cup'];
	        $tournament_name = $_GET['tournament'];
            if(isset($_GET['additionalColumnsInFront'])){
                $additionalColumnsInFront = split('~', $_GET['additionalColumnsInFront']);
            }
            if(isset($_GET['additionalColumnsInBack'])){
                $additionalColumnsInBack = split('~', $_GET['additionalColumnsInBack']);
            }
	    }else{
	        $cup_name = urldecode($this->uri->segment(3));
		    $tournament_name = urldecode($this->uri->segment(4));
	    }
	    
		// get tournament id
		$tournament_id = $this->tournaments_model->getIdByNames(
			$cup_name, $tournament_name
		);
		
		if(isset($tournament_id) && $tournament_id != -1){
			
			$data['tournament'] = $this->tournaments_model->getById($tournament_id);
			$data['games'] = $this->games_model->getByTournamentId($tournament_id);
			$data['chart'] = new Tournament_Group_Chart_Model($tournament_id, $additionalColumnsInFront, $additionalColumnsInBack);
            $data['json_data'] = json_encode($data);
			if($is_ajax_request){
			    if($data['tournament']->type == "Group"){
			        $this->load->view('tournaments/gruop_tournament_form_json', $data);
			    }else if($data['tournament']->type == "Knock-out"){
			        $this->load->view('tournaments/gruop_tournament_form_json', $data);
			    }else{
			        $this->load->view('tournaments/gruop_tournament_form_json', $data);
			    }
			}else{
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
	    
	    $is_ajax_request = (isset($_POST['ajax']) && $_POST['ajax'] === 'true');
	    
	    if($is_ajax_request){
	        $tournamentId = $_POST['tournamentId'];
	        $field = $_POST['field'];
	        $field = $_POST['value'];
	    }else{
	        
	    }
	    
	    // TODO:
	}
}

?>	