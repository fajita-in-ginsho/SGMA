<?php 
require_once(BASEPATH . '/core/Model.php');

class My_Model extends CI_Model {
	
	protected $table = "";
	
	function __construct($table_name=""){
		parent::__construct();
		$this->table = $table_name;
	}
	
	function getTable(){
		return $this->table;
	}
	
	function getAll(){
		$q = $this->db->get($this->table);
		$data = array();
		if($q->num_rows() > 0){
			foreach($q->result() as $row){
				array_push($data, $row);
			}
			return $data;
		}
	}

}

?>
