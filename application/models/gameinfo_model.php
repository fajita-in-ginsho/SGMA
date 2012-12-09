<?php
require_once(APPPATH .'/core/my_idmodel.php');

class Gameinfo_Model extends My_IDModel {
	
    public static $GAMEINFO_TABLE_PREFIX = "gameinfo";
    
	function __construct($gameId){
	    if(isset($gameId)){
	        $table = $this->getGameInfoTableName($gameId);
	        parent::__construct($table);
	    }else{
	        error_log("do not autoload this funtion since it takes an argument.");
	        parent::__construct("");
	    }
	    
	}
	
	function getByGameId($gameId){
	    $game = $this->games_model->getById($gameId);
	    $gameInfoTableName = $this->getGameInfoTableName($gameId);
	    
	    return $this->$gameInfoTableName->getById($game->gameInfoId);
	}
	
	function getGameInfoTableName($gameId){
	    $game = $this->games_model->getById($gameId);
	    $gametype = $this->gametype_model->getById($game->gameTypeId);
	    $gameInfoSurfix = strtolower($gametype->name);
	    
	    return Gameinfo_Model::$GAMEINFO_TABLE_PREFIX . $gameInfoSurfix;
	}
}

?>
