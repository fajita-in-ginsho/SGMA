<?php 

class Tournament_Model extends My_IDModel {
	
	public $data;
	
	function __construct(){
		parent::__construct('tournaments');
		$this->data = array();
		$this->data['id'] = -1;
	}
	
	function initialize($id){
		if(!is_int($id)) return;
		
		$this->data['id'] = $id;
		$this->refresh();
		
	} 
	
	function getAttr($attribute_name){
		if(array_key_exists($attribute_name, $this->data)){
			return $this->data[$attribute_name];
		}
	}
	

	function refresh(){
	    
		$this->db->select('
		  t.id as `id`
	    , t.name as `name`
	    , ttype.name as `tournamentType`
	    , c.id as `cupId`
	    , c.name as `cupName`');
		$this->db->from('tournaments as t');
		$this->db->join('cups as c', 't.cupId = c.id');
		$this->db->join('tournamenttype AS ttype', 't.tournamentTypeId = ttype.id');
		$this->db->where("t.id = {$this->data['id']}");
		$query = $this->db->get();
		if($query->num_rows() == 1){
			$this->data = array_merge($this->data, $query->row_array());
			$this->data['participants'] = $this->participants_model->getByTournamentId($this->data['id']);
			$this->data['games'] = $this->games_model->getByTournamentId($this->data['id']);
		}else{
			log_message('info', $stmt);
			show_error($stmt);
		}
	}

}

?>
