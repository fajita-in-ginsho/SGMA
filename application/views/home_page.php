<script type="text/javascript" src="<?php echo base_url(); ?>js/app/game_related_action.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/home_action.js"></script>

<?php
echo '<h1>' . $this->lang->line('home_welcom_message') . html_escape($username)  . $this->lang->line('home_welcom_message_ending') . '</h1>'; 
echo anchor('login/logout', $this->lang->line('home_button_loout'));

if($hasAdminRight == true){
    echo '<br>';
    echo anchor('tournament/createForm', $this->lang->line('home_button_create_tournament'));
    echo '<br>';
    echo anchor('cup/createForm', $this->lang->line('home_button_create_cup'));
    /*
    // TODO: let administrator choose to notify email as he changes info.
    echo '<br>';
    $data = array(
            'name'        => 'email_notification',
            'id'          => 'email_notification',
            'value'       => $this->lang->line('home_checkbox_email_notification'),
            'checked'     => TRUE,
            'style'       => 'margin:10px',
            'dojoType'       => 'dijit.form.CheckBox',
            'onClick'       => 'onCheckBoxEmailNotification(event)'
    );
    echo form_checkbox($data);
    echo form_label($this->lang->line('home_checkbox_email_notification'), $data['name']);
    */
}
?>



<div align="left" id="tournament_list">
<?php

echo '<div class="home_list_header"><p>' . $this->lang->line('home_administrable_tournaments_list') . '</p></div>';

if(isset($administrable_tournaments)){

    echo '<ul type="">';

    foreach($administrable_tournaments as $queryResult){
        echo '<li>';
	    echo '<div class="tournament_info">';
        echo '<button type="button" dojoType="dijit.form.Button"';
        //echo 'id="' .'participating_tournaments_' . html_escape($queryResult->cup) . html_escape($queryResult->tournament) . '"';
        //echo 'name="' . html_escape($queryResult->cup) . '/' . html_escape($queryResult->tournament) . '"';
        echo 'class="tournament_button"';
        echo '>';
        echo html_escape($queryResult->cup) . '&nbsp' . html_escape($queryResult->tournament);
        echo '</button>';
        echo '<input type="hidden" class="tournament_name" value="' . html_escape($queryResult->tournament) . '"/>';
        echo '<input type="hidden" class="cup_name" value="' . html_escape($queryResult->cup) . '"/>';
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
}else{
    echo '<p>' . $this->lang->line('home_no_tournament_message') . '</p>';
}

echo '<div class="home_list_header"><p>' . $this->lang->line('home_participating_tournaments_list') . '</p></div>';

if(isset($participating_tournaments)){
    
	echo '<ul type="">';
	
	foreach($participating_tournaments as $queryResult){
	    echo '<li>';
	    echo '<div class="tournament_info">';
        echo '<button type="button" dojoType="dijit.form.Button"';
        //echo 'id="' .'participating_tournaments_' . html_escape($queryResult->cup) . html_escape($queryResult->tournament) . '"';
        //echo 'name="' . html_escape($queryResult->cup) . '/' . html_escape($queryResult->tournament) . '"';
        echo 'class="tournament_button"';
        echo '>';
        echo html_escape($queryResult->cup) . '&nbsp' . html_escape($queryResult->tournament);
        echo '</button>';
        echo '<input type="hidden" class="tournament_name" value="' . html_escape($queryResult->tournament) . '"/>';
        echo '<input type="hidden" class="cup_name" value="' . html_escape($queryResult->cup) . '"/>';
        echo '</div>';
        echo '</li>';
	}
	echo '</ul>';
	
}else{
	echo '<p>' . $this->lang->line('home_no_tournament_message') . '</p>';
}
?>
</div>

 <?php $this->load->view("tournament_elements"); ?>




