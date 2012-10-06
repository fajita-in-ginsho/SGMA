<?php

class Comments_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('comments');
	}
	
	// return object
	function getCommentsByThreadId($threadId, $additionalClause){
	
	    $stmt = "
	    SELECT 
          `comments`.`id` AS `id`
        , `comments`.`threadId` AS `threadId`
        , `comments`.`comment` AS `comment`
        , `comments`.`createdBy` AS `createdBy`
        , `users`.`username` AS `username`
        , `comments`.`createdOn` AS `createdOn`
        FROM `comments`, `users`
        WHERE `comments`.`threadId` = $threadId
        and `users`.`id` = `comments`.`createdBy`
	    ";
	    
	    if(isset($additionalClause)){
	        $stmt .= $additionalClause;
	    }
	    
	    $query = $this->db->query($stmt);
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
