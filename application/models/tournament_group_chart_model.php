<?php
require_once(APPPATH .'/core/my_idmodel.php');
require_once(APPPATH .'helpers/active_record_helper.php');
require_once(APPPATH .'helpers/standard_helper.php');


class Tournament_Group_Chart_Model extends My_IDModel {
	
	public $tournamentId;
	public $participants = array();
	public $columns = array();
	public $rows = array();
	public $width;
	public $height;
	
	private $db_columns;
	private $header_height = 30;
	private $single_row_height = 50;
	private $base_width= 120;
	private $single_column_width = 50;
	
	function __construct($tournamentId){
	    
	    $this->tournamentId = $tournamentId;
	    $this->participants = $this->participants_model->getByTournamentId($tournamentId);
		$this->height = $this->header_height;
		$notAvailablePath = $this->gameresult_model->getPathByDescription(GameResult_Model::$NOT_AVAILABLE);
		
		// filling $this->columns which are coverted to structure of grid in client side.
		// get info about which column should be created from database, the info includes name, field, width, formatter and editable attributres.
		$this->db_columns = $this->tournament_columns_model->getColumnsByTournamentId($tournamentId);
		if(!isset($this->db_columns)){
		    $this->db_columns = $this->tournament_columns_model->getColumnsByTournamentId(Tournament_Columns_Model::$DEFALT_ID);
		}
		foreach($this->db_columns as $col){
		    if($col->field == 'participants'){
		        foreach($this->participants as $participant){
		            $column_info = array();
		            $column_info['field'] = $participant->username;
		            $column_info['name'] = $participant->username;
		            if(isset($col->width)) $column_info['width'] = $col->width;
		            if(isset($col->formatter)) $column_info['formatter'] = $col->formatter;
		            if(isset($col->editable)) $column_info['editable'] = ((bool)$col->editable?"true":"false");
		            if(isset($col->style)) $column_info['style'] = $col->style;
		            $this->columns[]= $column_info;
		        }        
		    }else{
		        $column_info = array();
		        $column_info['field'] = $col->field;
		        $column_info['name'] = $this->lang->line($col->name);
		        if(isset($col->width)) $column_info['width'] = $col->width;
		        if(isset($col->formatter)) $column_info['formatter'] = $col->formatter; 
		        if(isset($col->editable)) $column_info['editable'] = ((bool)$col->editable?"true":"false");
		        if(isset($col->style)) $column_info['style'] = $col->style;
		        $this->columns[]= $column_info;
		    }
		}
		
		// get total width
		$this->width = $this->parse_column_totol_width();
		
		
		
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
				$row["score"] = sumInQueryResult($chart_data, "score");
				$row["order"] = 0;

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
		
		$this->parse_order();
	}
	
	function parse_order(){
	    $copied_rows = $this->rows;
	    // sort by score.
	    usort($copied_rows, array($this, 'cmp_by_score_desc'));
	    $cur_score = -1;
	    $order = 0;
	    $increment = 1;
	    foreach($copied_rows as &$row){
	        if($cur_score == $row["score"]){
	            $increment++;
	        }else{
	            $order += $increment;
	            $increment = 1;
	        }
	        $row["order"] = $order;
	        $cur_score = $row["score"]; 
	    }
	    
	    foreach($this->rows as &$row){
	        $tmp = searchFromArrayOfArray($copied_rows, 'username', $row['username'], 'order');
	        if(isset($tmp)){
	            $row['order'] = $tmp;
	        }
	    }
	}
	
	private function cmp_by_score_desc($row_a, $row_b){
	    // if $a is larger than $b, return positive int.
	    // else if equal return 0
	    // else return negative int.
	    // score would be sorted as 10, 9, 7, 3, 1, 1 0 after sorting with desc.
	    $key = 'score';
	    if($row_a[$key] < $row_b[$key]){
	        return 1;
	    }else if($row_a[$key] == $row_b[$key]){
	        return 0;
	    }else{
	        return -1;
	    }
	}
	
	function parse_column_totol_width(){
	    // TODO: it only can take pixel, but other unit...
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
	    
	    // $tournamentId_resultscore is used to get resultscore join
	    $tournamentId_resultscore = -1; // default
	    $resultscore = $this->resultscore_model->getByTournamentId($this->tournamentId);
	    if(isset($resultscore)){
	        $tournamentId_resultscore = $this->tournamentId;
	    }
	    
	    foreach($this->db_columns as $col){
	        if(isset($col->sql)){
	            $this->db->select($col->sql);
	        }
	    }
	    
	    $this->db->select("opp.username AS opponent_username");
        $this->db->select("g.id AS gameId");
        $this->db->select("r.path AS result_path");
        $this->db->select("r.description AS result_description");
        $this->db->select("rs.score AS score");
        //$this->db->select("p_you.note AS note");
        
	    $this->db->from('tournaments AS t');
	    $this->db->join('participants AS p_you', 'p_you.tournamentId = t.id');
	    $this->db->join('users AS you', "p_you.userId = you.id AND you.username = '$username'");
	    $this->db->join('participants AS p_opp', 'p_opp.tournamentId = t.id');
	    $this->db->join('users AS opp', 'p_opp.userId = opp.id AND opp.id != you.id');
	    $this->db->join('games AS g', 'g.tournamentId = t.id');
	    $this->db->join('players AS ply_you', 'ply_you.gameId = g.id AND ply_you.userId = you.id');
	    $this->db->join('players AS ply_opp', 'ply_opp.gameId = g.id AND ply_opp.userId = opp.id');
	    $this->db->join('gameresult AS r', 'ply_you.gameResultId = r.id');
	    $this->db->join('country AS c', 'c.country_id = you.nationalityId', 'left');
	    $this->db->join('timezones AS tm', 'tm.id = you.timezoneId', 'left');
	    // hacky way to prevent automatic backticks
	    $this->db->_protect_identifiers = false;
	    $this->db->join('resultscore AS rs', "rs.tournamentId = {$tournamentId_resultscore} AND rs.gameresultId = r.id");
	    $this->db->_protect_identifiers = true;
	    
	    $this->db->where("t.id = $this->tournamentId");
	    $this->db->order_by('username');
	    
	    $query = $this->db->get();
	    // DEBUGGING
	    //$stmt = $this->db->_compile_select();
	    $stmt = $this->db->last_query();
	    error_log("get_game_result_for " .$username . "=>" . $stmt);
	    if($query->num_rows() > 0){
	        return $query->result();
	    }
	    
	}
}

?>
