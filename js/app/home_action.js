function onGridClickOnGame(event, item, gameId){
	var columnName = event.cell.field;
	var arguments = {
    	    "gameId" : gameId
	   	  , "ajax" : true
	};
	
	if(item != null){
		if(typeof item.username[0] !== "undefined")
			arguments['username_of_selected_row'] = item.username[0];
	}
	if(columnName != null){
		arguments['username_of_selected_column'] = columnName;
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
	debugger;
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
	var columnName = event.cell.field;
	var item = event.grid.getItem(event.rowIndex);
	
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



dojo.addOnLoad(function (){
    
    var grid = dijit.byId("tournametChart");
    dojo.connect(grid, "onClick", null, onGridClick);
    
    // tournaments is defined in home_page.php
    console.log("tournamets.length: " + tournaments.length);
    for(var key in tournaments){
    	
    	var divId = tournaments[key].cup + tournaments[key].tournament;
    	var div = dojo.byId(divId);
    	
        var params = {
            "cup" : tournaments[key].cup
          , "tournament" : tournaments[key].tournament
        };
        
        dojo.connect(div, "onclick", params, getChart);
    }
});
        
function getChart(context){
	
	//var baseurl = "<?php echo base_url() ?>";
    //console.log("div.name = " + div.name);
    //console.log("url = " + "../tournament/open/" + tournaments[key].cup + '/' + tournaments[key].tournament);
    //console.log("site url : " + "<?php echo site_url(); ?>");

	dojo.xhrGet({

	    url:"../tournament/open/" + this.cup + "/" + this.tournament,
	    handleAs: "json",
	    content : {
    	    "cup" : this.cup
    	  , "tournament" : this.tournament
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
	      
	      var chart = new dojo.data.ItemFileReadStore( {data :{
	    	  identifier: 'username', 
    	      items : itemdata 
    	  }});
	      
	      dojo.attr(dojo.byId('cupOfCurrentDisplayedChart'), 'title', data.tournament.cup_name);
	      dojo.attr(dojo.byId('tournamentOfCurrentDisplayedChart'), 'title', data.tournament.name);
	      
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

// TODO
/*
window['chart_grid']にして
var item = window['chart'].getItem(event.rowIndex);
var gameId = item.getValue('gameId'+event.cell.field?);
これをするためにはcolumをkunioとかusernameじゃなくてuserId, gameId+userIdのcolumnを足して、且つ
表示はuserIdではなくusernameでlayout, structureでなんとかする。
参考
http://dojotoolkit.org/reference-guide/1.7/dojox/grid/DataGrid.html
	http://tnomura9.exblog.jp/6650685/
それで
dojo.xhrGet( getGame(gameId)) でdialogを表示。
dialogにはhistory, kifu, 結果入力などのボタンが入る。
var item = window['chart'].getItem(event.rowIndex);
*/