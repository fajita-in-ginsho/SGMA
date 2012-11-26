<?php require_once(APPPATH . 'core/my_ci_model.php');


class My_IDModel extends My_CI_Model {
	
	function __construct($table_name=""){
		parent::__construct($table_name);
	}
	
	function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function replace($data){
		$this->db->replace($this->table, $data);
		return $this->db->result_id;
	}
	
	function getById($id){
	    if(!isset($id)) return;

	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("id = $id");
	    $query = $this->db->get();
	    
	    if($query->num_rows() == 1){
	        return $query->row();
	    }
	}
	
	function getAll(){
	    
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return $query->result();
	    }
	}
}

?>
