
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
	    if(isset($_GET['username_of_selected_row'])){
	        $data['username_of_selected_row'] = $_GET['username_of_selected_row']; 
	    }
	    if(isset($_GET['username_of_selected_column'])){
	        $data['username_of_selected_column'] = $_GET['username_of_selected_column'];
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
	
	function result($gameId){
	    $retrieved_gameId = urldecode($this->uri->segment(3));
	     
	    $is_ajax_request = false;
	    if(isset($_GET['ajax']) && $_GET['ajax']){
	        if(isset($_GET['gameId'])){
	            $gameId_from_context = $_GET['gameId'];
	        }
	        $is_ajax_request = true;
	    }
	    if(isset($_GET['username_of_selected_row'])){
	        $data['username_of_selected_row'] = $_GET['username_of_selected_row'];
	    }
	    if(isset($_GET['username_of_selected_column'])){
	        $data['username_of_selected_column'] = $_GET['username_of_selected_column'];
	    }
	    $game = $this->games_model->getById($gameId);
	    $players = $this->players_model->getByGameId($gameId);
	    $tournament = $this->tournaments_model->getById($game->tournamentId);
	     
	    $data['main_content'] = 'game_result_form';
	    $data['title'] = 'Game Result';
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
	
	function inputResult($gameId){
	
	    $is_ajax_request = false;
	    if(isset($_POST['ajax']) && $_POST['ajax']){
	        if(isset($_POST['gameId'])){
	            $gameId = $_POST['gameId'];
	        }
	        $is_ajax_request = true;
	    }
	    
	    if(isset($_POST['username_of_selected_row'])){
	        $username_of_selected_row = $_POST['username_of_selected_row'];
	        $userId_of_selected_row = $this->users_model->getIdByUsername($username_of_selected_row);
	    }
	    if(isset($_POST['username_of_selected_column'])){
	        $username_of_selected_column = $_POST['username_of_selected_column'];
	        $userId_of_selected_column = $this->users_model->getIdByUsername($username_of_selected_column);
	    }
	    if(isset($_POST['gameResultDescription'])){
	        $gameResultDescription = $_POST['gameResultDescription'];
	        $gameResultId = $this->gameresult_model->getIdByDescription($gameResultDescription);
	    }
	    
	    echo $this->players_model->updateGameResult($gameId, $userId_of_selected_row, $gameResultId);
	}
}


?>
