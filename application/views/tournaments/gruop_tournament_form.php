<script src="http://ajax.googleapis.com/ajax/libs/dojo/1.7.2/dojo/dojo.js" djConfig="parseOnLoad:true">

</script>
<link rel="stylesheet" type="text/css"
      href="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dijit/themes/claro/claro.css" />
 
<link rel="stylesheet" type="text/css"
      href="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dojox/grid/resources/Grid.css" />
 
<link rel="stylesheet" type="text/css"
      href="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dojox/grid/resources/claroGrid.css" />

      
</head>
      
<script type="text/javascript">

dojo.require("dojox.grid.DataGrid");
dojo.require("dojo.data.ItemFileReadStore");

</script>


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
	      var grid = dijit.byId("myDataGrid");
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

<div id="tournament"></div>
<div id="participants"></div>
<div id="games"></div>
<div id="tournament_chart"></div>

<div style="width: 600px; height: 200px">
<table class="claro" dojoType="dojox.grid.DataGrid" id="myDataGrid">
 
</table>
</div>

