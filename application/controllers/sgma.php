<?php
class SGMA extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		
		phpinfo();	
		
	}
	
	
}

/*
Coding RULEs
- do not allow parameters in constructor for class to be loaded.
  instead, you should hava a funciton called initialize() to pass parameters. 

*/

/*
TODO
emailaccount table was delted, so modify create account
jump to login successful page, then anchor to login.
create home page. list of tournaments.
*/

?>
