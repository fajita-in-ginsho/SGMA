<div id="login_form" >

	<h1>Login, SGMA member! </h1>
	<?php
	echo form_open('login/validate_credentials');
	?>
	
	<div id="login_error">
	<?php 
	if($retry){
		echo "User or password was invalid!";
	}
	?>
	<br>
	</div>
	
	<?php
	echo form_input('username', 'kunio');
	echo form_password('password', 'kunio');
	echo form_submit('submit', 'Login');
	//echo "<br>";
	echo anchor('login/signup', 'Create Account');
	?>
	
</div>