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
		$games = array();
		if($query->num_rows() > 0){
			$games = $query->result();
		}
		return $games;
	}
	
	function getByUserIdForTournament($userId, $tournamentId){
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
		$query = $this->db->query($stmt);
		$games = array();
		if($query->num_rows() > 0){
			$games = $query->result();
		}
		return $games;
	}
	
	// return object
	function getById($gameId){
	
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
	 $stmt = "
	    SELECT g.`date` AS `date` FROM `games` AS g
        WHERE g.id = $gameId;
	    ";
	    $query = $this->db->query($stmt);
	    if($query->num_rows() == 1){
	        $a = $query->row();
	        return $a->date;
	    }
	}
	
}

?>
