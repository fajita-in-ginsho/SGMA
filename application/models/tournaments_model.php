<?php

class Tournaments_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('tournaments');
	}
	
	// return array of tournamets in which the give user participates.
	function getByUserId($userId){
		$tournaments = array();
		/*
		$stmt = "select 
					t.name as `tournament`
				  , c.name as `cup`
				from 
				participants as p
				, tournaments as t 
				, cups as c
				where 
				p.userId = $userId AND
				p.tournamentId = t.id AND
				t.cupId = c.id;";
		*/
		$this->db->select('t.name as `tournament`
		                 , c.name as `cup`');
		$this->db->from('participants as p');
		$this->db->join('tournaments as t', 'p.tournamentId = t.id');
		$this->db->join('cups as c', 't.cupId = c.id');
		$this->db->where("p.userId = $userId");
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$tournaments = $query->result();
		}
		return $tournaments;
	}

	function getIdByNames($cup_name, $tournament_name){
		$id = -1;
		/*
		$stmt = "
			select
				t.id as `id`
			from
				  tournaments as t
				, cups as c
			where
				t.cupId = c.id and
				t.name = '$tournament_name' and
				c.name = '$cup_name';
		";
		*/
		$this->db->select('t.id as `id`');
		$this->db->from('tournaments as t');
		$this->db->join('cups as c', 't.cupId = c.id');
		$this->db->where("t.name = '$tournament_name'");
		$this->db->where("c.name = '$cup_name'");
		$query = $this->db->get();
		if($query->num_rows() == 1){
			$id = (int)$query->row()->id;
		}else{
			log_message('info', $stmt);
			show_error($stmt);
		}
		return $id;
	}
	
	function getById($id){
	    /*
		$stmt = "
		select
		  t.*
		, type.name as `type`
		, c.id as `cup_id`
		, c.name as `cup_name`
		from
		tournaments as t
		, cups as c
		, tournamenttype as type
		where
		t.id = $id and
		t.cupId = c.id and
		t.tournamentTypeId = type.id;
		";
		$query = $this->db->query($stmt);
        */
		$this->db->select('t.*
		, type.name as `type`
		, c.id as `cup_id`
		, c.name as `cup_name`');
		$this->db->from('tournaments as t');
		$this->db->join('cups as c', 't.cupId = c.id');
		$this->db->join('tournamenttype as type', 't.tournamentTypeId = type.id');
		$this->db->where("t.id = $id");
		$query = $this->db->get();
		
		$result = array();
		if($query->num_rows() == 1){
			$result = $query->row();
		}else{
			log_message('info', $stmt);
			show_error($stmt);
		}
		return $result;
	}
		
}

?>
