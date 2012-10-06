


<script type="text/javascript">
dojo.addOnLoad(function (){

    
	
    dojo.xhrGet({
	    url:"../../../../tournament_view.json",
	    handleAs: "json",
	    load: function(data){
	      console.log("res=", data);
	      
	      var itemdata = data.chart.rows;
	      var structure = data.chart.columns;
	      var chart = new dojo.data.ItemFileReadStore( {data :{ items : itemdata }});
	      var grid = dijit.byId("tournametChart");
	      grid.setStore(chart);
	      grid.setStructure(structure);
	      grid.autoWidth = true;
	      grid.autoHeight = true;
	      grid.startup();

	    },
	    error: function(error) {
	      console.warn(new Error().stack);
	    }
	});
	
});
</script>



