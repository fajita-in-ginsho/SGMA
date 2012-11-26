
<?php 
require_once(APPPATH .'/core/my_usersessioncontroller.php');

class Kifu extends My_UserSessionController{

	function __construct(){
		parent::__construct();
	}
	
	function url(){
	    
	    $is_ajax_request = false;
	    if(count($_POST) > 0){
	        $is_ajax_request = ($_POST['ajax'] === 'true');
	        if(!isset($kifuId)){
	            $kifuId = $_POST['kifuId'];
	        }
	    }
	    
	    if(!$is_ajax_request){
	        $kifuId = urldecode($this->uri->segment(3));
	    }
        
	    $kifu = $this->kifu_model->getById($kifuId);
	    if(isset($kifu)){
	        $data['success'] = 'true';
	        $data['url'] = $kifu->URL;
	    }else{
	        $data['success'] = 'false';
	        $data['content'] = $this->lang->line('error_kifu_url_not_available');
	    }
	    $string = json_encode($data);
	    echo $string;
	    
	}
	
}


?>
