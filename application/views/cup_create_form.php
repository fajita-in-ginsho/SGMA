<div id="cup_create_form" >

	<h1><?php echo $this->lang->line('tournament_form_create_cup_header1'); ?></h1>
	
	<?php
	echo form_open('cup/create');
	?>
	
	
	<p>
	<label for="cup_name_textbox" style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_cup_name_textbox'); ?></label>
	<input id="cup_name_textbox" 
	       name="cup_name"
	       dojoType="dijit.form.TextBox" type="text" style="width:240px;"
	></input>
	</p>
	
	<p>
	<label for="game_types_dropdown" style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_game_types_dropdown'); ?></label>
	<?php echo form_dropdown('gametype_name', html_escape($game_types), '', 'id="game_types_dropdown" dojoType="dijit.form.ComboBox"'); ?>
	</p>
	
	<p>
	<button id="cup_create_submit" type="submit"
	        name="cup_create_submit" dojoType="dijit.form.Button" 
    >
    <?php echo $this->lang->line('tournament_form_button_submit'); ?>
    </button>
	</p>
		
	
	
</div>