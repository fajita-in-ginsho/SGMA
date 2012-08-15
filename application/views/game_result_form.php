<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/import_requirement.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/game_related_action.js"></script>

<div id="game_result_form">

	<p><?php echo $username_of_selected_row; ?>
	<select dojoType="dijit.form.ComboBox" id="game_result_combobox">
	    <option>Won</option>
	    <option>Lost</option>
	    <option>Draw</option>
	    <option>Default Win</option>
	    <option>Not Yet Played</option>
	</select>
	against <?php echo $username_of_selected_column; ?></p>
    <button dojoType="dijit.form.Button" 
            type="button"
            onClick="onResultSubmit(event, <?php echo $game->gameId;?>);"
    >OK</button>
	
</div>


