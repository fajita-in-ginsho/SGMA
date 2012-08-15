<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/import_requirement.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/game_related_action.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/home_action.js"></script>


<div id="game_form">

	<h1>Game Information</h1>
	<h2>game : <?php echo $game->name; ?></h2>
	<div id="players">
	<?php
	    foreach($players as $player){
	        echo "
	        <p>player : $player->username</p>
	        ";
	    } 
	?>
	</div>
	<div id="username_of_selected_row">
	<?php
	    echo '<p>username : ';
	    if(isset($username)){
	        echo $username;
	    }else{
	        echo "unknown";
	    }
	    echo '</p>';
	?>
	</div>
	<div id="kifuId"><p>kifuId : <?php echo $game->kifuId; ?></p></div>
	<div id="tournament_name"><p><?php echo $tournament->name; ?></p></div>
	<div id="gameId"><p><?php echo $game->gameId; ?></p></div>
	<div id="game_date"><p><?php echo $game->date; ?></p></div>
    <div id="isAjax"><p>Ajax : <?php echo $isAjax; ?></p></div>
    
	
	<button dojoType="dijit.form.Button" type="button" onClick="onClickGameResult(event, <?php echo $game->gameId;?>);">
            Input Result
    </button>
    <button dojoType="dijit.form.Button" type="button" onClick="onClickHistory(event, <?php echo $game->threadId; ?>);">
            History
    </button>
    <button dojoType="dijit.form.Button" type="button" onClick="onClickKifu(event, <?php echo $game->kifuId; ?>);">
            Kifu
    </button>
    <br>
    <br>
	
</div>


<script type="text/javascript">
//TODO: あたらしいページで開くときは、うまくいってないので、
//<script type="text/javascript" src="event_dialog_button.js" 的なことをしましょう。>

// ajaxがオンの場合、（たいていのばあdialogで表示されるんで、addOnLoadは呼ばれない。
/*
var isAjax = eval("<?php echo $isAjax;?>");
if(isAjax==false){
	dojo.addOnLoad(function(){
	    dojo.connect(dojo.byId("game_result"), "onclick", null,  onClickGameResult);
	    dojo.connect(dojo.byId("history_button"), "onclick", null,  onClickHistory);
	    dojo.connect(dojo.byId("kifu_button"), "onclick", null,  onClickKifu);
	});
}
*/
</script>

