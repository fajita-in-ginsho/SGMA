
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
	
	var arguments = {
    	    "gameId" : gameId
	   	  , "ajax" : true
	};
	if(item != null){
		if(typeof item.username !== "undefined")
			arguments['username'] = item.username;
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
	
	
}

