
<div id="user_form">

	<h1>User Information</h1>
	<h2>User : <?php echo $user->username; ?></h2>
	
	<?php
	echo "<b>Games in the past<br></b>";
	if(isset($games_past)){
	    $count = 0;
	    foreach($games_past as $game){
	        $count++;
	        if($count > $no_games_past) break;
	        echo "Game: " . $game->g_name . "&nbsp;&nbsp;";
	        echo "Date: " . $game->g_date . "&nbsp;&nbsp;";
	        echo "Tournament: " . $game->t_name;
	        echo "<br>";
	    }
	}
    
	echo "<b>Comming games<br></b>";
	if(isset($games_future)){
	    $count = 0;
	    foreach($games_future as $game){
	        $count++;
	        if($count > $no_games_past) break;
	        echo "Game: " . $game->g_name . "&nbsp;&nbsp;";
	        echo "Date: " . $game->g_date . "&nbsp;&nbsp;";
	        echo "Tournament: " . $game->t_name;
	        echo "<br>";
	    }
	}
	?>
	
</div>


