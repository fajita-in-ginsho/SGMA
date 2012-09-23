<div id="cup_create_form" >

	<h1>Create a new Cup</h1>
	
	<?php
	echo form_open('cup/create');
	?>
	
	<p>
	<?php echo form_input('cup_name', set_value('cup_name', 'Name')); ?>
	</p>
	
	
	<?php 
	echo form_submit('submit', 'Create');
	?>
	
</div>