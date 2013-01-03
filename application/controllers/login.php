<?php
require_once(APPPATH .'/core/my_usersessioncontroller.php');

class Login extends My_UserSessionController {
	
	function __construct(){
		parent::__construct();
	}
	
	function index($retry=false){
	    
	    $is_ajax_request = (isset($_POST['ajax']) && $_POST['ajax'] === 'true');
	    
		$data['main_content'] = 'login_form';
		$data['title'] = 'Login';
		$data['retry'] = $retry;
		$data['isAjax'] = $is_ajax_request;
		if($is_ajax_request){
		    $data['copyright'] = false;
		}
		
		$this->load->view('includes/template', $data);
	}
	
	function validate_credentials(){
		if($this->users_model->validate()){
			$data = array(
			    'username'=> $this->input->post('username')
			  , 'userId' => $this->users_model->getIdByUsername($this->input->post('username'))    
			  , 'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			
			$loggedInViaAjax = $this->input->post('isAjax');
			if(isset($loggedInViaAjax) && $loggedInViaAjax == true){
			    redirect( $_SERVER['HTTP_REFERER']); 
			}else{
			    redirect('site/home');
			}
			 
		}else{
			$this->index(true);
		}
	}
	
	function addCookie(){
        try{
            $is_ajax_request = (isset($_POST['ajax']) && $_POST['ajax'] === 'true');
            $this->session->set_userdata($_POST['name'], $_POST['value']);
            $ret = json_encode(array('success' => 'true'));
            echo $ret;
        }catch(Exception $e){
            $ret = json_encode(array('success' => 'false', 'message' => $this->lang->line('error_during_adding_cookie')));
            echo $ret;
        }    
	}
	
	function signup(){
		$data['main_content'] = "signup_form";
		$data['title'] = 'Sign up';
		$this->load->view('includes/template', $data);
	}
	
	/**
	 * 
	 */
	function create_member(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('middle_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'trim|required|matches[password]');
		
		// TODO: check if username is not already in use.
		// TODO: check if email_address is not already in use and is valid email account.
		//       this would assume md5(email_address) is unique.
		
		if($this->form_validation->run()==FALSE){
			$data['main_content'] = 'signup_form';
			$data['title'] = 'Sign up';
			$this->load->view('includes/template', $data);
		}else{
			// insert data in users table.
			$now = date( 'Y-m-d H:i:s' );
			$insert_data_user = array(
				'first_name' => $this->input->post('first_name')
			  , 'middle_name' => $this->input->post('middle_name')
			  , 'last_name' => $this->input->post('last_name')
			  , 'username' => $this->input->post('username')
			  , 'password' => md5($this->input->post('password'))
			  , 'email_address' => $this->input->post('email_address')
			  , 'createdOn' => $now
			  , 'modifiedOn' => $now
			);
			
			if($this->config->item('signup_with_confirmation')){
			    // production mode.
			    $insert_data_user['randomstring'] = md5($this->input->post('email_address') . $this->input->post('username')); // make has unique
			    $user_id = $this->users_unconfirmed_model->insert($insert_data_user);
			    // send confirmation email to the account.
			    $url = site_url("login/confirm/" . $insert_data_user['randomstring']);
			    $this->mail_for_confirmation($insert_data_user, $url);
			    $data['main_content'] = 'signup_temporarily_page';
			    $data['title'] = $this->lang->line('signup_temporarily_title');
			    $this->load->view('includes/template', $data);
			}else{
			    $user_id = $this->users_model->insert($insert_data_user);
			    $data['main_content'] = 'signup_successful_page';
			    $data['title'] = $this->lang->line('signup_successfully_title');
			    $this->load->view('includes/template', $data);
			}
		}
	}
	
	function confirm($randamstring){
	    // TODO: unconfirmed_user will be deleted in shortly.
	    // the randamstring is valid for only 1 day or 2 hors, whatever.
	    	  
	    //$randamstring = urldecode($this->uri->segment(3));
	    
	    $qr = $this->users_unconfirmed_model->getByRandomstring($randamstring);
	    if(isset($qr) || count($qr) == 1){
	        $qr = $qr[0];
	    }else{
	        $data['main_content'] = 'contact_admin_page';
	        $data['title'] = $this->lang->line('contact_admin_page_title');
	        $this->load->view('includes/template', $data);
	        return;
	    }
	    
	    // insert into users
	    // delete id and randomstring from the property, to insert the object directly to users
	    $deleteId = -1;
	    if(isset($qr->id)){
	        $deleteId = $qr->id;
	        unset($qr->id);
	    }
	    if(isset($qr->randomstring)){
	        unset($qr->randomstring);
	    }
	    
	    $insertId = $this->users_model->insert($qr);
	    if(!isset($insertId)){
	        error_log("failed to insert into qr data.");
	        return;
	    }
	    
	    $this->users_unconfirmed_model->deleteById($deleteId);
	    
	    // send email.
	    $this->mail_signup_completed($qr);
	    
	    // redirect to signup successfully page.
	    $data['main_content'] = 'signup_successful_page';
	    $data['title'] = $this->lang->line('signup_successfully_title');
	    $this->load->view('includes/template', $data);
	}
	
	function logout(){
		$this->session->unset_userdata('is_logged_in');
		$this->session->sess_destroy();
		$data['main_content'] = 'logout_successful_page';
		$data['title'] = $this->lang->line('button_logout_exclamation');
		$this->load->view('includes/template', $data);
	}
	
	function mail_for_confirmation($user_info, $url){
	     
	    $to = $user_info['email_address'];
	    //$from = $user_info['email_address'];
	    $subject = $this->lang->line('app_email_subject_head') . $this->lang->line('app_email_signup_confirmation');
	
	    $message = "
	    <html><body>
	    {$this->lang->line('app_email_dear')}&nbsp {$user_info['username']},
	    <br>
	    {$this->lang->line('app_email_confirmation_message')}
	    <a href=\"{$url}\">{$this->lang->line('app_email_confirmation_link_name')}</a>
	    <br>
	    </body></html>
	    ";
	
	    $additional_header = "";
	    $additional_header .= "From: " . $this->config->item('application_email_account') . "\r\n";
	    $additional_header .= "MIME-Version: 1.0\r\n";
	    $additional_header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	     
	     
	    if(mail($to, $subject, $message, $additional_header)){
    	    // successfully sent
    	    $ret = true;
    	}else{
    	    $ret = false;
    	}
    	return $ret;
	}
	
	function mail_signup_completed($user_info){
	
	    $to = $user_info->email_address;
	    $subject = $this->lang->line('app_email_subject_head') . $this->lang->line('app_email_signup_confirmed');
	
	    $message = "
	    <html><body>
	    {$this->lang->line('app_email_dear')}&nbsp {$user_info->username},
	    <br>
	    {$this->lang->line('app_email_signup_confirmed_message')}
	    <br>
	    </body></html>
	    ";
	
	    $additional_header = "";
	    $additional_header .= "From: " . $this->config->item('application_email_account') . "\r\n";
	    $additional_header .= "MIME-Version: 1.0\r\n";
	    $additional_header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	    if(mail($to, $subject, $message, $additional_header)){
	    // successfully sent
	        $ret = true;
	    }else{
	        $ret = false;
	    }
	    return $ret;
	}
	
}

?>
