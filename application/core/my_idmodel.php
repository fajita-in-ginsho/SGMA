<?php require_once(APPPATH . 'core/my_ci_model.php');


class My_IDModel extends My_CI_Model {
	
	function __construct($table_name=""){
		parent::__construct($table_name);
	}
	
	function insert($data)
	{
        $ret = $this->db->insert($this->table, $data);
        if($ret){
            return $this->db->insert_id();
        }
	}
	
	function replace($data){
		$ret = $this->db->replace($this->table, $data);
		if($ret){
		    return $this->db->result_id;
		}
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
	
}

?>
