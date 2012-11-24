
<div id="game_form">

	<h2>game : <?php echo html_escape($game->name); ?></h2>
	<div id="players">
	<?php
	    foreach($players as $player){
	        echo "
	        player : " . html_escape($player->username) . "<br>
	        ";
	    } 
	?>
	</div>
	<div id="username_of_selected_row" title="<?php echo html_escape($username_of_selected_row); ?>">
	<?php
	    echo "username_of_selected_row : ";
	    if(isset($username_of_selected_row)){
	        echo html_escape($username_of_selected_row);
	    }else{
	        echo html_escape("unknown");
	    }
	?>
	</div>
	<div id="username_of_selected_column" title="<?php echo html_escape($username_of_selected_column); ?>">
	<?php
	    echo "username_of_selected_column : ";
	    if(isset($username_of_selected_column)){
	        echo html_escape ($username_of_selected_column);
	    }else{
	        echo html_escape ("unknown");
	    }
	?>
	</div>
	<div id="kifuId" title="<?php echo html_escape($game->kifuId); ?>"><p>kifuId : <?php echo html_escape($game->kifuId); ?></p></div>
	<div id="threadId" title="<?php echo html_escape($game->threadId); ?>"><p>threadId : <?php echo html_escape($game->threadId); ?></p></div>
	<div id="tournament_name" title="<?php echo html_escape($tournament->name); ?>"><p>tournament : <?php echo html_escape($tournament->name); ?></p></div>
	<div id="gameId" title="<?php echo html_escape($game->gameId); ?>"><p><?php echo html_escape($game->gameId); ?></p></div>
	<div id="game_date" title="<?php echo html_escape($game->date); ?>"><p>date: <?php echo html_escape($game->date); ?></p></div>
    <div id="isAjax" title="<?php echo html_escape($isAjax); ?>"><p>Ajax : <?php echo html_escape($isAjax); ?></p></div>
    
	
	<button 
	<?php if(!$isLoggedIn){echo "disabled";} ?> 
	dojoType="dijit.form.Button" type="button" onClick="onClickGameResult(event, <?php echo html_escape($game->gameId);?>);">
    Input Result
    </button>
    
    <button
    dojoType="dijit.form.Button" type="button" onClick="onClickHistory(event, <?php echo html_escape($game->threadId); ?>);">
    History
    </button>
    
    <button
    <?php if(!$isLoggedIn){echo "disabled";} ?>  
    dojoType="dijit.form.Button" type="button" onClick="onClickChangeDate(event);">
    Change Date
    </button>
    
    <button 
    dojoType="dijit.form.Button" type="button" onClick="onClickKifu(event, <?php echo html_escape($game->kifuId); ?>);">
    Kifu
    </button>
    
    <button
    <?php if($isLoggedIn){echo "style=\"visibility:hidden;\"";} ?> 
    dojoType="dijit.form.Button" type="button" onClick="onClickLogin();">
    Login
    </button>
    
    <button
    <?php if(!$isLoggedIn){echo "style=\"visibility:hidden;\"";} ?> 
    dojoType="dijit.form.Button" type="button" onClick="onClickLogout();">
    Logout
    </button>
    
    <br>
    <br>
	
</div>


