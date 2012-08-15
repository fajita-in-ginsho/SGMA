<script type="text/javascript" src="../../js/app/import_requirement.js"></script>


<?php
echo '<h2>Welcom to SGMA, ' . $username . ' !!</h2>'; 
echo anchor('login/logout', 'Logout'); 
?>


<div id="tournament_list">
<?php
echo '<p>Tournaments I\'m in!</p>';

if(isset($tournaments)){
	echo '<ul type="disc">';
	foreach($tournaments as $q_result){
		echo '<li>' . 
		anchor("tournament/open/$q_result->cup/$q_result->tournament"
				, $q_result->cup . $q_result->tournament) .
		 '</li>';
	}
	/*
	foreach($tournaments as $q_result){
	    echo '<li><div id="' . $q_result->cup .$q_result->tournament .'">' .
	       	    $q_result->cup . ' ' .$q_result->tournament .
	    '</div></li>';
	}
	*/
	foreach($tournaments as $q_result){
	    echo '<li><input type="button" id="';
	    echo $q_result->cup . $q_result->tournament . '"';
	    echo 'value="' . $q_result->cup . ' ' . $q_result->tournament . '"';
	    echo 'name="' . $q_result->cup . '/' . $q_result->tournament . '"';
	    echo '></input></li>';
	}
	echo '</ul>';
	
}else{
	echo '<p>I\'m not particiated in any tournament.</p>';
}
?>
</div>

<script type="text/javascript" src="../../js/app/game_related_action.js"></script>
<script type="text/javascript" src="../../js/app/home_action.js"></script>
<script type="text/javascript">

dojo.addOnLoad(function (){
    var tournaments = eval(<?php echo $tournaments_json; ?>);
    
    console.log("tournamets.length: " + tournaments.length);
    for(var key in tournaments){
    	console.log("key : " + key);
    	console.log(tournaments[key].cup + " " + tournaments[key].tournament);
    	var divId = tournaments[key].cup + tournaments[key].tournament;
    	var div = dojo.byId(divId);
    	
        var params = {
            "cup" : tournaments[key].cup
          , "tournament" : tournaments[key].tournament
        }
    	dojo.connect(div, "onclick", params, function(context){
        	console.log("base_usl is " + "<?php echo base_url() ?>");
            var baseurl = "<?php echo base_url() ?>";
            console.log("div.name = " + div.name);
            console.log("url = " + "../tournament/open/" + tournaments[key].cup + '/' + tournaments[key].tournament);
            console.log("site url : " + "<?php echo site_url(); ?>");
            
        	dojo.xhrGet({

        	    //url:"../tournament/open/" + tournaments[key].cup + '/' + tournaments[key].tournament,
        	    url:"../tournament/open/" + this.cup + "/" + this.tournament,
        	    handleAs: "json",
        	    content : {
            	    "cup" : tournaments[key].cup
            	  , "tournament" : tournaments[key].tournament
            	  , "ajax" : "true"
                  , "divId" : context.divId
        	    },
        	    
        	    load: function(data){
            	  var itemdata = data.chart.rows;
        	      var structure = data.chart.columns;
        	      var chart = new dojo.data.ItemFileReadStore( {data :{
        	    	  identifier: 'username', 
            	      items : itemdata 
            	  }});

        	      /*
        	      var grid = dojox.grid.DataGrid({
            	      id : 'myDataGrid'
                	, store : chart
                	, structure : structure
        	      });
        	      */
        	      var grid = dijit.byId("myDataGrid");
        	      dojo.style(grid.domNode, "width", data.chart.width.toString() + "px");
        	      dojo.style(grid.domNode, "height", data.chart.height.toString() + "px");
        	      grid.setStore(chart);
        	      grid.setStructure(structure);
        	      dojo.connect(grid, "onClick", null, onGridClick);
        	      //grid.autoWidth = true;
        	      //grid.autoHeight = true;
        	      //var chart_div = dojo.byId("tournament_chart");
        	      
        	      //chart_div.appendChild(grid.domNode);
        	      //grid.startup();
        	      //debugger;
        	      
        	      
        	    },
        	    error: function(error) {
        	      console.warn(new Error().stack);
        	    }
        	});
    	});
    }
});
</script>


<div id="tournament_chart" class="claro" >

    <div id="myDataGrid" dojoType="dojox.grid.DataGrid">
    </div>
    
</div>





