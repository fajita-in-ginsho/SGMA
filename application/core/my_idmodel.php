<?php require_once(APPPATH . 'core/my_model.php');


class My_IDModel extends My_Model {
	
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
}

?>
