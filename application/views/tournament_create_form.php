<div id="tournament_create_form" >

	<h1><?php echo $this->lang->line('tournament_form_create_header1'); ?></h1>
	
	<?php echo form_open('tournament/create'); ?>
	
	<p>
	<label for="tournament_name_textbox" style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_tournament_name_textbox'); ?></label>
	<input id="tournament_name_textbox" 
	       name="tournament_name"
	       dojoType="dijit.form.TextBox" type="text" style="width:240px;"
	></input>
	</p>
	
	<p>
	<label for="cup_names_dropdown" style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_cup_names_dropdown'); ?></label>
	<?php echo form_dropdown('cup_names', html_escape($cup_names), '', 'id="cup_names_dropdown" dojoType="dijit.form.ComboBox"'); ?>
	</p>
	
	<p>
	<label for="tournament_types_dropdown" style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_tournament_types_dropdown'); ?></label>
	<?php echo form_dropdown('tournament_types', html_escape($tournament_types), '', 'id="tournament_types_dropdown" dojoType="dijit.form.ComboBox"'); ?>
	</p>
	
	<label style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_choose_columns'); ?></label><br>
	<?php
	foreach($columns as $column){
	    echo '<input type="checkbox" dojoType="dijit.form.CheckBox" ';
	    echo 'name="columns_in_chart_' . $column->field . '" ';
	    if((bool)$column->isMandatory or (bool)$column->isDefault){
	        echo ' checked="checked" ';
	    }
	    if((bool)$column->isMandatory){
	        echo ' readonly="readonly" ';
	    }
	    echo '>';
	    echo $this->lang->line($column->name);
	    echo '</input>';
	    if((bool)$column->isMandatory){
	        echo '&nbsp;&nbsp;&nbsp;' . $this->lang->line('tournament_text_mandatory_column');
	    }
	    echo '<br>';
	} 
	?>
	
	<p>
	<label for="users_dropdown" style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_choose_participants'); ?></label><br>
	<select name="participants[]" dojoType="dijit.form.MultiSelect" id="users_dropdown" size="7" multiple>
	<?php
	    foreach($usernames as $key => $val){
	        echo "<option value=\"$key\">$val</option>";
	    } 
	?>
	</select>
	<p>
	
	<p>
	<label for="default_game_date" style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_default_game_date'); ?></label><br>
	<input 
	id="default_game_date"
	name="default_game_date" 
	data-dojo-type="dijit.form.DateTextBox" 
	/>
	
	<input
    id="default_game_time"
    name="default_game_time" 
    data-dojo-type="dijit.form.TimeTextBox"
    />
    </p>
	
	<button id="tournament_create_submit" type="submit"
	        name="tournament_create_submit" dojoType="dijit.form.Button" 
    >
    <?php echo $this->lang->line('tournament_form_button_submit'); ?>
    </button>
	</p>
    
</div>

