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
	
	private $header_height = 30;
	private $single_row_height = 50;
	private $base_width= 120;
	private $single_column_width = 50;
	private $additionalColumns;
	
	function __construct($tournamentId, $additionalColumnsInFront, $additionalColumnsInBack){
	    
	    $this->additionalColumns = $additionalColumnsInFront + $additionalColumnsInBack;
	    $this->tournamentId = $tournamentId;
		$this->participants = $this->participants_model->getByTournamentId($tournamentId);
		$this->height = $this->header_height;
		$notAvailablePath = $this->gameresult_model->getPathByDescription(GameResult_Model::$NOT_AVAILABLE);
		
		// ----------------------------
		// creating columns 
		// ----------------------------
		// TODO: get_game_result_for
		
		$this->columns[] =  array("name"=>$this->lang->line('tournament_column_username'), "field"=>"username", "width"=>"80px");
		$this->columns[] =  array("name"=>$this->lang->line('tournament_column_win'), "field"=>"win", "width"=>"30px");
		$this->columns[] =  array("name"=>$this->lang->line('tournament_column_lose'), "field"=>"lose", "width"=>"30px");
		$this->columns[] =  array("name"=>$this->lang->line('tournament_column_draw'), "field"=>"draw", "width"=>"30px");
		$this->columns[] =  array("name"=>$this->lang->line('tournament_column_rest'), "field"=>"rest", "width"=>"30px");
		
		foreach($additionalColumnsInFront as $additionalColmn){
		    // $additional colum has to be either in users or participants table.
		    // therefore, translation can be prepared in launguage folder.
		    $this->columns[] =  array("name"=>$this->lang->line('tournament_column_' . $additionalColmn), "field"=>$additionalColmn);
		}
		
		foreach($this->participants as $participant){
			$this->columns[] = array("name"=> $participant->username, "field"=>$participant->username
			              , "width"=>"50px", "formatter"=>"imageFormatter");
		}
		
		foreach($additionalColumnsInBack as $additionalColmn){
		    if($additionalColmn == "note"){
		        $this->columns[] =  array("name"=>$this->lang->line('tournament_column_' . $additionalColmn), "field"=>$additionalColmn
		                , "width"=>"120px", "editable"=>"true", "formatter"=>"onChangeNote");
		    }else{
		        $this->columns[] =  array("name"=>$this->lang->line('tournament_column_' . $additionalColmn), "field"=>$additionalColmn);
		    }
		}
		// get total width
		$this->width = $this->parse_column_totol_width();
		// ----------------------------
		
		
		// creating rows info
		foreach($this->participants as $row_user){
			$row = array();
			$chart_data = $this->get_game_result_for($row_user->username);
			
			if(count($chart_data) > 0){
			    
			    foreach($this->columns as $column){
			        try{
			            if(isset($chart_data[0]->$column['field'])){
			                $row[$column['field']] = $chart_data[0]->$column['field'];
			            }
			        }catch(Exception $e){
			            
			        }
			    }
			    
				$total_num_games = count($chart_data);
				$row["win"] = countInQueryResult($chart_data, "result_description", "Win");
				$row["lose"] = countInQueryResult($chart_data, "result_description", "Lose");
				$row["draw"] = countInQueryResult($chart_data, "result_description", "Draw");
				$row["rest"] = $total_num_games - ($row["win"] + $row["lose"]);

				foreach($this->participants as $column_user){
				    if($row_user->username == $column_user->username){
				        $row[$column_user->username] = base_url($notAvailablePath);
				    }else{
				        $result_path = searchFromQueryResult($chart_data, "opponent_username", $column_user->username, "result_path");
				        $gameId      = searchFromQueryResult($chart_data, "opponent_username", $column_user->username, "gameId");
				        
				        $row[$column_user->username] = base_url($result_path);
				        $row[$column_user->username . "_gameId"] = $gameId;
				    }
				}
			}
			array_push($this->rows, $row);
			$this->height += $this->single_row_height;
		}
	}
	
	function parse_column_totol_width(){
	    $w = $this->base_width;
	    foreach($this->columns as $column){
	        if(isset($column['width'])){
	            $w += intval($column['width']); // intval returns 0 on failure, so it works fine.
	        }else{
	            $w += $single_column_width;
	        }
	    }
	    return $w;
	}
	
	function get_game_result_for($username){
	    
	    $additionalColumnFragments = array();
	    foreach($this->additionalColumns as $additionalColumn){
	        if($this->users_model->hasAttribute($additionalColumn)){
	            $additionalColumnFragments[] = "you.$additionalColumn as $additionalColumn";
	        }else if($this->participants_model->hasAttribute($additionalColumn)){
	            $additionalColumnFragments[] = "p_you.$additionalColumn as $additionalColumn";
	        }
	    }
	    $additionalColumnClause = "";
	    if(count($additionalColumnFragments) > 0){
	        $additionalColumnClause = ", " . implode(", ", $additionalColumnFragments);
	    }
	    
	    // $tournamentId_resultscore is used to get resultscore join
	    $tournamentId_resultscore = -1; // default
	    $resultscore = $this->resultscore_model->getByTournamentId($this->tournamentId);
	    if(isset($resultscore)){
	        $tournamentId_resultscore = $this->tournamentId;
	    }
	    
	    $this->db->select(
	        "you.username AS username
            , c.short_name AS country
            , tm.timezone_location AS timezone
            , opp.username AS opponent_username
            , g.id AS gameId
            , r.path AS result_path
            , r.description AS result_description
            , rs.score AS score
            , p_you.note AS note" . $additionalColumnClause
	    , false);
	    $this->db->from('tournaments AS t');
	    $this->db->join('participants AS p_you', 'p_you.tournamentId = t.id');
	    $this->db->join('users AS you', "p_you.userId = you.id AND you.username = '$username'");
	    $this->db->join('participants AS p_opp', 'p_opp.tournamentId = t.id');
	    $this->db->join('users AS opp', 'p_opp.userId = opp.id AND opp.id != you.id');
	    $this->db->join('games AS g', 'g.tournamentId = t.id');
	    $this->db->join('players AS ply_you', 'ply_you.gameId = g.id AND ply_you.userId = you.id');
	    $this->db->join('players AS ply_opp', 'ply_opp.gameId = g.id AND ply_opp.userId = opp.id');
	    $this->db->join('gameresult AS r', 'ply_opp.gameResultId = r.id');
	    $this->db->join('country AS c', 'c.country_id = you.nationalityId');
	    $this->db->join('timezones AS tm', 'tm.id = you.timezoneId');
	    // hacky way to prevent automatic backticks
	    $this->db->_protect_identifiers = false;
	    $this->db->join('resultscore AS rs', "rs.tournamentId = {$tournamentId_resultscore} AND rs.gameresultId = r.id");
	    $this->db->_protect_identifiers = true;
	    
	    $this->db->where("t.id = $this->tournamentId");
	    $this->db->order_by('username');
	    
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return $query->result();
	    }
	}
}

?>
