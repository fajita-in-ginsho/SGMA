<script type="text/javascript" src="<?php echo base_url(); ?>js/app/game_related_action.js"></script>

<?php $this->load->view("tournament_elements"); ?>


<script type="text/javascript">
dojo.addOnLoad(function (){
	connectOnGridClick();
	dojo.xhrGet({
	    url:"../../../../tournament_view.json",
	    handleAs: "json",
	    /*
	    load: function(data){
		  debugger;
	      console.log("res=", data);
	      
	      var itemdata = data.chart.rows;
	      var structure = data.chart.columns;
	      var chart = new dojo.data.ItemFileReadStore( {data :{ items : itemdata }});
	      
	      var grid = dijit.byId("tournametChart");
	      if(typeof(grid) === "undefined"){
	    	  var grid = new dojox.grid.DataGrid({id: 'tournametChart'} );
	      }
	      
	      grid.setStore(chart);
	      grid.setStructure(structure);
	      grid.autoWidth = true;
	      grid.autoHeight = true;
	      grid.startup();

	    }
	    */
	    //load: showChart(data),
	    load: function(data){
			  debugger;
			  showChart(data)
		},
	    error: function(error) {
	      console.warn(new Error().stack);
	    }
	});
	
});
</script>



