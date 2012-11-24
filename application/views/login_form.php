<?php 
if($isAjax){
echo '<div id="login_form_ajax">';
}else{
echo '<div id="login_form">';    
}
?>

    <?php 
    if(!$isAjax){
	    echo "<h1>Login, SGMA member! </h1>";
	}
	
	?>
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
	echo "<br>";
	echo form_password('password', 'kunio');
	echo "<br>";
	if($isAjax){
	    echo form_input(array('type'=>'text', 'name'=>'isAjax', 'value'=>"true", 'style'=>"visibility:hidden; width:2px;"));
	}
	echo form_submit('submit', 'Login');
	
	if(!$isAjax){
	    echo anchor('login/signup', 'Create Account');
	}
	
	?>
	
</div>