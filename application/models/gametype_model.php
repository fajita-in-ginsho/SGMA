<?php

class Gametype_Model extends My_IDModel {
	
    
    public static $TYPE_SHOGI = "Shogi";
    public static $TYPE_BADMINTON = "Badminton";
    
	function __construct(){
		parent::__construct('gametype');
	}
	
	function getByName($name){
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("name = '$name'");
	    $query = $this->db->get();
	     
	    if($query->num_rows() == 1){
	        return $query->row();
	    }else if($query->num_rows() > 1){
	        error_log("name should be unique in " . $this->table);
	    }
	}
}

?>
