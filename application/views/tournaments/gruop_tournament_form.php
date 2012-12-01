<script type="text/javascript" src="<?php echo base_url(); ?>js/app/game_related_action.js"></script>

<?php $this->load->view("tournament_elements"); ?>

<script type="text/javascript">
var tournament_data = eval(<?php echo $json_data; ?>);
</script>

<script type="text/javascript">
dojo.addOnLoad(function (){
	connectOnGridClick();
	showChart(tournament_data);
});
</script>



