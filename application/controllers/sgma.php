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
Date		Status		Description
0000-00-00	Done		emailaccount table was delted, so modify create account
0000-00-00	Done		jump to login successful page, then anchor to login.
0000-00-00	Done		create home page. list of tournaments.
2012-07-20	New			dojo.xhrGet url is not what I want. study and understand folder accessability.
2012-08-15  Done        game result can be inputed and update the chart immediately.
2012-08-15  New         enhance user admin authentication. implement history.
*/

?>
