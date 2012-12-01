<?php 

require_once(APPPATH . 'core/my_ci_model.php');


class Tournament_Columns_Model extends My_CI_Model {
	
	function __construct(){
		parent::__construct('tournament_columns');
		
	}
	
	function getColumnsByTournamentId($tournamentId){
	    $this->db->select('*');
	    $this->db->from('tournament_columns as tc');
	    $this->db->join('columns as col', 'tc.columnId = col.id');
	    $this->db->where("tc.tournamentId = $tournamentId");
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return $query->result();
	    }
	}

}

?>
