<?php

class Players_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('players');
	}
	
	
	/*
	 * function : getByGameId
	 * description : get players whose gameId matches with the given gameId
	 * 
	 *  gameId : gameId
	 *  return : array of object
	 */
	function getByGameId($gameId){
	    
	    $this->db->select('`players`.`gameId` AS `gameId`
        , `players`.`userId` AS `userId`
        , `users`.`username` AS `username`
        , `players`.`gameResultId` AS `gameResultId`
        , `gameresult`.`description` AS `gameResult`', false);
	    $this->db->from('players');
	    $this->db->join('users', 'users.id = players.userId');
	    $this->db->join('gameresult', 'gameresult.id = players.gameResultId');
	    $this->db->where("players.gameId = $gameId");
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return $query->result();
	    }else{
	        return array();
	    }
	}
	
	function getByGameIdAndUserId($gameId, $userId){
	     
	    $this->db->select('*');
	    $this->db->from('players');
	    $this->db->where("gameId = $gameId");
	    $this->db->where("userId = $userId");
	    $query = $this->db->get();
	    if($query->num_rows() == 1){
	        return $query->row();
	    }
	}
	
	
	/*
	 * function : updateGameResult
	 * description : gameId the gameResult of the given gameId.
	 *               gameResult for the given user to the given gameResultId and then,
	 *               update the opponent gameResult accordingly.
	 *
	 *  gameId : gameId
	 *  $userId : $userId of the user which you want to update the result by the given gameResultId
	 *  $gameResultId : gameResult
	 *  return : true if succeeded.
	 */
	function updateGameResult($gameId, $userId, $gameResultId){
	    if($this->updateGameResultOfAUser($gameId, $userId, $gameResultId)){
	        $gameResultId_for_opponent = $this->gameresult_model->getOpponentResultId($gameResultId);
	        $opponentUsers = $this->getOpponentUserId($gameId, $userId);
	        foreach($opponentUsers as $opponentUser){
	            if($this->updateGameResultOfAUser($gameId, $opponentUser->userId, $gameResultId_for_opponent)==FALSE){
	                return FALSE;
	            }
	        }
	        return TRUE;
	    }
	    return FALSE;
	}
	
	private function updateGameResultOfAUser($gameId, $userId, $gameResultId){
	    
	    $data = array('gameResultId' =>$gameResultId);
	    $this->db->where('gameId', $gameId);
	    $this->db->where('userId', $userId);
	    return $this->db->update('players', $data);
	            
	}
    
	function getOpponentUserId($gameId, $userId){
	    
	    $this->db->select('*');
	    $this->db->from('players');
	    $this->db->where("players.gameId = $gameId");
	    $query = $this->db->get();
	    
	    $opponents = array();
	    if($query->num_rows() > 0){
	        foreach($query->result() as $row){
	            if($row->userId != $userId){
	                array_push($opponents, $row);   
	            }
	        }
	    }
	    return $opponents;
	}
	
	function getGamesByUserId($userId, $whereClause){
	    // WORKAROUND: if name are same in multi tables, it overwrite the value with the last attribute.
	    // therefore, it explicitly specify the name with AS clause.
	    
	    $this->db->select('
	      p.gameId AS `p_gameId`
        , p.userId AS `p_userId`
        , p.gameResultId AS `p_gameResultId`
        , g.id AS `g_id`
        , g.name AS `g_name`
        , g.tournamentId AS `g_tournamentId`
        , g.gameTypeId AS `g_gameTypeId`
        , g.`date` AS `g_date`
        , g.`threadId` AS `g_threadId`
        , g.`gameInfoId` AS `g_gameInfoId`
        , r.`id` AS `r_id`
        , r.`description` AS `r_description`
        , t.`id` AS `t_id`
        , t.`name` AS `t_name`
        , t.`tournamentTypeId` AS `t_tournamentTypeId`
        , t.`cupId` AS `t_cupId`
        , t.`createdBy` AS `t_createdBy`
        , t.`createdOn` AS `t_createdOn`
	    ', false);
	    $this->db->from('players AS p');
	    $this->db->join('games AS g', 'g.id = p.gameId');
	    $this->db->join('gameresult AS r', 'r.id = p.gameResultId');
	    $this->db->join('tournaments AS t', 't.id = g.tournamentId');
	    $this->db->where("p.userId = $userId");
	    
	    if(isset($whereClause)){
	        $this->db->where($whereClause);
	    }
	    
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return $query->result();
	    }
    }
}
?>
