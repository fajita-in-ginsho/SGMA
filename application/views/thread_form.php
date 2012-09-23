
<div id="thread_form">

	<textarea id="comment_area" dojoType="dijit.form.Textarea" type="button" style="width:100%; min-height:40px;"></textarea>
	<p>
    <button dojoType="dijit.form.Button" type="button" onClick="onClickThreadComment(event);">Comment</button>
    <p>
	<div id="threads">
	<?php
	    foreach($comments as $comment_obj){
	        echo "
	        <div id='comment'>
	            <p>$comment_obj->username&nbsp;:&nbsp;$comment_obj->createdOn</p>
	            <p>$comment_obj->comment</p>
	        </div>
	        ";
	    } 
	?>
	</div>
	
	
    <br>
	
</div>


