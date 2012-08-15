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
	
	    $stmt = "
	    SELECT 
        `players`.`gameId` AS `gameId`
        , `players`.`userId` AS `userId`
        , `users`.`username` AS `username`
        , `players`.`gameResultId` AS `gameResultId`
        , `gameresult`.`description` AS `gameResult`
        FROM `players`
        , `users`
        , `gameresult`
        WHERE players.gameId = $gameId
        AND `users`.id = `players`.`userId`
        AND `gameresult`.id = `players`.`gameResultId`
        ";
	    $query = $this->db->query($stmt);
	    if($query->num_rows() > 0){
	        return $query->result();
	    }else{
	        return array();
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
	    $stmt = "
	    UPDATE `players` AS ply SET
	    ply.gameResultId = $gameResultId
	    WHERE ply.gameId = $gameId
	    AND ply.userId = $userId
	    ";
	    // write query such as update returns TRUE on success, FALSE if fails.
	    return $this->db->query($stmt);
	}
    
	function getOpponentUserId($gameId, $userId){
	$stmt = "
	    SELECT 
        *
        FROM `players`
        WHERE `players`.`gameId` = $gameId
        ";
	    $query = $this->db->query($stmt);
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
}

?>
