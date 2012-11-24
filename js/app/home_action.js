
dojo.addOnLoad(function (){

	//createTournamentElements();
	
	connectOnGridClick();
	
    // tournaments is defined in home_page.php
    console.log("tournamets.length: " + tournaments.length);
    for(var key in tournaments){
    	
    	var divId = tournaments[key].cup + tournaments[key].tournament;
    	var div = dojo.byId(divId);
    	
        var params = {
            "cup" : tournaments[key].cup
          , "tournament" : tournaments[key].tournament
        };
        
        dojo.connect(div, "onclick", params, dojo.partial(getChart, params.cup, params.tournament));
    }
});