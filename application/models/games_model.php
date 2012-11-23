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
		/*
		$stmt = "
			select 
			game.id as `id`
			, game.name as `name`
			, game.date as `date`
			, game.threadId as `threadId`
			, info.kifuId as `kifuId`
			from games as `game`
			left join gameinfoshogi as `info`
			on game.id = info.gameId
			where
			game.tournamentId = $tournamentId 
		";
		$query = $this->db->query($stmt);
		*/

		$this->db->select('games.id as `id`
                		 , games.name as `name`
                		 , games.date as `date`
                		 , games.threadId as `threadId`
                		 , gameinfoshogi.kifuId as `kifuId`');

		$this->db->from('games');
		$this->db->join('gameinfoshogi', 'games.id = gameinfoshogi.gameId');
		$this->db->where("games.tournamentId = $tournamentId");
		$query = $this->db->get();
		
		$games = array();
		if($query->num_rows() > 0){
			$games = $query->result();
		}
		return $games;
	}
	
	function getByUserIdForTournament($userId, $tournamentId){
	    /*
		$stmt = "
		select
		 g.id as `gameId`
		, g.tournamentId as `tournamentId`
		, g.name as `gameName`
		, g.date as `gameDate`
		, g.threadId as `threadId`
		, companion_player.userId as `companionUserId`
		, companion_user.username as `companionUsername`
		, opponent_player.userId as `opponentUserId`
		, opponent_user.username as `opponentUsername`
		, companion_player.gameResultId as `companionGameResult`
		from
		  games as g
		, players as companion_player
		, players as opponent_player
		, users as companion_user
		, users as opponent_user
		where g.tournamentId = $tournamentId AND
		companion_player.gameId = g.id and
		opponent_player.gameId = companion_player.gameId AND
		companion_player.userId = $userId AND
		opponent_player.userId != $userId and 
		companion_player.userId = companion_user.id AND
		opponent_player.userId = opponent_user.id
	
		order by `opponentUserId`
		;
		";
		*/
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
	
	// return object
	function getById($gameId){
	    /*
	    $stmt = "
	    SELECT 
          g.id AS `gameId`
        , g.tournamentId AS `tournamentId`
        , g.name AS `name`
        , g.date AS `date`
        , g.threadId AS `threadId`
        , IF(info.kifuId IS NULL, -1, info.kifuId) AS `kifuId`
        FROM
        `games` AS g
        LEFT JOIN `gameinfoshogi` AS info
        ON g.id = info.gameId
        AND g.gameTypeId = info.gameTypeId
        WHERE g.id = $gameId;
	    ";
	    $query = $this->db->query($stmt);
	    */
	    
	    /*
	    You can call the select method with FALSE as the last parameter, like this
	    That will prevent CI to add the `
	    */
	    $this->db->select('
	      g.id AS `gameId`
        , g.tournamentId AS `tournamentId`
        , g.name AS `name`
        , g.date AS `date`
        , g.threadId AS `threadId`
        , IF(info.kifuId IS NULL, -1, info.kifuId) AS kifuId'
	    , false);
	    $this->db->from('games AS g');
	    $this->db->join('gameinfoshogi AS info', 'g.id = info.gameId', 'LEFT');
	    $this->db->where("g.id = $gameId");
	    $query = $this->db->get();
	    
	    if($query->num_rows() == 1){
	        return $query->row();
	    }
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
	    /*
	    $stmt = "
	    SELECT g.`date` AS `date` FROM `games` AS g
        WHERE g.id = $gameId;
	    ";
	    */
	    $this->db->select('g.`date` AS `date`', false);
	    $this->db->from('games AS g');
	    $this->db->where("g.id = $gameId");
	    $query = $this->db->get();
	    
	    if($query->num_rows() == 1){
	        $a = $query->row();
	        return $a->date;
	    }
	}
	
}

?>
