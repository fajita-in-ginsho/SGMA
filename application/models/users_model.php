<?php
require_once(APPPATH .'/core/my_idmodel.php');

class Users_Model extends My_IDModel {
	
	function __construct(){
		parent::__construct('users');
	}
	
	/*
	 * return array
	 */
	
	function validate(){
		$this->db->where('username', $this->input->post('username'));
		// TODO: encrypt password as store in database.
		//$this->db->where('password', md5($this->input->post('password')));
		
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get($this->table);
		
		if($query->num_rows() == 1){
			return true;
		}
		return false;
	}
	
	function getIdByUsername($username){
		$this->db->where('username', $username);
		$query = $this->db->get($this->table);
		
		if($query->num_rows() == 1){
			return $query->row(0)->id;
		}
	}	
	
	function hasAdminRight($userId){
	    $isAdmin = false;
	    $this->db->select('role.name as role');
	    $this->db->from('users');
	    $this->db->join('role', 'users.roleId = role.id');
	    $this->db->where("users.id = $userId");
	    $query = $this->db->get();
	    if($query->num_rows() == 1){
	        if($query->row(0)->role == Role_Model::$NAME_SYSTEM || $query->row(0)->role == Role_Model::$NAME_ADMIN){
	            $isAdmin = true;
	        }
	    }
	    return $isAdmin;
	}
}

?>
