
<div id="game_form">

	<h2><?php echo $this->lang->line('tournament_label_game_name'); ?><?php echo html_escape($game->name); ?></h2>
	<div id="players">
	<?php
	    foreach($players as $player){
	        echo $this->lang->line('tournament_label_player_name') . html_escape($player->username) . "<br>
	        ";
	    } 
	?>
	</div>
	
	
	<div id="tournament_name" title="<?php echo html_escape($tournament->name); ?>">tournament : <?php echo html_escape($tournament->name); ?></div>
	<div id="game_date" title="<?php echo html_escape($game->date); ?>">date: <?php echo html_escape($game->date); ?></div>
	
	
	<div id="username_of_selected_column" title="<?php echo html_escape($username_of_selected_column); ?>">
	<?php
	    if($this->config->item('debug_mode')){
	        echo "username_of_selected_column : ";
	        if(isset($username_of_selected_column)){
	            echo html_escape ($username_of_selected_column);
	        }else{
	            echo html_escape ("unknown");
	        }    
	    }
	?>
	</div>
	
	<div id="username_of_selected_row" title="<?php echo html_escape($username_of_selected_row); ?>">
	<?php
	    if($this->config->item('debug_mode')){
    	    echo "username_of_selected_row : ";
    	    if(isset($username_of_selected_row)){
    	        echo html_escape($username_of_selected_row);
    	    }else{
    	        echo html_escape("unknown");
    	    }
	    }
	?>
	</div>
	
	<div id="kifuId" title="<?php echo html_escape($kifuId); ?>"><?php if($this->config->item('debug_mode')){  echo 'kifuId : ' . html_escape($kifuId);	}?></div>
	<div id="threadId" title="<?php echo html_escape($game->threadId); ?>"><?php if($this->config->item('debug_mode')){  echo 'threadId : ' . html_escape($game->threadId); }?></div>
	<div id="gameId" title="<?php echo html_escape($game->id); ?>"><?php if($this->config->item('debug_mode')){  echo 'gameId : ' . html_escape($game->id); }?></div>
	<div id="isAjax" title="<?php echo html_escape($isAjax); ?>"><?php if($this->config->item('debug_mode')){ echo 'Ajax : ' . html_escape($isAjax); }?></div>
	
	
	<button 
	<?php if(!$isLoggedIn){echo "disabled";} ?> 
	dojoType="dijit.form.Button" type="button" onClick="onClickGameResult(<?php echo html_escape($game->id);?>);">
    <?php echo $this->lang->line('tournament_button_input_result'); ?>
    </button>
    
    <button
    dojoType="dijit.form.Button" type="button" onClick="onClickHistory(<?php echo html_escape($game->threadId); ?>);">
    <?php echo $this->lang->line('tournament_button_history'); ?>
    </button>
    
    <button
    <?php if(!$isLoggedIn){echo "disabled";} ?>  
    dojoType="dijit.form.Button" type="button" onClick="onClickChangeDate();">
    <?php echo $this->lang->line('tournament_button_change_date'); ?>
    </button>
    
    <button 
    dojoType="dijit.form.Button" type="button" onClick="onClickKifu(<?php echo html_escape($kifuId); ?>);">
    <?php echo $this->lang->line('tournament_button_kifu'); ?>
    </button>
    
    <button
    <?php if($isLoggedIn){echo "style=\"visibility:hidden;\"";} ?> 
    dojoType="dijit.form.Button" type="button" onClick="onClickLogin();">
    <?php echo $this->lang->line('tournament_button_login'); ?>
    </button>
    
    <button
    <?php if(!$isLoggedIn){echo "style=\"visibility:hidden;\"";} ?> 
    dojoType="dijit.form.Button" type="button" onClick="onClickLogout();">
    <?php echo $this->lang->line('tournament_button_logout'); ?>
    </button>
    
    
</div>


