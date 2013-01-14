<div id="signup_form" >

	<h1><?php echo $this->lang->line('signup_header'); ?></h1>
	
	<?php
	echo form_open('login/create_member');
	?>
	
	<p><label style="font-weight: bold;">
	<?php echo $this->lang->line('signup_form_required_symbol_heading'); ?>
	<span class="string_in_red"><?php echo $this->lang->line('signup_form_required_symbol'); ?></span>
	<?php echo $this->lang->line('signup_form_required_symbol_tailing'); ?>
	</label>
	
	 
	<p><label for="username_textbox" style="font-weight: bold;"><?php echo $this->lang->line('signup_form_textbox_username'); ?></label>
	<span class="string_in_red"><?php echo $this->lang->line('signup_form_required_symbol'); ?></span>
	<input id="username_textbox" name="username" dojoType="dijit.form.TextBox" type="text" style="width:120px;" value=""></input></p>
	
	
	
	<p><label for="email_address_textbox" style="font-weight: bold;"><?php echo $this->lang->line('signup_form_textbox_email_address'); ?></label>
	<span class="string_in_red"><?php echo $this->lang->line('signup_form_required_symbol'); ?></span>
	<input id="email_address_textbox" name="email_address" dojoType="dijit.form.TextBox" type="text" style="width:120px;" value=""></input></p>
	
	<p><label for="password_textbox" style="font-weight: bold;"><?php echo $this->lang->line('signup_form_textbox_password'); ?></label>
	<span class="string_in_red"><?php echo $this->lang->line('signup_form_required_symbol'); ?></span>
	<input id="password_textbox" name="password" dojoType="dijit.form.TextBox" type="password" style="width:120px;" value=""></input></p>
	
	<p><label for="password_confirm_textbox" style="font-weight: bold;"><?php echo $this->lang->line('signup_form_textbox_password_confirm'); ?></label>
	<span class="string_in_red"><?php echo $this->lang->line('signup_form_required_symbol'); ?></span>
	<input id="password_confirm_textbox" name="password_confirm" dojoType="dijit.form.TextBox" type="password" style="width:120px;" value=""></input></p>
	
	
	<p><label for="first_name_textbox" style="font-weight: bold;"><?php echo $this->lang->line('signup_form_textbox_first_name'); ?></label>
	<input id="first_name_textbox" name="first_name" dojoType="dijit.form.TextBox" type="text" style="width:120px;" value=""></input></p>
	
	<p><label for="last_name_textbox" style="font-weight: bold;"><?php echo $this->lang->line('signup_form_textbox_last_name'); ?></label>
	<input id="last_name_textbox" name="last_name" dojoType="dijit.form.TextBox" type="text" style="width:120px;" value=""></input></p>
	
	<p><label for="middle_name_textbox" style="font-weight: bold;"><?php echo $this->lang->line('signup_form_textbox_middle_name'); ?></label>
	<input id="middle_name_textbox" name="middle_name" dojoType="dijit.form.TextBox" type="text" style="width:120px;" value=""></input></p>
	
	
	 
	<input id="signup_form_submit" name="signup_form_submit" type="submit" value="<?php echo $this->lang->line('signup_form_submit_button'); ?>"> 
	</input></p>
	
	<!--  TODO: why this dojoType doesnt work?  
	<p><button dojoType="dijit.form.Button" id="signup_form_submit" type="submit" name="signup_form_submit" >
    <?php echo $this->lang->line('signup_form_submit_button'); ?></button></p>
    -->
	
	 
	<?php
	// http://a44.video2.blip.tv/5870002834299/NETTUTS-CodeIgniterFromScratchDay6219.mp4?bri=24.4&brs=590
	// watched around 2/3 of the above tutorial.
	echo validation_errors('<p class="error">'); 
	?>
	
</div>