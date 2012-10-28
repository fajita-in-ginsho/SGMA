<script type="text/javascript" src="<?php echo base_url(); ?>js/app/game_related_action.js"></script>
<script type="text/javascript">
var tournaments = eval(<?php echo $tournaments_json; ?>);
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/home_action.js"></script>


<?php
echo '<h1>Welcom to SGMA, ' . html_escape($username) . ' !!</h1>'; 
echo anchor('login/logout', 'Logout');

echo '<br>';
echo anchor('tournament/createForm', 'Create a new Tournament');
echo '<br>';
echo anchor('cup/createForm', 'Create a new Cup');
?>



<div align="left" id="tournament_list">
<?php
echo '<h2><p>Tournaments I\'m in!</p></h2>';

if(isset($tournaments)){
    
	echo '<ul type="">';
	/*
	foreach($tournaments as $q_result){
		echo '<li>' . 
		anchor("tournament/open/$q_result->cup/$q_result->tournament"
				, $q_result->cup . $q_result->tournament) .
		 '</li>';
	}
	*/
	/*
	foreach($tournaments as $q_result){
	    echo '<li><div id="' . $q_result->cup .$q_result->tournament .'">' .
	       	    $q_result->cup . ' ' .$q_result->tournament .
	    '</div></li>';
	}
	*/
	foreach($tournaments as $q_result){
	    echo '<li><input type="button" id="';
	    echo html_escape($q_result->cup) . html_escape($q_result->tournament) . '"';
	    echo 'value="' . html_escape($q_result->cup) . ' ' . html_escape($q_result->tournament) . '"';
	    echo 'name="' . html_escape($q_result->cup) . '/' . html_escape($q_result->tournament) . '"';
	    echo '></input></li>';
	}
	echo '</ul>';
	
}else{
	echo '<p>I\'m not currently in any tournament.</p>';
}
?>
</div>


<!--
TODO
I got to move the following elements to *_tornament_form.php
so that those elements are to created on deamnd. not statically as
it is created in home_page.php 
 -->

<div id="tournament_chart" class="claro" >
    <div id="tournament"></div>
    <div id="participants"></div>
    <div id="games"></div>
    <div id="tournametChart" dojoType="dojox.grid.DataGrid"></div>
    
    <div id="cupIdOfCurrentDisplayedChart" title=""></div>
    <div id="cupNameOfCurrentDisplayedChart" title=""></div>
    <div id="tournamentIdOfCurrentDisplayedChart" title=""></div>
    <div id="tournamentNameOfCurrentDisplayedChart" title=""></div>
</div>
<div dojoType="dojox.widget.Toaster" id="toast" positionDirection="tl-down"></div>


<!-- 
<div id="tournament_chart"></div>
<div style="width: 600px; height: 200px">
<table class="claro" dojoType="dojox.grid.DataGrid" id="myDataGrid">
</table>
 -->



