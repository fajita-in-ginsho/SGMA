<?php
require_once(APPPATH .'/core/my_idmodel.php');
require_once(APPPATH .'helpers/active_record_helper.php');

class Tournament_Group_Chart_Model_Old extends My_IDModel {
	
	public $tournamentId;
	public $participants = array();
	public $columns = array();
	public $rows = array();
	public $width;
	public $height;
	private $base_width= 120; // 12 px
	private $header_height = 30; // 12 px
	private $single_row_height = 50; // 12 px
	
	function __construct($tournamentId, $additionalColmns=array()){
	    
		$this->tournamentId = $tournamentId;
		$this->participants = $this->participants_model->getByTournamentId($tournamentId);
		$this->height = $this->header_height;
		
		// creating colums info
		array_push($this->columns, array("name"=>"User Name", "field"=>"username", "width"=>"80px"));
		if(count($additionalColmns) > 0){
		    $this->columns = array_merge($this->columns, $additionalColmns);
		}
		array_push($this->columns, array("name"=>"Win", "field"=>"win", "width"=>"30px"));
		array_push($this->columns, array("name"=>"Lose", "field"=>"lose", "width"=>"30px"));
		array_push($this->columns, array("name"=>"Draw", "field"=>"draw", "width"=>"30px"));
		array_push($this->columns, array("name"=>"Rest", "field"=>"rest", "width"=>"30px"));
		array_push($this->columns, array("name"=>"Points", "field"=>"points", "width"=>"50px", "editable"=>"true", "formatter"=>"onChangePoints"));
		foreach($this->participants as $participant){
			array_push($this->columns
			        , array("name"=> $participant->username
			              , "field"=>$participant->username
			              , "width"=>"50px"
			              , "formatter"=>"imageFormatter"
			          )
			        );
		}
		
		// if you are the owner of this tournament or cup, make this filed editable!!
		array_push($this->columns, array("name"=>"Note", "field"=>"note", "width"=>"120px", "editable"=>"true", "formatter"=>"onChangeNotes"));
		
		// creating rows info
		foreach($this->participants as $participant){
			$games = $this->games_model->getByUserIdForTournament(
					$participant->userId, $this->tournamentId
			);
			$row = array();
			if(count($games) > 0){
				$row["username"] = $games[0]->companionUsername;
				$row["points"] = 0;
				$row["win"] = 0;
				$row["lose"] = 0;
				$row["draw"] = 0;
				$row["rest"] = 0;
				$row["note"] = "";
				
				if(count($additionalColmns) > 0){
				    foreach ($additionalColmns as $additonalColmn){
				        $row[$additonalColmn["field"]] = "";
				    }
				}
				
				foreach($this->participants as $participant){
					$companionGameResult = searchFromQueryResult($games, "opponentUsername", $participant->username, "companionGameResult");
					$gameId = searchFromQueryResult($games, "opponentUsername", $participant->username, "gameId");
					if(!isset($companionGameResult)){
					    $companionGameResult = -2;
					}else{
					    // eg. kunio_gameId is the column name and its value is gameId. 
					    $row[$participant->username . "_gameId"] = $gameId;
					}
					//$row[$participant->username] = $companionGameResult;
					if($companionGameResult == -1){
					    $row[$participant->username] = base_url("images/notyetplayed.png");
					}else if($companionGameResult == 0){
					    $row[$participant->username] = base_url("images/win.png");
					    $row["win"] += 1;
					}else if($companionGameResult == 1){
					    $row[$participant->username] = base_url("images/lose.png");
					    $row["lose"] += 1;
					}else if($companionGameResult == 2){
					    $row[$participant->username] = base_url("images/draw.png");
					    $row["draw"] += 1;
					}else if($companionGameResult == 3){
					    $row[$participant->username] = base_url("images/defaultwin.png");
					    $row["win"] += 1;
					}elseif($companionGameResult == -2){
					    $row[$participant->username] = base_url("images/notavailable.png");
					    $row["rest"] += 1;
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
