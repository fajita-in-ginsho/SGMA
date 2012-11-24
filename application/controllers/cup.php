
<?php
require_once(APPPATH .'/core/my_usersessioncontroller.php'); 
require_once(APPPATH .'/models/tournament_group_chart_model.php');

class Cup extends My_UserSessionController{

	function __construct(){
		parent::__construct();
	}
	
	function createForm(){
	    
	    $data['main_content'] = 'cup_create_form';
	    $data['title'] = 'Cup Tournament';
	    $data['copyright'] = true; 
        $this->load->view('includes/template', $data);
	    
	}
	
	function create(){
	     
	    $cup_name = $this->input->post('cup_name');
	    
	    $cup = $this->cups_model->getByName($cup_name);
	    if(isset($cup)){
	        // show error
	        // the cup is already defined.
	    }else{
            $replace_content = array(
                      "name" => $cup_name
                    , "createdBy" => $this->session->userdata('userId')
                    , "createdOn" => date( 'Y-m-d H:i:s' )
            );
            $this->cups_model->replace($replace_content);
	        redirect('site/home');
	    }
	}
}

?>	