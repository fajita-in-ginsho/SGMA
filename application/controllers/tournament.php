
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

	    if($is_ajax_request){
	        $cup_name = $_GET['cup'];
	        $tournament_name = $_GET['tournament'];
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
			$data['chart'] = new Tournament_Group_Chart_Model($tournament_id);
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
	    
	    /* TODO-001:
	     * Be able to choose - as cup is not specified.
	     * if this is choosed, add gameType dropdown to choose.
	     */
	    //$data['cup_names']["-"] = "-";
	    $data['cup_names'] = array();
	    if(isset($cups)){
	        foreach($cups as $cup){
	            $data['cup_names'][$cup->name] = $cup->name;
	        }    
	    }else{
	        $this->loadErrorPage($this->lang->line('error_on_create_cup_no_cups_available'));
	        return;
	    }
	    
	    
	    $tournamentTypes = $this->tournamenttype_model->getAll();
	    foreach($tournamentTypes as $tournamentType){
	        $data['tournament_types'][$tournamentType->name] = $tournamentType->name;
	    }
        
	    $data['columns'] = $this->columns_model->getAll();
	    
	    $users = $this->users_model->getAll();
	    foreach($users as $user){
	        $data['usernames'][$user->username] = $user->username;
	    }
	    
	    $data['main_content'] = 'tournament_create_form';
	    $data['title'] = $this->lang->line('tournament_title_create_tournament');
	    $data['copyright'] = true; 
        $this->load->view('includes/template', $data);
	    
	}
	
	function callback_check_selected_cup($cup_name){
	    // TODO-001
	    if ($str == '-'){
	        $this->form_validation->set_message('callback_check_selected_cup', $this->lang->line('error_need_to_select_a_cup'));
	        return FALSE;
	    }else{
	        return TRUE;
	    }
	}
	
	function create(){
	    //TODO: 
	    // without timezone_set, it shows (maybe) britsh time by default.
	    //date_default_timezone_set('Asia/Tokyo');
	    
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('tournament_name', '', 'trim|required');
	    $this->form_validation->set_rules('cup_names', '', 'callback_check_selected_cup');
	    $this->form_validation->set_rules('tournament_types', '', 'required');
	    
	    
	    if($this->form_validation->run()==FALSE){
	        $this->loadErrorPage($this->lang->line('error_message_fail_creating_tournament'));
	    }else{
	        if($this->create_tournament_and_process()){
	            redirect("site/home");
	        }
	    }
	}
	
	private function create_tournament_and_process(){
	    
	    $tournament_name = $this->input->post('tournament_name');
	    $cup_name = $this->input->post('cup_names');
	    $tournament_type = $this->input->post('tournament_types');
	    $cup = $this->cups_model->getByName($cup_name);
	    $tournament_type = $this->tournamenttype_model->getByName($tournament_type);
	    $usernames = $this->input->post('participants');
	     
	    if(!isset($tournament_type)){
	        $data['error_message'] = $this->lang->line('error_tournament_type_invalid');
	        return;
	    } 
	    
	    $gametype_name = $this->input->post('gametype_name');
	    $gametype_id = -1;
	    if($gametype_name != false){ // this->input->post return false when value is not set in $_POST
	        // TODO-001
	        $gametype = $this->gametype_model->getByName($gametype_name);
	        if(!isset($gametype)){
	            $this->loadErrorPage($this->lang->line('error_message_fail_creating_cup_gametype_invalid'));
	            return;
	        }
	        $gametype_id = $gametype->id; 
	    }else{
	        $gametype_id = $cup->gameTypeId;
	    }
	    
        $content = array(
              "name" => $tournament_name
            , "tournamentTypeId" => $tournament_type->id
            , "cupId" => (isset($cup) ? $cup->id : -1)
            , "gameTypeId" => $gametype_id
            , "createdBy" => $this->session->userdata('userId')
            , "createdOn" => date( 'Y-m-d H:i:s' )
        );
        
        $tournament_id = $this->tournaments_model->insert($content);
        if(!isset($tournament_id)){
            $this->loadErrorPage($this->lang->line('error_failed_to_create_touranment_database'));
            return;
        }
        
        $column_fileds = array();
        $prefix = 'columns_in_chart_';
        foreach($_POST as $key => $val){
            if(preg_match('/^' . $prefix . '(\w+)/', $key, $matches) == true){
                $column_fileds[] = $matches[1];
            }
        } 
        
        // if columns is NOT default set of columns, create entries in tournament_colomns.
        if(!$this->columns_model->isDefaultSetOfColumns($column_fileds)){
            $this->tournament_columns_model->replaceSetOfColumns($tournament_id, $column_fileds);
        }
        
        // set $usernames
        $this->participants_model->replaceParticipants($tournament_id, $usernames);
        
        // generate games for this tournament according to the participants automatically.
        // TODO: gameTypeId should inhrite from cup, tournmaent , then game..
        $this->games_model->autoGenerateGames($tournament_id);
        
        return true;
	} 
	
	
	
	function update(){
	    
	    $is_ajax_request = (isset($_POST['ajax']) && $_POST['ajax'] === 'true');
	    
	    if($is_ajax_request){
	        $tournamentId = $_POST['tournamentId'];
	        $username = $_POST['username'];
	        $userId = $this->users_model->getIdByUsername($username);
	        $field = $_POST['field'];
	        $value = $_POST['value'];
	    }else{
	        
	    }
	    
	    if($field == "note"){
	        $context = array(
	            "note" => $value
	        );
	        $succeeded = $this->participants_model->update($tournamentId, $userId, $context);
	        if($succeeded == true){
	            $ret = json_encode(array('success' => 'true'));
	            echo $ret;
	            return;
	        }
	    }
	    $ret = json_encode(array('success' => 'false'));
        echo $ret;
        return;
	}
	
}

?>	