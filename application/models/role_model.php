<?php

class Role_Model extends My_IDModel {
	
    public static $NAME_SYSTEM = "System";
    public static $NAME_ADMIN = "Admin";
    
	function __construct(){
		parent::__construct('role');
	}
	
}

?>
