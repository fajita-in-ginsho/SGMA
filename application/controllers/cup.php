
<?php
require_once(APPPATH .'/core/my_usersessioncontroller.php'); 
require_once(APPPATH .'/models/tournament_group_chart_model.php');

class Cup extends My_UserSessionController{

	function __construct(){
		parent::__construct();
	}
	
	function createForm(){
	    
	    $gametypes = $this->gametype_model->getAll();
	    foreach($gametypes as $gametype){
	        $data['game_types'][$gametype->name] = $gametype->name;
	    }
	    
	    $data['main_content'] = 'cup_create_form';
	    $data['title'] = $this->lang->line('tournament_title_create_cup');
	    $data['copyright'] = true; 
        $this->load->view('includes/template', $data);
	    
	}
	
	
	function create(){

	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('cup_name', '', 'trim|required');
	    if($this->form_validation->run()==FALSE){
	        $this->loadErrorPage($this->lang->line('error_message_fail_creating_cup_name_empty'));
	    }else{
	        $cup_name = $this->input->post('cup_name');
	        $gametype_name = $this->input->post('gametype_name');
	         
	        $gametype = $this->gametype_model->getByName($gametype_name);
	        if(!isset($gametype)){
	            $this->loadErrorPage($this->lang->line('error_message_fail_creating_cup_gametype_invalid'));
	        }
	         
	        $cup = $this->cups_model->getByName($cup_name);
	        if(isset($cup)){
	            $this->loadErrorPage($this->lang->line('error_message_fail_creating_cup_name_already_exist'));
	        }else{
	            $replace_content = array(
	                      "name" => $cup_name
	                    , 'gameTypeId' => $gametype->id
	                    , "createdBy" => $this->session->userdata('userId')
	                    , "createdOn" => date( 'Y-m-d H:i:s' )
	            );
	            $this->cups_model->replace($replace_content);
	            redirect('site/home');
	        }    
	    }
	}
}

?>	