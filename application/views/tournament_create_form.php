<div id="tournament_create_form" >

	<h1>Create a new Tournament</h1>
	
	<p><?php echo form_open('tournament/create'); ?></p>
	<p><?php echo form_input('tournament_name', set_value('tournament_name', 'Tournament Name')); ?></p>
	<p><?php echo form_dropdown('cup_names', html_escape($cup_names)); ?></p>
	<p><?php echo form_dropdown('tournament_types', html_escape($tournament_types)); ?></p>
	
	<p>
	<?php 
	    echo form_submit('submit', 'Create');
	?>
	
</div>