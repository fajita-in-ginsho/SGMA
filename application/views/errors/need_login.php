<?php 
$this->lang->load('error');
echo $this->lang->line('error_need_to_login');
echo anchor('login/index', 'Login');
die();
?>


