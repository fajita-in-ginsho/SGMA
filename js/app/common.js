//dojo.require("dijit.Dialog");


function showMessage(message, title, style){
	
	if(typeof title === "undefined"){
		title = "";
	}
	
	if(typeof style === "undefined"){
		style = "width:200px;";
	}
	
	var myDialog = new dijit.Dialog({
	    title: title
	  , content: message
	  , style: style
	});
	myDialog.show();	
}
