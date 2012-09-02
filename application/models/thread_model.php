<?php

class Thread_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('thread');
	}
	
	// return object
	function getById($id){
	
	    $stmt = "
	    SELECT 
         *
        FROM `thread`
        WHERE `id` = $id
	    ;
	    ";
	    $query = $this->db->query($stmt);
	    if($query->num_rows() == 1){
	        return $query->row();
	    }
	}
	
	function create($userId){
	    $id = -1;
	    
	    $stmt = "
	    insert into `thread` (name, createdBy, createdOn)
	    values ('', $userId, Now())
	    ;
	    ";
	    
	    if($this->db->query($stmt)){
	        // if successfully inserted, return the id.
	        $inserted_id = $this->db->insert_id();
	        return $inserted_id;
	    }
	}
    
}

?>
