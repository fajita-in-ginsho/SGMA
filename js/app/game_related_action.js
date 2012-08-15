

function onClickGameResult(event, gameId){
	var myDialog = new dijit.Dialog({
	    title: "Result", 
	    content: 'gameId : ' + gameId,
	    style: "width:200px;"
	});
	myDialog.show();
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

