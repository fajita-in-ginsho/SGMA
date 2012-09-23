<?php
require_once(APPPATH .'/core/my_idmodel.php');
require_once(APPPATH .'helpers/active_record_helper.php');

class Tournament_Group_Chart_Model extends My_IDModel {
	
	public $tournamentId;
	public $participants = array();
	public $columns = array();
	public $rows = array();
	public $width;
	public $height;
	private $base_width= 120; // 12 px
	private $header_height = 30; // 12 px
	private $single_row_height = 20; // 12 px
	
	function __construct($tournamentId, $participants, $additionalColmns=array()){
		$this->tournamentId = $tournamentId;
		$this->participants = $participants;
		$this->height = $this->header_height;
		
		// creating colums info
		array_push($this->columns, array("name"=>"User Name", "field"=>"username", "width"=>"80px"));
		if(count($additionalColmns) > 0){
		    $this->columns = array_merge($this->columns, $additionalColmns);
		}
		array_push($this->columns, array("name"=>"Win", "field"=>"win", "width"=>"30px"));
		array_push($this->columns, array("name"=>"Loss", "field"=>"loss", "width"=>"30px"));
		array_push($this->columns, array("name"=>"Points", "field"=>"points", "width"=>"50px"));
		foreach($this->participants as $participant){
			array_push($this->columns
			        , array("name"=> $participant->username
			              , "field"=>$participant->username
			              , "width"=>"50px"
			              , "formatter"=>"imageFormatter"
			          )
			        );
		}
		array_push($this->columns, array("name"=>"Note", "field"=>"note"));
		
		// creating rows info
		foreach($this->participants as $participant){
			$games = $this->games_model->getByUserIdForTournament(
					$participant->userId, $this->tournamentId
			);
			$row = array();
			if(count($games) > 0){
				$row["username"] = $games[0]->companionUsername;
				$row["win"] = 0;
				$row["loss"] = 0;
				$row["points"] = 0;
				$row["note"] = "";
				
				foreach($this->participants as $participant){
					$companionGameResult = searchFromQueryResult($games, "opponentUsername", $participant->username, "companionGameResult");
					$gameId = searchFromQueryResult($games, "opponentUsername", $participant->username, "gameId");
					if(!isset($companionGameResult)){
					    $companionGameResult = "-";
					}else{
					    // eg. kunio_gameId is the column name and its value is gameId. 
					    $row[$participant->username . "_gameId"] = $gameId;
					}
					//$row[$participant->username] = $companionGameResult;
					if($companionGameResult == -1){
					    $row[$participant->username] = base_url("images/notyetplayed.png");
					}else if($companionGameResult == 0){
					    $row[$participant->username] = base_url("images/win.png");
					}else if($companionGameResult == 1){
					    $row[$participant->username] = base_url("images/lose.png");
					}else if($companionGameResult == 2){
					    $row[$participant->username] = base_url("images/draw.png");
					}else if($companionGameResult == 3){
					    $row[$participant->username] = base_url("images/defaultwin.png");
					}else{
					    $row[$participant->username] = base_url("images/unknown.png");
					}
					
				}
			}
			array_push($this->rows, $row);
			// $gamesで必要なとこだけ抽出、rowsにいれる。
			$this->height += $this->single_row_height;
		}
		
		$this->width = $this->parse_column_totol_width();
	}
	
	function parse_column_totol_width(){
	    $w = $this->base_width;
	    foreach($this->columns as $column){
	        if(isset($column['width'])){
	            $w += intval($column['width']); // intval returns 0 on failure, so it works fine.
	        }
	    }
	    return $w;
	}
}

?>
