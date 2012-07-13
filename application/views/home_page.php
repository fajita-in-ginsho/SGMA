
<?php
echo '<h2>Welcom to SGMA, ' . $username . ' !!</h2>'; 
echo anchor('login/logout', 'Logout'); 
?>

<div id="tournament">
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
	echo '</ul>';
}else{
	echo '<p>I\'m not particiated in any tournament.</p>';
}
?>

</div>



