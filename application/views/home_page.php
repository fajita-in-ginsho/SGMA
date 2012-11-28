<script type="text/javascript" src="<?php echo base_url(); ?>js/app/game_related_action.js"></script>
<script type="text/javascript">
var tournaments = eval(<?php echo $tournaments_json; ?>);
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/home_action.js"></script>


<?php
echo '<h1>' . $this->lang->line('home_welcom_message') . html_escape($username)  . $this->lang->line('home_welcom_message_ending') . '</h1>'; 
echo anchor('login/logout', $this->lang->line('home_button_loout'));

if($hasAdminRight == true){
    echo '<br>';
    echo anchor('tournament/createForm', $this->lang->line('home_button_create_tournament'));
    echo '<br>';
    echo anchor('cup/createForm', $this->lang->line('home_button_create_cup'));
}
?>



<div align="left" id="tournament_list">
<?php
echo '<h2><p>' . $this->lang->line('home_tournament_list') . '</p></h2>';

if(isset($tournaments)){
    
	echo '<ul type="">';
	
	foreach($tournaments as $q_result){
	    echo '<li><input type="button" id="';
	    echo html_escape($q_result->cup) . html_escape($q_result->tournament) . '"';
	    echo 'value="' . html_escape($q_result->cup) . ' ' . html_escape($q_result->tournament) . '"';
	    echo 'name="' . html_escape($q_result->cup) . '/' . html_escape($q_result->tournament) . '"';
	    echo '></input></li>';
	}
	echo '</ul>';
	
}else{
	echo '<p>' . $this->lang->line('home_no_tournament_message') . '</p>';
}
?>
</div>

 <?php $this->load->view("tournament_elements"); ?>




