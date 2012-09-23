
<div id="game_form">

	<h1>Game Information</h1>
	<h2>game : <?php echo $game->name; ?></h2>
	<div id="players">
	<?php
	    foreach($players as $player){
	        echo "
	        <p>player : $player->username</p>
	        ";
	    } 
	?>
	</div>
	<div id="username_of_selected_row" title="<?php echo $username_of_selected_row; ?>">
	<?php
	    if(isset($username_of_selected_row)){
	        echo $username_of_selected_row;
	    }else{
	        echo "unknown";
	    }
	?>
	</div>
	<div id="username_of_selected_column" title="<?php echo $username_of_selected_column; ?>">
	<?php
	    if(isset($username_of_selected_column)){
	        echo $username_of_selected_column;
	    }else{
	        echo "unknown";
	    }
	?>
	</div>
	<div id="kifuId" title="<?php echo $game->kifuId; ?>"><p>kifuId : <?php echo $game->kifuId; ?></p></div>
	<div id="threadId" title="<?php echo $game->threadId; ?>"><p>threadId : <?php echo $game->threadId; ?></p></div>
	<div id="tournament_name" title="<?php echo $tournament->name; ?>"><p><?php echo $tournament->name; ?></p></div>
	<div id="gameId" title="<?php echo $game->gameId; ?>"><p><?php echo $game->gameId; ?></p></div>
	<div id="game_date" title="<?php echo $game->date; ?>"><p><?php echo $game->date; ?></p></div>
    <div id="isAjax" title="<?php echo $isAjax; ?>"><p>Ajax : <?php echo $isAjax; ?></p></div>
    
	
	<button dojoType="dijit.form.Button" type="button" onClick="onClickGameResult(event, <?php echo $game->gameId;?>);">
    Input Result
    </button>
    
    <button dojoType="dijit.form.Button" type="button" onClick="onClickHistory(event, <?php echo $game->threadId; ?>);">
    History
    </button>
    
    <button dojoType="dijit.form.Button" type="button" onClick="onClickChangeDate(event);">
    Change Date
    </button>
    
    <button dojoType="dijit.form.Button" type="button" onClick="onClickKifu(event, <?php echo $game->kifuId; ?>);">
    Kifu
    </button>
    
    
    
    <div id="game_result_dialog" dojoType="dijit.Dialog"></div>
    <div id="thread_dialog" dojoType="dijit.Dialog"></div>
    <div id="thread_change_date_dialog" dojoType="dijit.Dialog"></div>
    
    
    <br>
    <br>
	
</div>


