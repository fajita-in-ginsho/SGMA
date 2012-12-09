<?php

class Gameinfoshogi_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('gameinfoshogi');
	}
	
	function updateURL($gameInfoId, $url){
	    $data = array(
	        'k.url'=>$url
	    );
	    $this->db->where("info.id = $gameInfoId");
	    return $this->db->update('`gameinfoshogi` AS info
                                  INNER JOIN `kifu` AS k ON info.kifuId = k.id'
	    , $data);;
	}
	
	function getURL($gameInfoId){
	    
	    $this->db->select('k.url as url');
	    $this->db->from('gameinfoshogi AS info');
	    $this->db->join('kifu AS k', 'k.id = info.kifuId');
	    $this->db->where("info.id = $gameInfoId");
	    $query = $this->db->get();
	    if($query->num_rows() == 1){
	        return $query->row()->url;
	    }
	}
	
}

?>
