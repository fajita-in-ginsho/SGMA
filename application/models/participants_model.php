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
		
		$query = $this->db->query($stmt);
			   
		$participants = array();
		if($query->num_rows() > 0){
			$participants = $query->result();
		}
		return $participants;
	}

}

?>
