<?php 
$this->lang->load('error');
echo $this->lang->line('error_no_permission_page');
    echo anchor('login/index', 'Login');
die();
?>


