
<div id="game_result_form">

	<p><?php echo html_escape($username_of_selected_row); ?>
	<select dojoType="dijit.form.ComboBox" id="game_result_combobox">
	    <option>Won</option>
	    <option>Lost</option>
	    <option>Draw</option>
	    <option>Default Win</option>
	    <option>Not Yet Played</option>
	</select>
	against <?php echo html_escape($username_of_selected_column); ?></p>
    <button dojoType="dijit.form.Button" 
            type="button"
            onClick="onResultSubmit(event, <?php echo html_escape($game->gameId);?>);"
    >OK</button>
	
</div>


