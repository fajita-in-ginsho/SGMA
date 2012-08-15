
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
		    if(isset($_GET['cup'])){
		        $tournament_name = $_GET['tournament'];
		    }
		    
		    $is_ajax_request = true;
		}
		
		if(isset($tournament_id) && $tournament_id != -1){
			
			$data['tournament'] = $this->tournaments_model->getById($tournament_id);
			$data['participants'] = $this->participants_model->getByTournamentId($tournament_id);
			$data['games'] = $this->games_model->getByTournamentId($tournament_id);
			
			$additionalColmns = array(
			    array("name"=>"Additional", "field"=>"win", "width"=>"80px")
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
			        redirect("site/goToHome");
			    }
			    $data['title'] = $cup_name . $tournament_name;
			    $this->load->view('includes/template', $data);
			}
			
		}else{
		    if($is_ajax_request){
		        redirect("site/goToHome");
		    }
		}
		
	}
	
	function game($gameId){
	    $retrieved_gameId = urldecode($this->uri->segment(3));
	    echo "get the $gameId information and returned!";
	}

}


?>	