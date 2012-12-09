<?php 
require_once(BASEPATH . '/core/Model.php');

class My_CI_Model extends CI_Model {
	
	protected $table = "";
	
	function __construct($table_name=""){
		parent::__construct();
		$this->table = $table_name;
	}
	
	function getTable(){
		return $this->table;
	}
	
	function insert($data)
	{
	    return $this->db->insert($this->table, $data);
	}
	
	function replace($data){
	    return $this->db->replace($this->table, $data);
	}
	
	function getAll(){
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->result();
		}
	}
	
	/*
	function getAll(){
	     
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return $query->result();
	    }
	}
    */
	
	function hasAttribute($attribute){
	    $this->db->select('*');
	    $this->db->from('information_schema.COLUMNS');
	    $this->db->where("TABLE_SCHEMA = '$this->db->database'");
	    $this->db->where("TABLE_NAME = '$this->table'");
	    $this->db->where("COLUMN_NAME = '$attribute'");
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return true;
	    }
	    return false;
	}
	
	
}

?>
