<?php

class GameResult_Model extends My_IDModel {
	
    private static $WIN = "Won";
    private static $LOSE = "Lost";
    private static $DRAW = "Draw";
    private static $DEFAULT_WIN = "Default Win";
    private static $NOT_YET_PLAYED = "Not Yet Played";
    
	function __construct(){
		parent::__construct('gameresult');
	}
	
	
	function getIdByDescription($description){
	    
	    $this->db->select('id');
	    $this->db->from($this->table);
	    $this->db->where("description = '$description'");
	    $query = $this->db->get();
	    
	    if($query->num_rows() == 1){
	        return $query->row()->id;
	    }
	}
	
	function getOpponentResultId($gameResultId){
	    $gameResult = $this->getById($gameResultId);
	    
	    switch($gameResult->description){
	        case self::$WIN : $opponentGameResultDescription = self::$LOSE; break;
	        case self::$LOSE : $opponentGameResultDescription = self::$WIN; break;
	        case self::$DRAW : $opponentGameResultDescription = self::$DRAW; break;
	        case self::$DEFAULT_WIN : $opponentGameResultDescription = self::$LOSE; break;
	        case self::$NOT_YET_PLAYED : $opponentGameResultDescription = self::$NOT_YET_PLAYED; break;
	    }
	    
	    if(isset($opponentGameResultDescription)){
	        $opponentGameResultId = $this->getIdByDescription($opponentGameResultDescription);
	        return $opponentGameResultId;
	    }
	}
    
	function getById($id){
	    
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("id = $id");
	    $query = $this->db->get();
	    
	    if($query->num_rows() == 1){
	        return $query->row();
	    }
	}
}

?>
