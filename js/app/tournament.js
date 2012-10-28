//
function imageFormatter(url){
    return "<img width='40' height='40' src='" + url + "'/>";
};

function onChangePoints(points){
	points = parseInt(points);
	console.log(points);
	if(points == NaN){
		return;
	}
	
	var arguments = {
    	    "tournamentId" : dojo.attr(dojo.byId('tournamentIdOfCurrentDisplayedChart'), 'title')
    	  , "field" : "points"
    	  , "value" : points
	   	  , "ajax" : true
	};
	
	dojo.xhrPost({
		
	    url:"../tournament/update/",
	    handleAs: "text",
	    postData : arguments,  
	    load : function(data){
	    },
	    error : function (error){
	    	alert(data);
	    }
	});
}


function onChangeNotes(notes){
	console.log(notes);
}


function onGridClickOnGame(event, item, gameId){
	var columnName = event.cell.field;
	var arguments = {
    	    "gameId" : gameId
	   	  , "ajax" : true
	};
	
	if(item != null){
		if(typeof item.username[0] !== "undefined")
			arguments['username_of_selected_row'] = item.username[0];
		    //TODO　この時点でdivつくっといてここに登録しておく。登録先はtitleかvalueか？
			dojo.attr(dojo.byId('username_of_selected_row'), 'title', arguments['username_of_selected_row']);
	}
	if(columnName != null){
		arguments['username_of_selected_column'] = columnName;
		dojo.attr(dojo.byId('username_of_selected_column'), 'title', arguments['username_of_selected_column']);
	}
	
	if(gameId != -1){
		dojo.xhrGet({

		    url:"../game/open/" + gameId, 
		    handleAs: "text",
		    content : arguments,  
		    load : function(data){
			    
		    	myDialog = new dijit.Dialog({
			        title: "Game Information",
			        content: data,
			        style: "width: 300px"
			    });
			    myDialog.show();
		    },
		    error : function (error){
		    	alert(data);
		    }
		});
	}else{
		//alert("can not retrieve the game information...");
	}	
}

function onGridClickOnUsername(event, item){
	var arguments = {
	   	  "ajax" : true
	};
	
	if(item != null){
		if(typeof item.username[0] !== "undefined")
			arguments['username'] = item.username[0];
	}else{
		return;
	}
	
	dojo.xhrGet({

	    url:"../user/open/" + arguments['username'], 
	    handleAs: "text",
	    content : arguments,  
	    load : function(data){
		    
	    	myDialog = new dijit.Dialog({
		        title: "User Information",
		        content: data,
		        style: "width: 300px"
		    });
		    myDialog.show();
	    },
	    error : function (error){
	    	alert(data);
	    }
	});
		
}

function onGridClick(event){
	
	//alert("cellIndex = " + event.cellIndex + "\n" + "rowIndex = " + event.rowIndex);
	//var rowUsername = event.grid.getIdentifer();
	var columnName;
	var item;
	
	try{
		columnName = event.cell.field;
		item = event.grid.getItem(event.rowIndex);
	}catch(e){
		// if you edit, textbox event is called. but they should be ignored.
		return;
	}
	
	var gameId = -1;
	try{
		gameId = item[event.cell.field + "_gameId"][0];
	}catch(e){
	
	}
	
	if(gameId != -1){
		onGridClickOnGame(event, item, gameId);
	}else if(columnName == "username"){
		onGridClickOnUsername(event, item);
	}
	
}



function createTournamentElements(){
	/*
     * instead of the static elements declared in home_page.php.
     * declare following elements here dynamically in order to make this page callable from 
     * a static html page.
     * <div id="tournament"></div>
		<div id="participants"></div>
		<div id="games"></div>
    	<div id="tournametChart" dojoType="dojox.grid.DataGrid"></div>
	    <div id="cupIdOfCurrentDisplayedChart" title=""></div>
	    <div id="cupNameOfCurrentDisplayedChart" title=""></div>
	    <div id="tournamentIdOfCurrentDisplayedChart" title=""></div>
	    <div id="tournamentNameOfCurrentDisplayedChart" title=""></div>
		<div dojoType="dojox.widget.Toaster" id="toast" positionDirection="tl-down"></div>

     */
	dojo.create("div", {id:"tournament"}, dojo.byId("tournament_area"), "first");
	dojo.create("div", {id:"participants"}, dojo.byId("tournament"));
	dojo.create("div", {id:"games"}, dojo.byId("tournament"));
	dojo.create("dojox.grid.DataGrid", {id:"tournametChart"}, dojo.byId("tournament"));
	dojo.create("div", {id:"cupIdOfCurrentDisplayedChart"}, dojo.byId("tournament"));
	dojo.create("div", {id:"cupNameOfCurrentDisplayedChart"}, dojo.byId("tournament"));
	dojo.create("div", {id:"tournamentIdOfCurrentDisplayedChart"}, dojo.byId("tournament"));
	dojo.create("div", {id:"tournamentNameOfCurrentDisplayedChart"}, dojo.byId("tournament"));
	
	dojo.create("div", {id:"username_of_selected_row"}, dojo.byId("tournament"));
	dojo.create("div", {id:"username_of_selected_column"}, dojo.byId("tournament"));
    
	dojo.create("dojox.widget.Toaster", {id:"toast"}, dojo.byId("tournament"));
	
}

function getChart(cup, tournament){
	
	//var baseurl = "<?php echo base_url() ?>";
    //console.log("div.name = " + div.name);
    //console.log("url = " + "../tournament/open/" + tournaments[key].cup + '/' + tournaments[key].tournament);
    //console.log("site url : " + "<?php echo site_url(); ?>");
	
	dojo.xhrGet({

	    url:"../tournament/open/" + cup + "/" + tournament,
	    handleAs: "json",
	    content : {
    	    "cup" : cup
    	  , "tournament" : tournament
    	  , "ajax" : "true"
	    },
	    
	    load: function(data){
	      
    	  var itemdata = data.chart.rows;
	      var structure = data.chart.columns;
	      
	      // if the colum has formatter attribute.
	      // eval to have javascript to interpret it as a function. 
	      
	      for( var i=0; i<structure.length; i++){
	    	  var col = structure[i];
	    	  try{
	    		col.formatter = eval(col.formatter);  
	    	  }catch(e){
	    		
	    	  }
	      }
	      
	      var chart = new dojo.data.ItemFileWriteStore( {data :{
	    	  identifier: 'username', 
    	      items : itemdata 
    	  }});
	      
	      dojo.attr(dojo.byId('cupIdOfCurrentDisplayedChart'), 'title', data.tournament.cup_id);
	      dojo.attr(dojo.byId('cupNameOfCurrentDisplayedChart'), 'title', data.tournament.cup_name);
	      dojo.attr(dojo.byId('tournamentIdOfCurrentDisplayedChart'), 'title', data.tournament.id);
	      dojo.attr(dojo.byId('tournamentNameOfCurrentDisplayedChart'), 'title', data.tournament.name);
	      
	      var grid = dijit.byId("tournametChart");
	      dojo.style(grid.domNode, "width", data.chart.width.toString() + "px");
	      dojo.style(grid.domNode, "height", data.chart.height.toString() + "px");
	      grid.setStore(chart);
	      grid.setStructure(structure);
	      
	    },
	    error: function(error) {
	      console.warn(new Error().stack);
	    }
	});
}

