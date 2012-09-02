<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/import_requirement.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/common.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/game_related_action.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/home_action.js"></script>


<div id="thread_change_date_form">

    <div>
    I request to change the date to <p id="requesting_change_date"></p>
    </div>
    <!-- 
    <div data-dojo-type="dijit.Calendar" data-dojo-props="onValueSelected:onChangeCalendar, onChnage:onChangeCalendar"></div>
     -->
	<div id="requesting_date" data-dojo-type="dijit.form.DateTextBox" data-dojo-props="onValueSelected:onChangeCalendar, onChnage:onChangeCalendar"></div>
    <div id="requesting_time" data-dojo-type="dijit.form.TimeTextBox" data-dojo-props="onValueSelected:onChangeCalendar, onChnage:onChangeCalendar"></div>
    
	<button dojoType="dijit.form.Button" type="button" onClick="onSubmitChangeDate(event);">OK</button>
    <button dojoType="dijit.form.Button" type="button" onClick="onCancelChangeDate(event);">Cancel</button>
    
    
    <br>
	
</div>


