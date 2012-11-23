<?php

class Thread_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('thread');
	}
	
	// return object
	function getById($id){
	    
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("id = $id");
	    $query = $this->db->get();
	    if($query->num_rows() == 1){
	        return $query->row();
	    }
	}
	
	function create($userId){
	    $id = -1;
	    
	    $data = array(
	            'name'    => '',
	            'createdBy' => $userId,
	            'createdOn' => date( 'Y-m-d H:i:s' )
	    );
	    if($this->db->insert($this->table, $data)){
	        $id = $this->db->insert_id();
	    }
	    return $id;
	    
	}
    
}

?>
