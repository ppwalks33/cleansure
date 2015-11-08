<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',0);
ini_set('display_errors',0);
error_reporting(0);
/*
 * Cleansure Accounts controller
 * Accounts controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * @category   Clientarea
 * @package    Accounts
 * @author     Original Author contact@gofishwebdesign.com
 * @copyright  2014 Gofish Web Design
 * @version    Release: Code Version 1.1
 * 
 */

class Accounts extends Clientarea_Controller {
	
	//Form Validation fields
	
	Private $fields = array();
	
	//Form Validation errors
	
	Private $errors = array();
	
	
	
	//Class constructor
	public function __construct()
	
	{
		
        parent::__construct();	
		
		$this->load->model('auth_model');
		
		//Load the config file for this class
		$this->config->load('auth');
		
		$js=array_push($this->js, 'bootstrap-select.min', 'bootstrap-datepicker','main', 'live');
		
		$this->data['js'] = javaScript($this->js); 
		
		$this->data['level'] = array('1' => 'root', '2' => 'signee_admin', '3' => 'admin', '5' => 'user');
		
		$this->data['modules'] = 'clientarea/accounts/modules/';
		
		$this->data['permissions'] = array( '1' => 'r/w/d', '2' => 'r', '3' => 'x');
		
		$this->data['areas'] = array('staff', 'stores', 'customers', 'suppliers', 'sub_contractors', 'scheduals', 'work_orders', 'documents', 'contact_book', 'accounts', 'control_panel', 'sites', 'specifications');
		
	}
	
	
	
	Public function index($master_id)
	
	{
										
		$levels = array(1,2,3,5);
		
		$args = array('users.master_id' => $this->data['data']->master_id, 'users.company_id' => $this->data['data']->company_id);
		
		$this->data['accounts'] = $this->auth_model->get_accounts($args, $levels);
		
	//	print_r($this->data['accounts']);
		
		$this->view($this->master, $this->prefix);
		
		
	}
	
	
	
	Public function new_account($master_id)
	
