
<?php 
require_once(APPPATH .'/core/my_usersessioncontroller.php');

class Game extends My_UserSessionController{

	function __construct(){
		parent::__construct();
		$this->isLoggedIn();
	}
	
	function open($gameId){
	    $retrieved_gameId = urldecode($this->uri->segment(3));
	    //echo "get the $gameId information and returned!";
	    
	    $is_ajax_request = false;
	    if(isset($_GET['ajax']) && $_GET['ajax']){
	        if(isset($_GET['gameId'])){
	            $gameId_from_context = $_GET['gameId'];
	        }
	        $is_ajax_request = true;
	    }
	    if(isset($_GET['username'])){
	        $data['username'] = $_GET['username']; 
	    }
	    $game = $this->games_model->getById($gameId);
	    $players = $this->players_model->getByGameId($gameId);
	    $tournament = $this->tournaments_model->getById($game->tournamentId);
	    
	    $data['main_content'] = 'game_form';
	    $data['title'] = $game->name;
	    $data['game'] = $game;
	    $data['players'] = $players;
	    $data['tournament'] = $tournament;
	    $data['copyright'] = false; // see footer.php
	    // in this case, return text.html response in both ajax and non-ajax request.
	    if($is_ajax_request){
	        $data['isAjax'] = "true";  // MEMO: passing boolean could not be retrieved in javascript side.
	        $this->load->view('includes/template', $data);
	    }else{
	        $data['isAjax'] = "false";
	        $this->load->view('includes/template', $data);
	    }
	}
	
}


?>	