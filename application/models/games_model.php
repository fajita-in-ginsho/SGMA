<?php

class Games_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('games');
	}
	
	/*
	 * getByTournamentId
	 * 
	 * description: get all games for the given tournamentId.
	 *   
	 * return: array of an object
	 * 
	 */
	function getByTournamentId($tournamentId){
		
	    $this->db->select('games.id as `id`
                		 , games.name as `name`
                		 , games.date as `date`
                		 , games.threadId as `threadId`
                		 , gameinfoshogi.kifuId as `kifuId`');

		$this->db->from('games');
		$this->db->join('gameinfoshogi', 'games.gameInfoId = gameinfoshogi.id');
		$this->db->where("games.tournamentId = $tournamentId");
		$query = $this->db->get();
		
		$games = array();
		if($query->num_rows() > 0){
			$games = $query->result();
		}
		return $games;
	}
	
	function getByUserIdForTournament($userId, $tournamentId){
	    
		$this->db->select('
		  g.id as `gameId`
		, g.tournamentId as `tournamentId`
		, g.name as `gameName`
		, g.date as `gameDate`
		, g.threadId as `threadId`
		, companion_player.userId as `companionUserId`
		, companion_user.username as `companionUsername`
		, opponent_player.userId as `opponentUserId`
		, opponent_user.username as `opponentUsername`
		, companion_player.gameResultId as `companionGameResult`'
		, false);
		$this->db->from('games AS g');
		$this->db->join('players as companion_player', "companion_player.gameId = g.id and companion_player.userId = $userId");
		$this->db->join('players as opponent_player', "opponent_player.gameId = companion_player.gameId and opponent_player.userId != $userId");
		$this->db->join('users as companion_user', "companion_player.userId = companion_user.id");
		$this->db->join('users as opponent_user', "opponent_player.userId = opponent_user.id");
		$this->db->where("g.tournamentId = $tournamentId");
		$query = $this->db->get();
		
		$games = array();
		if($query->num_rows() > 0){
			$games = $query->result();
		}
		return $games;
	}
	
	/*
	 * updateFor
	 * update the context given by the $update_context for the give gameId in games table.
	 * $update_context is an array contains key as colum and value as its value. like below.
	 * $update_context = array(
               'title' => $title,
               'name' => $name,
               'date' => $date
            );
       
	 */
	function updateForId($gameId, $update_context){
	    $this->db->where('id', $gameId);
	    $succeeded = $this->db->update($this->table, $update_context);
	    return $succeeded;
	}
	
	function getDate($gameId){
	    
	    $this->db->select('g.`date` AS `date`', false);
	    $this->db->from('games AS g');
	    $this->db->where("g.id = $gameId");
	    $query = $this->db->get();
	    
	    if($query->num_rows() == 1){
	        $a = $query->row();
	        return $a->date;
	    }
	}
	
	function autoGenerateGames($tournament_id){
	    $tournament = $this->tournaments_model->getById($tournament_id);
	    $participants = $this->participants_model->getByTournamentId($tournament_id);
	    $gametype = $this->gametype_model->getById($tournament->gameTypeId);
        $defaultGameResultId = $this->gameresult_model->getIdByDescription(GameResult_Model::$NOT_YET_PLAYED);
	    
	    $entire_entries = array();
	    foreach($participants as $userA){
	        foreach($participants as $userB){
                if($userA == $userB){
                    break;
                }else{
                    $entire_entries[] = array($userA, $userB);
                }
	        }    
	    }
	    //$num_games = (count($participants) * (count($participants) -1)) / 2;
	    $num_games = count($entire_entries);
	    
	    foreach($entire_entries as $entry){
	    
	        // thread
	        $data = array(
                  'name'    => ''
                , "createdBy" => $this->session->userdata('userId')
                , "createdOn" => date( 'Y-m-d H:i:s' )
	        );
	        $threadId = $this->thread_model->insert($data);
	        
	        // kifu
	        $data = array(
                 "url" => ""
               , "kifuText" => ""
	        );
	        $kifuId = $this->kifu_model->insert($data);
	        
	        // gameinfo
	        $gameinfo_id = -1;
	        if($gametype->name == Gametype_Model::$TYPE_SHOGI){
	            $data = array(
                   'kifuId' => $kifuId
	            );
	            $gameinfo_id = $this->gameinfoshogi_model->insert($data);
	        }else{
	            // TODO
	            error_log("this game type is not yet supported!");
	        }
	        
	        // game
	        $data = array(
	                'name'    => '',
	                'tournamentId'    => $tournament->id,
	                'gameTypeId'    => $tournament->gameTypeId, 
	                'date' => date( 'Y-m-d H:i:s' ),
	                'threadId' => $threadId,
	                'gameInfoId' => $gameinfo_id,
	        );
	        $gameId = $this->insert($data);
	        
	        // players
	        foreach($entry as $user){
	            $data = array(
	                'gameId'    => $gameId
	              , 'userId'    => $user->userId
	              , 'gameResultId' => $defaultGameResultId
	            );
	            $playerId = $this->players_model->insert($data);
	        }
	    }
	}

}

?>
