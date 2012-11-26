
<div id="game_result_form">
    
    <?php $this->lang->load('tournament'); ?>
    
	<p>
	<!-- player -->
	<?php echo html_escape($username_of_selected_row); ?>
	
	<select dojoType="dijit.form.ComboBox" id="game_result_combobox">
	    <option><?php echo $this->lang->line('tournament_won'); ?></option>
	    <option><?php echo $this->lang->line('tournament_lost'); ?></option>
	    <option><?php echo $this->lang->line('tournament_draw'); ?></option>
	    <option><?php echo $this->lang->line('tournament_default_win'); ?></option>
	    <option><?php echo $this->lang->line('tournament_not_yet_played'); ?></option>
	</select>
	
	<?php echo $this->lang->line('tournament_win_against_phrase'); ?>
	<!-- opponent -->
	<?php echo html_escape($username_of_selected_column); ?>
	</p>
	<?php echo $this->lang->line('tournament_game_kifu_url_label'); ?>
	<input id="kifu_url_textbox" dojoType="dijit.form.TextBox" type="text" style="width:100%;"
	value="<?php if(isset($kifu_url)){ echo $kifu_url; }else{ echo ''; } ?>"
	></input>
	
    <button dojoType="dijit.form.Button" 
            type="button"
            onClick="onResultSubmit(<?php echo html_escape($game->gameId);?>);"
    >OK</button>
	
</div>


