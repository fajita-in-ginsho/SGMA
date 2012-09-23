
function onClickGameResult(event, gameId){
	var username_of_selected_row = dojo.byId('username_of_selected_row');
	var username_of_selected_column = dojo.byId('username_of_selected_column');
	
	var arguments = {
    	    "gameId" : gameId
	   	  , "ajax" : true
	};
	
	if(typeof username_of_selected_row !== "undefined" && typeof username_of_selected_column !== "undefined"){
		arguments['username_of_selected_row'] = username_of_selected_row.title;
		arguments['username_of_selected_column'] = username_of_selected_column.title;
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
	var arguments = {
	    "threadId" : threadId
   	  , "ajax" : true
	};
	arguments['username_of_selected_row'] = dojo.byId('username_of_selected_row').title;
	arguments['username_of_selected_column'] = dojo.byId('username_of_selected_column').title;
		
	if(threadId == -1){
		
	}else{
		
	}
	
	dojo.xhrPost({

	    url:"../thread/open/" + threadId, 
	    handleAs: "text",
	    content : arguments,  
	    load : function(result){
		    
	    	var dialog = dijit.byId("thread_dialog");
	    	dialog.set('title', "Thread History");
	    	dialog.set('content', result);
	    	dialog.set('style', "width : 500px");
	    	dialog.show();
		    
	    },
	    error : function (error){
	    	alert(data);
	    }
	});
	
	// close thread. 
	
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
		    load : function(result){
			    
			    // it says, boolean_result, however, boolean is converted to 0 or 1 during serialization. i guess.
			    if(result == 1){
			    	console.log("return successfully : " + result);
			    	// chart update.
					var params = {
					    "cup" : dojo.attr(dojo.byId('cupOfCurrentDisplayedChart'), 'title')
					  , "tournament" : dojo.attr(dojo.byId('tournamentOfCurrentDisplayedChart'), 'title')
					};
					dojo.hitch(params, getChart)();
			    }else{
			    	console.log("error detected!");
			    }
			    
		    },
		    error : function (error){
		    	alert(data);
		    }
		});
		
	}
	// close result input dialog.
	var dialog = dijit.byId("game_result_dialog");
	dialog.hide();
	
}


function onClickThreadComment(event){
	// TODO: new line char is inclided in innerHTML. put it in tilte instead.
	// just like , arguments['username_of_selected_row'] = username_of_selected_row.title;
	
	var textarea = dijit.byId("comment_area");
	var comment = textarea.get("value");
	
	if( (typeof(comment) !== "undefined") && comment != "" ){
		var arguments = {
			"gameId" : dojo.attr(dojo.byId("gameId"), 'title')
		  , "ajax" : true
		  , "comment" : comment
		  , "threadId" : dojo.attr(dojo.byId("threadId"), 'title') 
		};
		dojo.xhrPost({

		    url:"../thread/addComment/" + threadId, 
		    handleAs: "json",
		    content : arguments,  
		    load : function(result){
			    /*
			     * result['threadId'] integer
			     * result['result'] = bool
			     * result['comment'] = string
			     */
		    	
			    // it says, boolean_result, however, boolean is converted to 0 or 1 during serialization. i guess.
		    	if(result['result'] == true){
			    	console.log("adding the comment just inserted on success");
			    	var comment = dojo.create(
			    	    'div'
			    	  , { id:'comment', innerHTML:
			    		  "<p>" + result['username'] + " : " + result['commentOn'] + "</p>" + 
			    		  "<p>" + result['comment'] + "</p>" 
			    		}
			    	);
			    	
			    	dojo.place(comment, dojo.byId('threads'), 'last');
			    	// clear out the textarea.
			    	var textarea = dijit.byId("comment_area");
			    	textarea.reset();
			    	
			    }else{
			    	console.log("error detected!");
			    }
			    
		    },
		    error : function (error){
		    	alert(data);
		    }
		});
	}
}


