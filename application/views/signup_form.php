<div id="signup_form" >

	<h1>Create an Account</h1>
	
	<fieldset>
	<legend>Personal Information</legend>
	<?php
	echo form_open('login/create_member');
	echo form_input('first_name', set_value('first_name', 'First Name'));
	echo form_input('last_name', set_value('last_name', 'Last Name'));
	echo form_input(array('name'=>'middle_name', 'value'=>'Middle Name'));
	echo form_input('email_address', set_value('email_address', 'Email Address'));
	
	?>
	</fieldset>
	
	<fieldset>
	<legend>Login Info</legend>
	<?php
	echo form_input('username', set_value('username', 'User Name'));
	echo form_input('password', set_value('password', 'Password'));
	echo form_input('password_confirm', set_value('password_confirm', 'Password Confirm'));
	
	echo form_submit('submit', 'Create');
	?>
	</fieldset>
	
	<?php
	// http://a44.video2.blip.tv/5870002834299/NETTUTS-CodeIgniterFromScratchDay6219.mp4?bri=24.4&brs=590
	// watched around 2/3 of the above tutorial.
	echo validation_errors('<p class="error">'); 
	?>
	
</div>