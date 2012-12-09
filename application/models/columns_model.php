<?php
require_once(APPPATH .'/core/my_idmodel.php');

class Columns_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('columns');
	}

	function isDefaultSetOfColumns($column_fileds){
	    $this->db->select('*');
	    $this->db->from('columns');
	    $this->db->where("isDefault = 1");
	    $this->db->where("isMandatory = 0");
	    $query = $this->db->get();
	    
	    $default_set_of_columns = array();
	    if($query->num_rows() > 0){
	        foreach($query->result() as $row){
	            if((bool)$row->isDefault){
	                $default_set_of_columns[] = $row->field;
	            }
	        }
	    }
	    
	    // == comparison doesn't care the order.
	    return ($default_set_of_columns == $column_fileds);
	}
	
	function getByField($field){
	    $this->db->select('*');
	    $this->db->from('columns');
	    $this->db->where("field = '$field'");
	    $query = $this->db->get();
	     
	    if($query->num_rows() == 1){
	        return $query->row();
	    }
	}
}

?>
