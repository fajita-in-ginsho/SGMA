<?php

class Thread_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('thread');
	}
	
	// return object
	function getById($id){
	    /*
	    $stmt = "
	    SELECT 
         *
        FROM `thread`
        WHERE `id` = $id
	    ;
	    ";
	    */
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
	    /*
	    $stmt = "
	    insert into `thread` (name, createdBy, createdOn)
	    values ('', $userId, Now())
	    ;
	    ";
	    */
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
