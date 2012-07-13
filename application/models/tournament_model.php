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
	
	// return array of tournamets in which the give user participates.
	function refresh(){
		$stmt = "
			SELECT
				t.id as `id`
			  , t.name as `name`
			  , ttype.name as `tournamentType`
			  , c.id as `cupId`
			  , c.name as `cupName`
			FROM 
			    tournaments as t 
			  , cups as c
			  , `tournamenttype` ttype
			WHERE 
			    t.id = {$this->data['id']} AND
			    t.cupId = c.id AND
			    t.`tournamentTypeId` = ttype.id
			    ;
		";
		$query = $this->db->query($stmt);
		
		if($query->num_rows() == 1){
			$this->data = array_merge($this->data, $query->row_array());
			$this->data['participants'] = $this->participants_model->getByTournamentId($this->data['id']);
		}else{
			log_message('info', $stmt);
			show_error($stmt);
		}
	}

}

?>
