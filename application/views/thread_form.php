<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/import_requirement.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/game_related_action.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/home_action.js"></script>


<div id="thread_form">

	<h1>Thread</h1>
	<div id="threads">
	<?php
	    foreach($comments as $comment_obj){
	        echo "
	        <div id='comment'<p>$comment_obj->comment</p></div>
	        ";
	    } 
	?>
	</div>
	
	<textarea id="comment_area" dojoType="dijit.form.Textarea" type="button" style="width:200px;"></textarea>
    <button dojoType="dijit.form.Button" type="button" onClick="onClickThreadComment(event);">Comment</button>
    <button dojoType="dijit.form.Button" type="button" onClick="onClickChangeDate(event);">Change Date</button>
    
    <br>
	
</div>


