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
2012-08-15  Done        enhance user admin authentication. implement history.

2012-08-22  Done        implement thread( send emails to opponenet, admin. create confirm screen, if confirmed, send email again
                        and add comments to thread.
                        implements change date form.
                        make sure date change function can be executed by the players of the game or admin.
                        comments are allowed by any participants( TBD: only players too )
2012-08-22  Task        jump to kifu form.
2012-08-22  Task        calculation for the points. score.
2012-08-22  Done        create tournament create form. cup create form.
2012-08-22  Task        release.
2012-08-22  Task        improve appearance/ improve home.
2012-09-07  Done        add URL link in the sent email as change date requested.
2012-09-12  Done        use dojo.widget.toast to warn if date/time is not selected in chagne date.
2012-10-03  Task        how to incorporate tournament view from a static html.
2012-10-03  Task        make cells editable. (such as Note, Points)
2012-10-03  Task        default points
2012-10-03  Task        default game date.
2012-10-03  Task        view to compose games for a new tournament.
2012-10-03  Task        future feature. Notification email 1day before the game to players.
2012-10-03  Task        Add scoreId in tournament, create ScoreId table, create Score table that has 
                        userId and score.
2012-10-06  Bug         username_of_selected_row is not overwritten as game_form is created multitimes.
2012-10-06  Bug         create_and_fill.sql. order to create tables causes an erorr saying foreign key doesn't exist. 

*/

?>
