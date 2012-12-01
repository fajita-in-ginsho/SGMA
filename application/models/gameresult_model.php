<?php

class GameResult_Model extends My_IDModel {
	
    public static $WIN = "Won";
    public static $LOSE = "Lost";
    public static $DRAW = "Draw";
    public static $DEFAULT_WIN = "Default Win";
    public static $NOT_YET_PLAYED = "Not Yet Played";
    public static $NOT_AVAILABLE = "Not Available";
    public static $UNKNOWN = "Unknown";
    
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
	    $opponentGameResultId = $gameResultId;
	    $gameResult = $this->getById($gameResultId);
	    
	    switch($gameResult->description){
	        case self::$WIN : $opponentGameResultDescription = self::$LOSE; break;
	        case self::$LOSE : $opponentGameResultDescription = self::$WIN; break;
	        case self::$DRAW : $opponentGameResultDescription = self::$DRAW; break;
	        case self::$DEFAULT_WIN : $opponentGameResultDescription = self::$LOSE; break;
	        default: $opponentGameResultDescription = $gameResult->description; break;
	    }
	    
	    if(isset($opponentGameResultDescription)){
	        $opponentGameResultId = $this->getIdByDescription($opponentGameResultDescription);
	    }
	    return $opponentGameResultId;
	}
    
	function getPathByDescription($description){
	    $this->db->select('path');
	    $this->db->from($this->table);
	    $this->db->where("description = '$description'");
	    $query = $this->db->get();
	    
	    if($query->num_rows() == 1){
	        return $query->row()->path;
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
