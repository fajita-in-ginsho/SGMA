<?php
require_once(APPPATH .'/core/my_idmodel.php');

class Tournamenttype_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('tournamenttype');
	}

	function getByName($name){
	    $stmt = "
	    SELECT * FROM `$this->table`
	    WHERE `name` = '$name'
	    ;
	    ";
	
	    $query = $this->db->query($stmt);
	    if($query->num_rows() == 1){
	        return $query->row();
	    }
	}
	

}

?>
