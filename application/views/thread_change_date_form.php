
<div id="thread_change_date_form">

    <div>
    I request to change the date to <p id="requesting_change_date"></p>
    </div>
    <!-- 
    <div data-dojo-type="dijit.Calendar" data-dojo-props="onValueSelected:onChangeCalendar, onChnage:onChangeCalendar"></div>
     -->
	<input 
	id="requesting_date" 
	data-dojo-type="dijit.form.DateTextBox" 
	value="<?php echo date('Y-m-d', strtotime($current_date->date)); ?>" 
	data-dojo-props="onValueSelected:onChangeCalendar, onChnage:onChangeCalendar"/>
	
	
    <input
    id="requesting_time" 
    data-dojo-type="dijit.form.TimeTextBox"
    value="T<?php echo date('H:i:s', strtotime($current_time->date)); ?>"
    
    data-dojo-props="onValueSelected:onChangeCalendar, onChnage:onChangeCalendar"/>
    
      
	<button dojoType="dijit.form.Button" type="button" onClick="onSubmitChangeDate(event);">OK</button>
	<button dojoType="dijit.form.Button" type="button" onClick="onCancelChangeDate(event);">Cancel</button>
	<button dojoType="dijit.form.Button" type="button" onClick="onResetChangeDate(event);">Reset</button>
    
    
    <br>
	
</div>


