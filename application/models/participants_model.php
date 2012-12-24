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
    
	
	function replaceParticipants($tournament_id, $usernames){
	    $this->db->where('tournamentId', $tournament_id);
	    $this->db->delete('participants');
	     
	    foreach($usernames as $username){
	        $userId = $this->users_model->getIdByUsername($username);
	        if(isset($userId)){
	
	            $data = array(
	                      'tournamentId' => $tournament_id
	                    , 'userId' => $userId
	            );
	            $insertedId = $this->insert($data);
	            if(!isset($insertedId)){
	                return false;
	            }
	        }else{
	            return false;
	        }
	    }
	    return true;
	}
	
	function update($tournamentId, $userId, $context){
	    $this->db->where('tournamentId', $tournamentId);
	    $this->db->where('userId', $userId);
	    $succeeded = $this->db->update($this->table, $context);
	    //$stmt = $this->db->last_query();
	    return $succeeded;
	}
	
}

?>
