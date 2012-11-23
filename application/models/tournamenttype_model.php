<?php
require_once(APPPATH .'/core/my_idmodel.php');

class Tournamenttype_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('tournamenttype');
	}

	function getByName($name){
	    /*
	    $stmt = "
	    SELECT * FROM `$this->table`
	    WHERE `name` = '$name'
	    ;
	    ";
	    */
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("name = '$name'");
	    $query = $this->db->get();
	    if($query->num_rows() == 1){
	        return $query->row();
	    }
	}
	

}

?>
