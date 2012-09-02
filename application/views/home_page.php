<script type="text/javascript" src="../../js/app/import_requirement.js"></script>


<?php
echo '<h2>Welcom to SGMA, ' . $username . ' !!</h2>'; 
echo anchor('login/logout', 'Logout');

echo '<br>';
echo anchor('tournament/create', 'Create a new Tournament');
echo '<br>';
echo anchor('cup/create', 'Create a new Cup');
?>






<div id="tournament_list">
<?php
echo '<p>Tournaments I\'m in!</p>';

if(isset($tournaments)){
	echo '<ul type="disc">';
	foreach($tournaments as $q_result){
		echo '<li>' . 
		anchor("tournament/open/$q_result->cup/$q_result->tournament"
				, $q_result->cup . $q_result->tournament) .
		 '</li>';
	}
	/*
	foreach($tournaments as $q_result){
	    echo '<li><div id="' . $q_result->cup .$q_result->tournament .'">' .
	       	    $q_result->cup . ' ' .$q_result->tournament .
	    '</div></li>';
	}
	*/
	foreach($tournaments as $q_result){
	    echo '<li><input type="button" id="';
	    echo $q_result->cup . $q_result->tournament . '"';
	    echo 'value="' . $q_result->cup . ' ' . $q_result->tournament . '"';
	    echo 'name="' . $q_result->cup . '/' . $q_result->tournament . '"';
	    echo '></input></li>';
	}
	echo '</ul>';
	
}else{
	echo '<p>I\'m not particiated in any tournament.</p>';
}
?>
</div>

<script type="text/javascript" src="../../js/app/game_related_action.js"></script>

<script type="text/javascript">
var tournaments = eval(<?php echo $tournaments_json; ?>);
</script>
<script type="text/javascript" src="../../js/app/home_action.js"></script>


<div id="tournament_chart" class="claro" >

    <div id="tournametChart" dojoType="dojox.grid.DataGrid"></div>
    <div id="cupOfCurrentDisplayedChart" title=""></div>
    <div id="tournamentOfCurrentDisplayedChart" title=""></div>
    
</div>





