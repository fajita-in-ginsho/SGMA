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

}

?>
