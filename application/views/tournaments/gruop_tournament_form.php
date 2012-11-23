<div id="tournament_area" class="claro" >
    <div id="tournament"></div>
    <div id="participants"></div>
    <div id="games"></div>
    <div id="tournametChart" dojoType="dojox.grid.DataGrid"></div>
    
    <div id="cupIdOfCurrentDisplayedChart" title=""></div>
    <div id="cupNameOfCurrentDisplayedChart" title=""></div>
    <div id="tournamentIdOfCurrentDisplayedChart" title=""></div>
    <div id="tournamentNameOfCurrentDisplayedChart" title=""></div>
    
    <div id="username_of_selected_row"></div>
    <div id="username_of_selected_column"></div>
    
    <div dojoType="dojox.widget.Toaster" id="toast" positionDirection="tl-down"></div>
    
    <div id="game_result_dialog" dojoType="dijit.Dialog"></div>
    <div id="thread_dialog" dojoType="dijit.Dialog"></div>
    <div id="thread_change_date_dialog" dojoType="dijit.Dialog"></div>
</div>


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



