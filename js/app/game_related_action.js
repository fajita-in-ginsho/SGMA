

function onClickGameResult(event, gameId){
	var username_of_selected_row = dojo.byId('username_of_selected_row');
	var username_of_selected_column = dojo.byId('username_of_selected_column');
	
	var arguments = {
    	    "gameId" : gameId
	   	  , "ajax" : true
	};
	
	if(typeof username_of_selected_row !== "undefined" && typeof username_of_selected_column !== "undefined"){
		arguments['username_of_selected_row'] = username_of_selected_row.innerHTML;
		arguments['username_of_selected_column'] = username_of_selected_column.innerHTML;
	}else{
		// if main username is unknown, enter form will be ambigous. so return.
		return;
	}

	
	if(gameId != -1){
		dojo.xhrGet({

		    url:"../game/result/" + gameId, 
		    handleAs: "text",
		    content : arguments,  
		    load : function(data){
			    
		    	var dialog = dijit.byId("game_result_dialog");
		    	dialog.set('title', "Game Result");
		    	dialog.set('content', data);
		    	dialog.set('style', "width : 400px");
		    	dialog.show();
		    	/*
		    	myDialog = new dijit.Dialog({
			        title: "Game Information",
			        content: data,
			        style: "width: 300px"
			    });
			    myDialog.show();
			    */
		    },
		    error : function (error){
		    	alert(data);
		    }
		});
	}else{
		var myDialog = new dijit.Dialog({
		    title: "Message",
		    content: "can not retrieve the gameId information...",
		    style: "width:200px;"
		});
		myDialog.show();
	}	
	
}

function onClickHistory(event, threadId){
	if(threadId == -1){
		var myDialog = new dijit.Dialog({
		    title: "Message",
		    content: "history hasn't been created, so let's create one",
		    style: "width:200px;"
		});
		myDialog.show();
	}
	// if above is succeeded.
	// get URL
	location.href = "http://google.com";  
	
}

function onClickKifu(event, kifuId){
	if(kifuId == -1){
		var myDialog = new dijit.Dialog({
		    title: "Message",
		    content: "kifu is not available.",
		    style: "width:200px;"
		});
		myDialog.show();
	}else{
		var myDialog = new dijit.Dialog({
		    title: "Message",
		    content: "get the url by ajax and jump to kifu page",
		    style: "width:200px;"
		});
		myDialog.show();
	}
	
}

function onResultSubmit(event, gameId){
	if(gameId == -1){
		var myDialog = new dijit.Dialog({
		    title: "Message",
		    content: "gameId is not available.",
		    style: "width:200px;"
		});
		myDialog.show();
	}else{
		var combobox = dijit.byId('game_result_combobox');
		var gameResultDescription = combobox.get("value");
		var username_of_selected_row = dojo.byId("username_of_selected_row");
		var username_of_selected_column = dojo.byId("username_of_selected_column");
		var arguments = {
			"gameId" : gameId
		  , "ajax" : true
		  , "username_of_selected_row" : username_of_selected_row.title
		  , "username_of_selected_column" : username_of_selected_column.title
		  , "gameResultDescription" : gameResultDescription
		};
		dojo.xhrPost({

		    url:"../game/inputResult/" + gameId, 
		    handleAs: "text",
		    content : arguments,  
		    load : function(data){
			    console.log("return successfully : " + data);
		    },
		    error : function (error){
		    	alert(data);
		    }
		});
		
	}
	// close result input dialog.
	var dialog = dijit.byId("game_result_dialog");
	dialog.hide();
	// chart update.
	var params = {
	    "cup" : dojo.attr(dojo.byId('cupOfCurrentDisplayedChart'), 'title')
	  , "tournament" : dojo.attr(dojo.byId('tournamentOfCurrentDisplayedChart'), 'title')
	};
	dojo.hitch(params, getChart)();
	
}