function onClickChangeDate(event){
	/*
	 * date change の画面を出す。confirmで相手、管理者に変更通知メール、相手はメール
	 * 届いたら、confirmを押しことで、変更が成立、
	 * その際、スレッドにその内容をついkあする。ex. ply1 が2012/08/21に変更を確認しました。etc
	 */
	var arguments = {
	   	"ajax" : true
	  ,	"gameId" : dojo.attr(dojo.byId("gameId"), 'title')
	};
	
	dojo.xhrPost({

	    url:"../thread/changeDateForm/", 
	    handleAs: "text",
	    content : arguments,  
	    load : function(form){
		    
	    	var dialog = dijit.byId("thread_change_date_dialog");
	    	dialog.set('title', "Chnage Date");
	    	dialog.set('content', form);
	    	dialog.set('style', "width : 300px");
	    	dialog.show();
		    
	    },
	    error : function (error){
	    	alert(data);
	    }
	});
}

function onChangeCalendar(value){
	var requesting_change_date = dojo.byId('requesting_change_date');
	requesting_change_date.innerHTML = dojo.date.locale.format(value, {formatLength: 'full', selector:'date'});
}

function onSubmitChangeDate(event){
	/*
	 * send to server side the date, requestor and opponent.
	 * send email to the opponent and admin
	 * write "requested was sent to him in email, wait for their confirmation"
	 * if error was detected in the server side, write the reason for the error in comment 
	 * in the thread.
	 */
	var gameId= dojo.attr(dojo.byId("gameId"), 'title');
	var date = dijit.byId('requesting_date');
	var date_value = dojo.attr(date, 'value');
	var toast = dijit.byId("toast");
	
	if(date_value == "Invalid Date"){
		//showMessage("date is not entered!");
		if(typeof toast !== "undefined"){
			toast.setContent('Please specify the date.', "MESSAGE", 500);
		}
		return;
	}
	// TODO: how to use/send date in javascript to php. is it string? same question for time.
	var time = dijit.byId('requesting_time');
	var time_value = time.getValue();
	
	if(time_value == null){
		//showMessage("time is not entered!");
		if(typeof toast !== "undefined"){
			toast.setContent('Please specify the time.', "MESSAGE", 500);
		}
		return;
	}
	
	
	//valudate the entered value.
	//if it's past! raise an error. if it's exactly same date and time as the default, let him know so.
	var default_date = new Date(date._resetValue);
	var default_time = new Date(time._resetValue);
	if(date_value.getFullYear() == default_date.getFullYear() &&
	   date_value.getMonth()    == default_date.getMonth()    &&
	   date_value.getDate()     == default_date.getDate()     &&
	   time_value.getHours()   == default_time.getHours()     &&
	   time_value.getMinutes() == default_time.getMinutes()   ){
	   // no need to check the second
	    if(typeof toast !== "undefined"){
		    toast.setContent('You have selected the same date.', "MESSAGE", 500);
		}
		return;
	}
	
	var date_json = dojo.toJson(
			{ 
		      yyyy : date_value.getFullYear()
			, MM   : date_value.getMonth() + 1
			, dd   : date_value.getDate()
			, HH   : time_value.getHours()
			, mm   : time_value.getMinutes()
			, ss   : time_value.getSeconds()
			}
	);
	 
	var arguments = {
	   	"ajax" : true
	  , "gameId" : gameId
	  , "datetime" : date_json
	  , "threadId" : dojo.attr(dojo.byId("threadId"), 'title')
	};
	
	
	//window.open("../thread/requestChangeDate/" + "true/" + gameId + "/" + date_json);
	dojo.xhrPost({

	    url:"../thread/requestChangeDate/", 
	    handleAs: "text",
	    content : arguments,  
	    load : function(result){
		    // write the returned text in comment.
	    	
	    },
	    error : function (error){
	    	alert(data);
	    }
	});
	
	dijit.byId("thread_change_date_dialog").hide();
}



function onResetChangeDate(event){
	dijit.byId("requesting_date").reset();
	dijit.byId("requesting_time").reset();
}


function onCancelChangeDate(event){
	dijit.byId("thread_change_date_dialog").hide();
}
