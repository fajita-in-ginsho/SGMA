<?php

class Comments_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('comments');
	}
	
	// return object
	function getCommentsByThreadId($threadId, $orderBy){
	    
	    $this->db->select('`comments`.`id` AS `id`
        , `comments`.`threadId` AS `threadId`
        , `comments`.`comment` AS `comment`
        , `comments`.`createdBy` AS `createdBy`
        , `users`.`username` AS `username`
        , `comments`.`createdOn` AS `createdOn`');
	    // you don't need to use ` charater in active record.
	    $this->db->from('comments');
	    $this->db->join('users', 'users.id = comments.createdBy');
	    $this->db->where("comments.threadId = $threadId");
	    if(isset($orderBy)){
	        $this->db->order_by($orderBy['attr'], $orderBy['order']);
	    }
	    
	    $query = $this->db->get();
	    if($query->num_rows() > 0){
	        return $query->result();
	    }else{
	        return array();
	    }
	}
    
	function add($threadId, $comment, $userId){
	    $new_account_insert_data = array(
	        'threadId'    => $threadId,  
            'createdBy'    => $userId,
            'comment'       => $comment
        );
	    $this->db->set('createdOn', 'Now()', false);
	    // write query such as update returns TRUE on success, FALSE if fails.
	    if($this->db->insert($this->table, $new_account_insert_data)){
	        return $this->db->insert_id();
	    }
	}
}

?>
