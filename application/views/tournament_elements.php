

<div id="tournament_area" class="claro" >
    <div id="tournament"></div>
    <div id="participants"></div>
    <div id="games"></div>
    <div id="tournametChart" dojoType="dojox.grid.DataGrid"></div>
    
    <div id="cupIdOfCurrentDisplayedChart" title=""></div>
    <div id="cupNameOfCurrentDisplayedChart" title=""></div>
    <div id="tournamentIdOfCurrentDisplayedChart" title=""></div>
    <div id="tournamentNameOfCurrentDisplayedChart" title=""></div>
    
    <div id="username_of_selected_row"></div>
    <div id="username_of_selected_column"></div>
    
    <div dojoType="dojox.widget.Toaster" id="toast" positionDirection="tl-down"></div>
    
    <div id="message_dialog" dojoType="dijit.Dialog"></div>
    <div id="game_dialog" dojoType="dijit.Dialog"></div>
    <div id="user_dialog" dojoType="dijit.Dialog"></div>
    <div id="login_dialog" dojoType="dijit.Dialog"></div>
    <div id="game_result_dialog" dojoType="dijit.Dialog"></div>
    <div id="thread_dialog" dojoType="dijit.Dialog"></div>
    <div id="thread_change_date_dialog" dojoType="dijit.Dialog"></div>
    
    <!-- some static variables -->
    <div id="game_result_title" title="<?php echo $this->lang->line('tournament_game_result_title');?>"></div>
    <div id="thread_history_title" title="<?php echo $this->lang->line('tournament_thread_history_title');?>"></div>
    <div id="login_title" title="<?php echo $this->lang->line('tournament_login_title');?>"></div>
    <div id="change_date_title" title="<?php echo $this->lang->line('tournament_change_date_title');?>"></div>
    <div id="game_infomation_title" title="<?php echo $this->lang->line('tournament_game_infomation_title');?>"></div>
    <div id="user_infomation_title" title="<?php echo $this->lang->line('tournament_user_infomation_title');?>"></div>
    <div id="message_title" title="<?php echo $this->lang->line('tournament_message_title_title');?>"></div>

    
    <div id="base_url" title="<?php echo base_url() ?>"></div>
    <div id="site_url" title="<?php echo site_url() ?>"></div>
</div>
