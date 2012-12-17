
function onClickGameResult(gameId){
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
			url: dojo.attr(dojo.byId('site_url'), 'title') + "/game/result/" + gameId, 
		    handleAs: "text",
		    content : arguments,  
		    load : function(data){
			    
		    	var dialog = dijit.byId("game_result_dialog");
		    	dialog.set('title', dojo.attr(dojo.byId('game_result_title'), 'title'));
		    	dialog.set('content', data);
		    	dialog.set('style', "width : 400px");
		    	dialog.show();
		    	
		    },
		    error : function (error){
		    	// MEMO:
		    	// I tried to get title and html in a xhrGet by return them in json.
		    	// but, I kept gettring syntax error. couldn't figure how to encode
		    	// html in server side in order to dodge the error. finally, I decided
		    	// to get title in a seperate xhrGet. 
		    	// eventually, I incorporate the title in the div, the retrieve it
		    	// on demand.
		    	console.log(error);
		    	console.error(new Error().stack);
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

function onClickHistory(threadId){
	var arguments = {
	    "threadId" : threadId
   	  , "ajax" : true
	};
	arguments['username_of_selected_row'] = dojo.byId('username_of_selected_row').title;
	arguments['username_of_selected_column'] = dojo.byId('username_of_selected_column').title;
	arguments[dojo.attr(dojo.byId('csrf_token_hidden_input'), 'name')] = getCsrfToken();
	
	dojo.xhrPost({
		
		url: dojo.attr(dojo.byId('site_url'), 'title') + "/thread/open/" + threadId, 
	    handleAs: "text",
	    content : arguments,
	    load : function(result){
		    
	    	var dialog = dijit.byId("thread_dialog");
	    	dialog.set('title', dojo.attr(dojo.byId('thread_history_title'), 'title'));
	    	dialog.set('content', result);
	    	dialog.set('style', "width : 500px");
	    	dialog.show();
		    
	    },
	    error : function (error){
	    	console.log(error);
	    	console.error(new Error().stack);
	    }
	});
}

function getCsrfToken(){
	
	
	var csrfHiddenInput = dojo.byId('csrf_token_hidden_input');
	var csrfName = dojo.attr(csrfHiddenInput, 'name');
	if(typeof(csrfName) === "undefined"){
		return;
	}
	
	var token = "";
	
	token = dojo.attr(csrfHiddenInput, 'value');
	
	// if cookie is available, you can get it from cookie, 
	// however, since I couldn't get it. I use hidden input.
	// token = dojo.cookie(csrfName);
	return token;
}

function onClickKifu(kifuId){
	
	var arguments = {
	    "ajax" : "true"
	  , "kifuId" : kifuId
	};
	
	arguments[dojo.attr(dojo.byId('csrf_token_hidden_input'), 'name')] = getCsrfToken();
	
	
	// TODO: DONE
	// dojo.xhrPost didn't work, but haven't figured out why.
	// A. it was because of the csrf protection
	dojo.xhrPost({

	    url: dojo.attr(dojo.byId('site_url'), 'title') + "/kifu/url/", 
	    handleAs: "json",
	    content : arguments,
	    load : function(data){
	    	
		    if(data.success == "true" && data.url != ""){
		    	//document.location = data['url'];
		    	// TODO: open in a new tab as default behavor.
		    	open_in_new_tab(data.url);
		    }else{
		    	var dialog = dijit.byId("message_dialog");
		    	dialog.set('title', dojo.attr(dojo.byId('message_title'), 'title'));
		    	dialog.set('content', data['content']);
		    	dialog.set('style', "width : 200px");
		    	dialog.show();
		    }
	    },
	    error : function (error){
	    	console.log(error);
	    	console.error(new Error().stack);
	    }
	});
	
}

function onClickLogin(){
	var arguments = {
	    "ajax" : true
	};
	
	arguments[dojo.attr(dojo.byId('csrf_token_hidden_input'), 'name')] = getCsrfToken();
	
	
	dojo.xhrPost({

		url: dojo.attr(dojo.byId('site_url'), 'title') + "/login/index/", 
	    handleAs: "text",
	    content : arguments,
	    load : function(result){
		    
	    	var dialog = dijit.byId("login_dialog");
	    	dialog.set('title', dojo.attr(dojo.byId('login_title'), 'title'));
	    	dialog.set('content', result);
	    	dialog.set('style', "width : 200px");
	    	dialog.show();
		    
	    },
	    error : function (error){
	    	console.log(error);
	    	console.error(new Error().stack);
	    }
	});
}

function onClickLogout(){
	var arguments = {
		   	  "ajax" : true
	};
	
	arguments[dojo.attr(dojo.byId('csrf_token_hidden_input'), 'name')] = getCsrfToken();
	
	dojo.xhrPost({

		url: dojo.attr(dojo.byId('site_url'), 'title') + "/login/logout/", 
	    handleAs: "text",
	    context : arguments,
	    load : function(result){
	    },
	    error : function (error){
	    	console.log(error);
	    	console.error(new Error().stack);
	    }
	});
	
	var dialog = dijit.byId("game_dialog");
	dialog.hide();
}


function onResultSubmit(gameId){
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
		var isResultChanged = (gameResultDescription != combobox.attr('_resetValue'));
		
		var textbox = dijit.byId("kifu_url_textbox");
		var kifuURL = textbox.get("value");
		var isURLChanged = ((typeof(kifuURL) !== "undefined") && (kifuURL != textbox.attr('_resetValue')));
		
		var arguments = {
			"gameId" : gameId
		  , "ajax" : true
		  , "username_of_selected_row" : username_of_selected_row.title
		  , "username_of_selected_column" : username_of_selected_column.title
		  , "isResultChanged" : isResultChanged
		  , "gameResultDescription" : gameResultDescription
		  , "isURLChanged" : isURLChanged
		  , "kifuURL" : kifuURL
		};
		dojo.xhrGet({

			url: dojo.attr(dojo.byId('site_url'), 'title') + "/game/inputResult/" + gameId, 
		    handleAs: "json",
		    content : arguments,  
		    load : function(data){
			    debugger;
			    // it says, boolean_result, however, boolean is converted to 0 or 1 during serialization. i guess.
			    if(data.success == 'true'){
			    	// chart update.
					var params = {
			    	    "cup" : dojo.attr(dojo.byId('cupNameOfCurrentDisplayedChart'), 'title')
			    	  , "tournament" : dojo.attr(dojo.byId('tournamentNameOfCurrentDisplayedChart'), 'title')
			    	};
			    	//dojo.hitch(params, getChart)();
					getChart(params.cup, params.tournament);
			    }else{
			    	console.log("error: data.success is =>" + data.success);
			    }
		    },
		    error : function (error){
		    	console.log(error);
		    	console.error(new Error().stack);
		    }
		});
	}
	// close result input dialog.
	var dialog = dijit.byId("game_result_dialog");
	dialog.hide();
}


function onClickThreadComment(){
	
	var textarea = dijit.byId("comment_area");
	var comment = textarea.get("value");
	
	if( (typeof(comment) !== "undefined") && comment != "" ){
		var arguments = {
			"gameId" : dojo.attr(dojo.byId("gameId"), 'title')
		  , "ajax" : true
		  , "comment" : comment
		  , "threadId" : dojo.attr(dojo.byId("threadId"), 'title') 
		};
		
		arguments[dojo.attr(dojo.byId('csrf_token_hidden_input'), 'name')] = getCsrfToken();
		
		dojo.xhrPost({

			url: dojo.attr(dojo.byId('site_url'), 'title') + "/thread/addComment/" + arguments["threadId"], 
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
			    	
			    	dojo.place(comment, dojo.byId('threads'), 'first');
			    	// clear out the textarea.
			    	var textarea = dijit.byId("comment_area");
			    	textarea.reset();
			    	
			    }else{
			    	console.log("error detected!");
			    }
			    
		    },
		    error : function (error){
		    	console.log(error);
		    	console.error(new Error().stack);
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
	
	dojo.xhrGet({

		url: dojo.attr(dojo.byId('site_url'), 'title') + "/thread/changeDateForm",
	    //postData : arguments,
	    content : arguments,
	    handleAs: "text",
	    load : function(form){
		    
	    	var dialog = dijit.byId("thread_change_date_dialog");
	    	dialog.set('title', dojo.attr(dojo.byId('change_date_title'), 'title'));
	    	dialog.set('content', form);
	    	dialog.set('style', "width : 300px");
	    	dialog.show();
		    
	    },
	    error : function (error){
	    	console.log(error);
	    	console.error(new Error().stack);
	    }
	});
}

function onChangeCalendar(value){
	var requesting_change_date = dojo.byId('requesting_change_date');
	requesting_change_date.innerHTML = dojo.date.locale.format(value, {formatLength: 'full', selector:'date'});
}

function onSubmitChangeDate(){
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
	
	
	dojo.xhrGet({

		url: dojo.attr(dojo.byId('site_url'), 'title') + "/thread/requestChangeDate/", 
	    handleAs: "text",
	    content : arguments,
	    //content : arguments,  
	    load : function(result){
	    },
	    error : function (error){
	    	console.log(error);
	    	console.error(new Error().stack);
	    }
	});
	
	dijit.byId("thread_change_date_dialog").hide();
}



function onResetChangeDate(){
	dijit.byId("requesting_date").reset();
	dijit.byId("requesting_time").reset();
}


function onCancelChangeDate(){
	dijit.byId("thread_change_date_dialog").hide();
}
