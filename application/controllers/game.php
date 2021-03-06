
<?php 
require_once(APPPATH .'/core/my_usersessioncontroller.php');
require_once(APPPATH .'/models/gameinfo_model.php');

class Game extends My_UserSessionController{

	function __construct(){
		parent::__construct();
	}
	
	function open($gameId){
	    $gameId = urldecode($this->uri->segment(3));
	    
	    $is_ajax_request = false;
	    if(count($_GET) > 0){
	        $is_ajax_request = ($_GET['ajax'] === 'true');
	        if(isset($gameId)){
	            $gameId = $_GET['gameId'];
	        }   
	    }
	    
	    if(isset($_GET['username_of_selected_row'])){
	        $data['username_of_selected_row'] = $_GET['username_of_selected_row']; 
	    }
	    if(isset($_GET['username_of_selected_column'])){
	        $data['username_of_selected_column'] = $_GET['username_of_selected_column'];
	    }
	    $game = $this->games_model->getById($gameId);
	    $gameinfoObj = new Gameinfo_Model($gameId);
	    $gameinfo = $gameinfoObj->getById($game->gameInfoId);
	    $kifu = $this->kifu_model->getById($gameinfo->kifuId);
	    $kifuId = (isset($kifu)) ? $kifu->id : -1;
	    $players = $this->players_model->getByGameId($gameId);
	    $tournament = $this->tournaments_model->getById($game->tournamentId);
	    
	    $data['main_content'] = 'game_form';
	    $data['title'] = $game->name;
	    $data['game'] = $game;
	    $data['players'] = $players;
	    $data['tournament'] = $tournament;
	    $data['kifuId'] = $kifuId;
	    $data['copyright'] = false; // see footer.php
	    $data['isLoggedIn'] = $this->isLoggedIn();
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
	    
	    if(!isset($gameId)){
	        $gameId = urldecode($this->uri->segment(3));
	    }
	    
	    $is_ajax_request = false;
	    if(count($_GET) > 0){
	        $is_ajax_request = ($_GET['ajax'] === 'true');
	        if(!isset($gameId)){
	            $gameId = $_GET['gameId'];
	        }
	        $data['username_of_selected_row'] = $_GET['username_of_selected_row'];
	        $data['userId_of_selected_row'] = $this->users_model->getIdByUsername($data['username_of_selected_row']);
	        
	        $data['username_of_selected_column'] = $_GET['username_of_selected_column'];
	        $data['userId_of_selected_column'] = $this->users_model->getIdByUsername($data['username_of_selected_column']);
 
	    }
        
	    if($this->session->userdata('userId') == $data['userId_of_selected_row'] ||
	       $this->session->userdata('userId') == $data['userId_of_selected_column']
	     /* || $this->organizers_model->isAuthorized($this->session->userdata('userId'), $tournamentId)*/ ){
	         
            $game = $this->games_model->getById($gameId);
            //$players = $this->players_model->getByGameId($gameId);
            $tournament = $this->tournaments_model->getById($game->tournamentId);
            $row_user = $this->users_model->getById($data['userId_of_selected_row']);
            $row_user_player = $this->players_model->getByGameIdAndUserId($gameId, $data['userId_of_selected_row']);
            $row_result = $this->gameresult_model->getById($row_user_player->gameResultId);
            
            $data['selected'] = $this->lang->line('tournament_not_yet_played');
            $gameResultDescriptions = array(
                $this->lang->line('tournament_win') => $this->lang->line('tournament_win'),
                $this->lang->line('tournament_lose') => $this->lang->line('tournament_lose'),
                $this->lang->line('tournament_draw') => $this->lang->line('tournament_draw'),
                $this->lang->line('tournament_default_win') => $this->lang->line('tournament_default_win'),
                $this->lang->line('tournament_default_lose') => $this->lang->line('tournament_default_lose'),
                $this->lang->line('tournament_not_yet_played') => $this->lang->line('tournament_not_yet_played')
            );
            if(isset($row_result)){
                $data['selected'] = $row_result->description;
            }
            
            $data['main_content'] = 'game_result_form';
            $data['title'] = 'Game Result';
            $data['game'] = $game;
            $data['gameResultDescriptions'] = $gameResultDescriptions;
            //$data['players'] = $players;
            $data['tournament'] = $tournament;
            $data['copyright'] = false; // see footer.php
            $data['kifu_url'] = $this->gameinfoshogi_model->getURL($game->gameInfoId);
            // in this case, return text.html response in both ajax and non-ajax request.
            if($is_ajax_request){
                $data['isAjax'] = "true";  // MEMO: passing boolean could not be retrieved in javascript side.
                $this->load->view('includes/template', $data);
            }else{
                $data['isAjax'] = "false";
                $this->load->view('includes/template', $data);
            }
	     
	    }else{
	        echo $this->lang->line('error_no_permission_to_change_game_result');
	    }
	}
	
    function inputResult($gameId){
	    
	    $isUpdateResult = true;
	    $isUpdateURL = true;
	    $is_ajax_request = false;
	    
	    if(count($_GET) > 0){
	        $is_ajax_request = ($_GET['ajax'] === 'true');
	        if(!isset($gameId)){
	            $gameId = $_GET['gameId'];
	        }
	    }
	    
	    if(isset($_GET['isResultChanged']) && $_GET['isResultChanged'] == "true"){
	        if(isset($_GET['username_of_selected_row'])){
	            $username_of_selected_row = $_GET['username_of_selected_row'];
	            $userId_of_selected_row = $this->users_model->getIdByUsername($username_of_selected_row);
	        }
	        if(isset($_GET['username_of_selected_column'])){
	            $username_of_selected_column = $_GET['username_of_selected_column'];
	            $userId_of_selected_column = $this->users_model->getIdByUsername($username_of_selected_column);
	        }
	        if(isset($_GET['gameResultDescription'])){
	            $gameResultDescription = $_GET['gameResultDescription'];
	            $gameResultId = $this->gameresult_model->getIdByDescription($gameResultDescription);
	        }
	         
	        $isUpdateResult = $this->players_model->updateGameResult($gameId, $userId_of_selected_row, $gameResultId);
	    }
	    
	    if(isset($_GET['isURLChanged']) && $_GET['isURLChanged'] == "true"){
	        $game = $this->games_model->getById($gameId);
	        $isUpdateURL = $this->gameinfoshogi_model->updateURL($game->gameInfoId, $_GET['kifuURL']);
	    }

	    $data['success'] = ($isUpdateResult && $isUpdateURL) ? 'true' : 'false';
	    echo json_encode($data);
	}
}


?>
