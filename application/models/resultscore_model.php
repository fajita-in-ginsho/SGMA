<?php
require_once(APPPATH . 'core/my_ci_model.php');

class Resultscore_Model extends My_CI_Model {
	
	function __construct(){
		parent::__construct('resultscore');
	}
	
	function getByTournamentId($tournamentId){
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("tournamentId = $tournamentId");
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return $query->result();
	    }
	}
}

?>