	{
			//check for empty post array
			if(!empty($this->posts))
			
			{
			
			//Create an array of required fields
			$this->fields = array('first_name', 
								 
								 'last_name', 
								 
								 'email_address', 
								 
								 'username', 
								 
								 'password', 
								 
								 'password_confirm');
			
			//Correspoding errors
			$this->errors = array('required|min_length[3]', 
								  
								  'required|min_length[3]', 
								  
								  'required|valid_email|email_exists', 
								  
								  'required|min_length[6]|user_exists', 
								  
								  'required|matches[password_confirm]|min_length[8]|alpha_numeric|password_check[1,1,1],',
								  
								  'required|matches[password]|min_length[8]|alpha_numeric|password_check[1,1,1],');
			
		         $this->runValidator($this->fields, $this->errors);
				 
				  if ($this->form_validation->run() == FALSE)
				
				  {
				  	
						// send the parameters of the failed through json to the model
				  		
				  		echo json_encode( $this->form_validation->error_array()) ;	
														
						return false;
					
					
				 }
			
			   else
			   	
				{
					
					
					//Get the encrypted password 
					$password = $this->Auth_model->hash_password($this->posts['password']);
					
					//Add some salt to the mix
					$salt = $this->Auth_model->salt();
					
					//Add the time and date when the user registers with cleansure
					$date_id = $this->Registration_Model->insert_return(array('date' => insert_date($this->time)), 'date');
					
					//Create an array then add them to the table
					$hash_id = $this->Registration_Model->insert_return(array('hash' =>  $password, 'salt' => $salt), 'md5');
					
					
					$contact_id = $this->Registration_Model->insert_return(array_slice($this->posts,4,6), 'contact');
					
					
					$u_id = $this->Registration_Model->insert_return(
					
						
																		array_merge(
																		
																		
																					array_slice($this->posts,0,4), 
																					
																					
																					array('contact_id' => $contact_id, 'master_id' => $this->data['data']->master_id, 'date_id' => $date_id, 'company_id' => $this->data['data']->company_id)
																					
																					), 'users');
					
					
					$login = array('username' => $this->posts['username'], 'user_id' => $u_id, 'md5_id' => $hash_id);
					
					
					$this->Registration_Model->insert($login, 'login');
					
					
					$perms = array();
					
					
					$perms['user_id'] = $u_id;
					
					
					$perms['master_id'] = $this->data['data']->master_id;
					
					
					foreach($this->data['areas'] as $area)
					
					{
						
					$perms[$area] = 2;	
						
					}
					
					$this->Registration_Model->insert($perms, 'restrictions');
					
					echo json_encode(array('message' => 'Account Created!'));
		
		            return false;
					
				}
				
				
				 
				 } else {

		
		$this->form();
		
		$this->view($this->master, $this->prefix, $this->file_ext);
		
		}
		
		
	}

function edit($user_id)

{
	
	/*
	 * Get the data about the user
	 * 
	 */ 
	
	$this->data['user'] = $this->auth_model->get_user($user_id);
	
	/*
	 * Are we Posting
	 * 
	 */ 
	
	
	if(!empty($this->posts))
	
	{
		
		/*
		 * Fields & Error Arrays
		 * 
		 */ 
		
		//Create an array of required fields
			$this->fields = array('first_name', 
								 
								 'last_name', 
								 
								 'email_address', 
								 
								 'username', 
								 	
										);
			
			//Correspoding errors
			$this->errors = array('required|min_length[3]', 
								  
								  'required|min_length[3]', 
								  
								  'required|valid_email', 
								  
								  'required|min_length[6]', 
								  
								  );
								  
		/*
		 * Create a variable to check whether the password fields 
		 * 
		 * have been submitted. Auto set to false.
		 */ 
								  
		$passcheck= false;
								  
			if($this->posts['password'] != '')
			
			{
				
				/*
				 * We are changing password, mark passcheck to true
				 * 
				 * Append the error array to the lists for validation.
				 * 
				 */ 
				
				$passcheck = TRUE;
				
				array_push($this->fields, 'password', 'password_confirm');
				
				array_push($this->errors, 'required|matches[password_confirm]|min_length[8]|alpha_numeric|password_check[1,1,1],',
								  
								          'required|matches[password]|min_length[8]|alpha_numeric|password_check[1,1,1]');
			}
			
			
			/*
			 * Run the validator
			 * 
			 * 
			 */ 
			
		         $this->runValidator($this->fields, $this->errors);
				 
				 /*
				  * Is it Valid?
				  * 
				  */ 
				 
				  if ($this->form_validation->run() == FALSE)
				
				  {
				  	
						// send the parameters of the failed through json to the model
				  		
				  		echo json_encode( $this->form_validation->error_array()) ;	
														
						return false;
					
					
				 }
			
			   else
			   	
				{
					
					/*
					 * All Past the checks, lets update some data..
					 * 
					 */ 
					 
					if($passcheck == true)
					
					{
						
						//Get the encrypted password 
						$password = $this->Auth_model->hash_password($this->posts['password']);
						
						/*
						 * Update the password table...
						 * 
						 */ 
						
						$this->auth_model->update_row($this->data['user']->md5_id, 'id', 'md5', array('hash' => $password));
						
					}
					
						/*
						 * Update users table
						 * 
						 */ 
					
						$this->auth_model->update_row($user_id, 'id', 'users', array_slice($this->posts,1,3));
						
						/*
						 * Update the contact table
						 * 
						 */ 
						
						
						$this->auth_model->update_row($this->data['user']->contact_id, 'id', 'contact', array_slice($this->posts,5,5));
						
						/*
						 * Update the username
						 * 
						 */ 
						
						
						$this->auth_model->update_row($this->data['user']->login_id, 'id', 'login', array('username' => $this->posts['username']));
						
						/*
						 * Return a JSON Message
						 * 
						 */ 
						
						echo json_encode(array('message' => 'Account Updated!'));
		
		            	return false;
						

				}
					
		
	}
	
	else 
	
	{
		
		/*
		 * Show the form
		 * 
		 */ 
		
	    $this->form($this->data['user']);
		
		/*
		 * Load the view
		 * 
		 */ 
	
	    $this->view($this->master, $this->prefix, $this->file_ext);
		
		
	}
	
	
}

/*
 * Function to sort permissions
 * 
 */ 

Public function permissions($user_id)

{
	
	/*
	 * Are we posting
	 * 
	 */ 
	
	if(!empty($this->posts))
	
	{
		
		/*
		 * Update the restrictions table
		 * 
		 */ 
		
		$this->auth_model->update_row($user_id, 'user_id', 'restrictions', $this->posts);
		
		/*
		 * Return a json encoded message
		 * 
		 */ 
		
		echo json_encode(array('message' => 'Permissions Changed'));
		
		
		
		return false;
	}
	
	/*
	 * We need get the current permissions
	 * 
	 */ 
	
	$this->data['permission'] = $this->auth_model->get_row('restrictions', 'user_id', $user_id);
	
	/*
	 * Load the view...
	 * 
	 */ 
	
	
	$this->load->view($this->data['modules'].'permissions', $this->data);
	
}
	
	


/*
 * 
 * Accounts Private Functions here
 * 
 * 
 */

 Private function form($data=false) 
 
 {
 	
	/*
	 * Go to parent class and get from atts
	 * 
	 * Get the users fields 
	 */
 	
	    $this->title();
		
		/*
		 * Get the rest of the form field in the below loop
		 * 
		 * 
		 */
		
		for($i=0;$i<2;$i++)
		
		{
			
			$this->form_data(NULL, ($data != false ? $data:NULL) ,  $i);
			
		}
		
 }


}