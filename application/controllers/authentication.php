<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',0);
ini_set('display_errors',0);
error_reporting(-0);
/*
 * Cleansure Login controller
 * Login controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * @category   Auth system
 * @package    Auth
 * @author     Original Author contact@gofishwebdesign.com
 * @copyright  2014 Gofish Web Design
 * @version    Release: Code Version 1.1
 * 
 */

class Authentication extends Login_Controller {
	
	//Form Validation fields
	
	Private $fields = array();
	
	//Form Validation errors
	
	Private $errors = array();
	
	//Private variable for this class
	Private $usercheck;
	
	
	//Class constructor
	public function __construct(){
		
        parent::__construct();	
		
		//$js=array_push($this->js, 'register', 'bootstrap-select.min', 'main');
		
		$this->data['js'] = javaScript($this->js); 
		
		$this->data['class'] = $this->class.' '.$this->dropdown;
		
	}
	
	
	
	public function index()
	
	{
		
	
		//Move post data to protected var
		$this->posts = $this->input->post(NULL, TRUE);
		
		//Username data
		$this->data['username'] = array('name' => 'username', 
					
										'type' => 'text' , 
										
										'class' => $this->class,
										
										'placeholder' => 'Please Enter Your Username',
										
										'value' => (array_key_exists('username', $this->session->all_userdata()) ? $this->session->userdata('username') : NULL),
										
										'other' => true);
										
		//Password field								
		$this->data['password'] = array('name' => 'password', 
					
										'type' => 'password' , 
										
										'class' => $this->class,
										
										'placeholder' => 'Please Enter Your Password',
										
										'other' => true);
										
		//Checking for post data								
		if(!empty($this->posts) && $this->auth->is_blocked() === false)
		
		{
			
			echo 'here';
				
		    //Add username to current session
			$this->session->set_userdata('username', $this->posts['username']);
			
			//check for login attempts
			$this->auth->login_attempts();
						
				//Check that the username exists
			    $this->usercheck =  $this->auth_model->user_name_exists($this->posts['username']);
				
				echo 'here';
					
			     //check that they meet the criteria
				if($this->usercheck === true)
			
					{						
						
						$this->session->set_userdata('counter', 0);
						
						$u = $this->auth_model->get_row('login', 'username', $this->posts['username']);	
									
						
					if($this->auth->log_in($u->user_id, $this->posts['username']) == true) 
						
						{
							
							$this->createSessionVars($u->user_id);
							
														
							$this->auth->success();
							
						}
		
				
					}

					else 
					
					{
						
						
			
										
							$this->session->set_flashdata('message', $this->usercheck);
							//Redirect the user
							$this->auth->fail_url();
								
					}
			
		}
		
		else 
		
		{
			
			echo $this->auth->is_blocked();
				
			//Show the message from the blocked function in the Auth class
			$this->session->set_flashdata('message', $this->auth->is_blocked());
			
		}
		
		 //Load the view up
		 $this->view($this->master);
		
		
	}

Public function logout()
	
	{		
		$this->session->set_flashdata('message', $this->auth->logout());
		
		$this->auth->fail_url();
		
	}


/*
 * 
 * Login Private Functions here
 * 
 * 
 */
 
 Private function createSessionVars($user_id)

{
	
	$sessionVars = $this->auth_model->get_user_vars($user_id);
	
	foreach($sessionVars[0] as $key => $var)
	
	{
		
		$this->session->unset_userdata($key);
		
		$this->session->set_userdata($key, $var);
		
	}
	
}
 



}