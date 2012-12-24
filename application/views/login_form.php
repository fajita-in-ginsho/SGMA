<?php 
if($isAjax){
echo '<div id="login_form_ajax">';
}else{
echo '<div id="login_form">';    
}
?>



<?php 
if(!$isAjax){
    echo "<h1>" . $this->lang->line('tournament_login_form_header1') . "</h1>";
}

?>
<?php
echo form_open('login/validate_credentials');
?>

<div id="login_error">
<?php 
if($retry){
	echo $this->lang->line('error_username_or_password_invalid');
}
?>
<br>

</div>


<p>
<label for="username_textbox" style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_username'); ?></label>
<input id="username_textbox" 
       name="username"
       dojoType="dijit.form.TextBox" type="text" style="width:120px;"
       value=""
></input>
</p>

<p>
<label for="password_textbox" style="font-weight: bold;"><?php echo $this->lang->line('tournament_label_password'); ?></label>
<input id="password_textbox" 
       name="password"
       dojoType="dijit.form.TextBox" type="password" style="width:120px;"
       value=""
></input>
</p>
<?php

if($isAjax){
    echo form_input(array('type'=>'text', 'name'=>'isAjax', 'value'=>"true", 'style'=>"visibility:hidden; width:2px;"));
}
?>


<p>
<button id="login_form_submit" type="submit"
        name="login_form_submit" dojoType="dijit.form.Button" 
>
<?php echo $this->lang->line('tournament_button_login'); ?>
</button>
</p>

<?php 
if(!$isAjax){
    echo anchor('login/signup', $this->lang->line('tournament_anchor_create_account'));
}
?>
	
</div>