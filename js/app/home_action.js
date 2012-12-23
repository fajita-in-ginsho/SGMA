
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



function onCheckBoxEmailNotification(event){
	
}