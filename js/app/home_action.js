
dojo.addOnLoad(function (){

	connectOnGridClick();
	
    var divs = dojo.query('#tournament_list .tournament_info');
	
	for(var i=0; i<divs.length; i++){
    	var div = divs[i];
    	// promise you that there's only element in each tournament_info
    	// so, it's safe to use index 0.
    	var btn = dojo.query('.tournament_button', div)[0];
    	var params = {
	        "cup"        : dojo.attr(dojo.query('.cup_name'       , div)[0], 'value')
	      , "tournament" : dojo.attr(dojo.query('.tournament_name', div)[0], 'value')
	    };
    	dojo.connect(btn, "onclick", params, dojo.partial(getChart, params.cup, params.tournament));
    	
    }
	
});



function onCheckBoxEmailNotification(){
	debugger;
	var email_checkbox = dojo.byId('email_notification');
	
	if(typeof(email_checkbox) !== "undefined"){
		var arguments = {
		    "ajax" : "true"
		  , "name" : "email_notification"
		  , "value" : email_checkbox.checked ? "true" : "false"
	 	};
		arguments[dojo.attr(dojo.byId('csrf_token_hidden_input'), 'name')] = getCsrfToken();
		
		dojo.xhrPost({
		    url: dojo.attr(dojo.byId('site_url'), 'title') + "/login/addCookie/", 
		    handleAs: "json",
		    content : arguments,
		    load : function(data){
		    	if(data.success == "true"){
			    }else if(data.success == "false"){
			    }
		    },
		    error : function (error){
		    	console.log(error);
		    	console.error(new Error().stack);
		    }
		});
	}
	
}