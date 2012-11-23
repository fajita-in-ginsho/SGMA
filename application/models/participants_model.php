<?php

class Participants_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('participants');
	}
	
	/*
	 * getByTournamentId
	 * 
	 * description: get all participants participate in the
	 * given tournament from participants table.
	 *   
	 * return: array of an object
	 * 
	 */
	function getByTournamentId($tournamentId){
	    /*
		$stmt = "
		select 
			p.userId as `userId`
		  , u.username as `username`
		from 
		    participants as p
		  , users as u
		where 
			p.userId = u.id and
			p.tournamentId = $tournamentId
		;";
        */
		
		$this->db->select('p.userId as `userId`
		                 , u.username as `username`');
		$this->db->from('participants as p');
		$this->db->join('users as u', 'p.userId = u.id');
		$this->db->where("p.tournamentId = $tournamentId");
		$query = $this->db->get();
			   
		$participants = array();
		if($query->num_rows() > 0){
			$participants = $query->result();
		}
		return $participants;
	}

}

?>
