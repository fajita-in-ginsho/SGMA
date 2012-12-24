
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
		
		url: dojo.attr(dojo.byId('site_url'), 'title') + "/tournament/update/",
	    handleAs: "text",
	    postData : arguments,  
	    load : function(data){
	    },
	    error : function (error){
	    	console.log(error);
	    }
	});
}


function onChangeNote(note){
	var grid = dijit.byId("tournametChart");
	var index = grid.selection.selectedIndex;
	if(index == -1) return;
	var item = grid.getItem(index);
	if(typeof(item) === "undefined") return;
	debugger;
	console.log(note);
	
	var arguments = {
	    "ajax" : "true"
	  , "tournamentId" : dojo.attr(dojo.byId('tournamentIdOfCurrentDisplayedChart'), 'title')
	  , "username" : item.username[0]
	  , "field" : "note"
	  , "value" : note
 	};
	arguments[dojo.attr(dojo.byId('csrf_token_hidden_input'), 'name')] = getCsrfToken();
	
	dojo.xhrPost({

	    url: dojo.attr(dojo.byId('site_url'), 'title') + "/tournament/update/", 
	    handleAs: "json",
	    content : arguments,
	    load : function(data){
	    	debugger;
		    if(data.success == "true"){
		    	//var store = grid.store;
		    	//store.setValue(item, 'note', note);
		    	//grid.update();
		    }
	    },
	    error : function (error){
	    	console.log(error);
	    	console.error(new Error().stack);
	    }
	});
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

			url: dojo.attr(dojo.byId('site_url'), 'title') + "/game/open/" + gameId, 
		    handleAs: "text",
		    content : arguments,  
		    load : function(data){
		    	var dialog = dijit.byId("game_dialog");
		    	dialog.set('title', dojo.attr(dojo.byId('game_infomation_title'), 'title'));
		    	dialog.set('content', data);
		    	dialog.set('style', "width : 300px");
		    	dialog.show();
		    },
		    error : function (error){
		    	console.log(error);
		    	console.error(new Error().stack);
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

		url: dojo.attr(dojo.byId('site_url'), 'title') + "/user/open/" + arguments['username'], 
	    handleAs: "text",
	    content : arguments,  
	    load : function(data){
	    	var dialog = dijit.byId("user_dialog");
	    	dialog.set('title', dojo.attr(dojo.byId('user_infomation_title'), 'title'));
	    	dialog.set('content', data);
	    	dialog.set('style', "width : 300px");
	    	dialog.show();
	    },
	    error : function (error){
	    	console.log(error);
	    	console.error(new Error().stack);
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
	}else if(columnName == "note"){
		
	}
	
}



function getChart(cup, tournament){
	
	var arguments = {
	    "cup" : cup
  	  , "tournament" : tournament
  	  , "ajax" : true
    }; 
	
	dojo.xhrGet({

		url: dojo.attr(dojo.byId('site_url'), 'title') + "/tournament/open/" + cup + "/" + tournament,
	    handleAs: "json",
	    content : arguments,
	    load: function(data){
	    	showChart(data);
	    },
	    error: function(error) {
	    	console.log(error);
	    	console.error(new Error().stack);
	    }
	});
}


function showChart(data){
    
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
    debugger;
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
}

function connectOnGridClick(){
	var grid = dijit.byId("tournametChart");
    dojo.connect(grid, "onClick", null, onGridClick);
}



