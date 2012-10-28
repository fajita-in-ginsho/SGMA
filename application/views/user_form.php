
<div id="user_form">

	<h1>User Information</h1>
	<h2>User : <?php echo html_escape($user->username); ?></h2>
	
	<?php
	echo "<b>Games in the past<br></b>";
	if(isset($games_past)){
	    $count = 0;
	    foreach($games_past as $game){
	        $count++;
	        if($count > $no_games_past) break;
	        echo "Game: " . html_escape($game->g_name) . "&nbsp;&nbsp;";
	        echo "Date: " . html_escape($game->g_date) . "&nbsp;&nbsp;";
	        echo "Tournament: " . html_escape($game->t_name);
	        echo "<br>";
	    }
	}
    
	echo "<b>Comming games<br></b>";
	if(isset($games_future)){
	    $count = 0;
	    foreach($games_future as $game){
	        $count++;
	        if($count > $no_games_past) break;
	        echo "Game: " . html_escape($game->g_name) . "&nbsp;&nbsp;";
	        echo "Date: " . html_escape($game->g_date) . "&nbsp;&nbsp;";
	        echo "Tournament: " . html_escape($game->t_name);
	        echo "<br>";
	    }
	}
	?>
	
</div>


