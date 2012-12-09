<?php 

require_once(APPPATH . 'core/my_ci_model.php');


class Tournament_Columns_Model extends My_CI_Model {
	
    public static $DEFALT_ID = -1;
    
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
    
	function replaceSetOfColumns($tournament_id, $column_fileds){
	    $this->db->where('tournamentId', $tournament_id);
	    $this->db->delete('tournament_columns');
	    
	    // TODO: add manadatory field to $column_fileds
	    
	    foreach($column_fileds as $field){
	        $column = $this->columns_model->getByField($field);
	        if(isset($column)){

	            $data = array(
	                'tournamentId' => $tournament_id
	              , 'columnId' => $column->id
	            );
	            $ret = $this->insert($data);
	            if($ret == false){
	                return false;
	            }
	        }else{
	            return false;
	        }
	    }
	    return true;
	}
}

?>
