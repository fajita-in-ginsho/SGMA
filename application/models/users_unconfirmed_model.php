<?php
require_once(APPPATH .'/core/my_idmodel.php');

class Users_Unconfirmed_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('users_unconfirmed');
	}
	
	function getByRandomstring($randomstring){
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("randomstring = '$randomstring'");
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return $query->result();
	    }
	}
	
	function transferRowToUser($randomstring){
	    
	    
	}
	    
}

?>
