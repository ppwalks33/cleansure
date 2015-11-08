<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
/*
 * Cleansure Register controller
 * 
 * Register controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Client Registration
 *  @package    Register
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Register extends Register_Controller {
	
	/*
	 * Private varaible fields
	 * Store the  fields that need validating
	 * 
	 */ 
	
	Private $fields = array();
	
	/*
	 * Private varaible errors
	 * Store the errors that coorespond to fields array
	 * 
	 */ 
	
	Private $errors = array();
	
	/*
	 * Class Constructor
	 * Load Dependancies and other core vars
	 * 
	 */ 

	public function __construct(){
		
        parent::__construct();
		
		//Load the language file for this class
		$this->lang->load('register');
		
		//Load the config file for this class
		$this->config->load('register');
		
		//Push js depencancies to current array
		$js=array_push($this->js, 'register', 'bootstrap-select.min', 'main');
		
		//Prepare the js loop for view
		$this->data['js'] = javaScript($this->js); 
		
		//Set the class for the view, this is bootrap and declared in My_Controller
		$this->data['class'] = $this->class.' '.$this->dropdown;
		
		//So we can use the session data in the view without calling session vars
		$this->data['data'] = $this->session->all_userdata();
		
		$this->data['areas'] = array(
		
										'staff' => true, 
										
										'stores'=> true, 
										
										'customers' => true, 
										
										'suppliers' => true, 
										
										'sub_contractors' => true, 
										
										'scheduals' => true, 
										
										'work_orders' => true, 
										
										'documents' => true, 
										
										'contact_book' => true, 
										
										'accounts' => true, 
										
										'control_panel' => true, 
										
										'sites' => true, 
										
										'specifications' => true, 
										
										'work_orders' => true);
		
	}
	
	/*
	 * Index Function to be initiated first
	 * 
	 * 
	 */ 
	
	public function index()
	
	{
		
		//Protect the posts array
		
		$this->posts = $this->input->post(NULL, TRUE);
		
		//For the progress bar at the top of the page
		
		$this->data['progress_header'] = $this->lang->line('register');
		
		//Set the initial value
			
		$this->data['progress_value'] = 30;
		
		//Empty var to be used later
			
		$this->data['progress'] = '';
		
		//Check if we are posting data
		
		if(!empty($this->posts))
		
		
		{
			
			// $this->email_exists($this->posts['email_address']);
			
			
			//We are posting, create some arrays to work with
			
			//all the fields that want validation
			$this->fields = array('director','first_name', 'last_name', 'gender', 'dob[]', 'company_name', 'company_type', 'address_line_1', 'city', 'postcode', 'email_address', 'daytime_telephone', 'mobile_telephone');
			
			//Correspoding errors
			$this->errors = array('required','required|min_length[3]', 'required|min_length[3]', 'required','required', 'required', 'required', 'required', 'required', 'required|postcode_check', 'required|valid_email|email_exists', 'required|validate_uk_phone', 'required|validate_uk_phone');
			
			//Set the counter
			$i=0;
			
			//Loop them and build the validation profile
			 $this->runValidator($this->fields, $this->errors);
			
				//Check for errors
			   if ($this->form_validation->run() == FALSE)
				
				  {
				  	
						//show the form and send the parameters of the failed fields
				  		$this->reg_form($this->form_validation->error_array());									
						
						//Load the view
		                $this->view($this->master);
					
					
				 }
			
			   else
			   	
				{
				
						//Create a correct date format for date of birth 
						
					//	print_r(array_slice($this->posts, 10, 6)); break;
						
						$dob = new DateTime($this->posts['dob'][2].'-'.sprintf('%02s',$this->posts['dob'][1]+1).'-'.sprintf('%02s',$this->posts['dob'][0]+1));
						
						//Lets add the post data to the session class, so we can track the user through registration process
						$this->session->set_userdata($this->posts);
						
						//Get the id from the date table for the dob
						$dob_id = $this->Registration_Model->insert_return(array('date' => $dob->format('Y-m-d')), 'date');
						
						//Add the time and date when the user registers with cleansure
						$date_id = $this->Registration_Model->insert_return(array('date' => $this->time), 'date');
						
						//Create a unique hash value from the microtime of the server
						$hash = md5( microtime (true) );
						
						//Create a salt value for later validation
						$salt = substr($hash, -20);
						
						//Add this to session to create a return url to register the new customer
						$this->session->set_userdata(array('salt' => $salt));
						
						//Return the hash id from the database
						$hash_id = $this->Registration_Model->insert_return(array('hash' =>  $hash, 'salt' => $salt), 'md5');
						
						//Create an array for inserting into the company table
						$company_id = array('company_id' => $this->Registration_Model->insert_return( array_slice($this->posts, 6, 4), 'company'));
						
						//Insert address data and merge the corresponding company id
						$address_id = $this->Registration_Model->insert_return(array_merge($company_id, array_slice($this->posts, 10, 6)), 'address');
						
						//Create User Profile array to validate email
						
						$contact_data = array_merge(array('user' => 1), $company_id);
						
						//Get the id from the database after inserting contact table
						$contact_id = $this->Registration_Model->insert_return(array_merge($contact_data, array_slice($this->posts, -5)), 'contact');
						
						//Create an array of data to be added to the user table						
						$user = array('active' => 0, 'company_id' => $company_id['company_id'], 'dob_id' => $dob_id, 'date_id' => $date_id, 'address_id' => $address_id, 'contact_id' => $contact_id, 'type' => (int)$this->config->item('signee'));
						
						//Merge the user array and the post data, insert into users and get the id
						$user_id = $this->Registration_Model->insert_return(array_merge(array_slice($this->posts, 1, 4), $user), 'users');	
										
						//Create a master array for top level configs
						$master = array('active' => 0, 'md5_id' => $hash_id, 'company_id' => $company_id['company_id'], 'user_id' => $user_id);
						
						//Return the master id
						$master_id = $this->Registration_Model->insert_return($master, 'master');
						
						//Get some more data to add to the session for later usage
						$session_data = array('master_id' => $master_id, 'user_id' => $user_id, 'company_id' => $company_id['company_id']);
						
						//Add to session class
						$this->session->set_userdata($session_data);
						
						//Redirect user upon completion
						header("Location: /register/account/");
			
				
			}

		}

		
		else 
		
		{
			
			//We are not posting so simply just show the form
			
			$this->reg_form(NULL);									
		
			//Load the master template
			
		    $this->view($this->master);
			
		}
		
		
	}

//Function where the user can choose what type of account they want

function account()

	{
		//Run the function that checks the first form has been filled out
		if($this->check())
		
		{
			 
			 
			//Get all available packages for the system
			$this->data['packages'] =  $this->cheddargetter->getPlans()->toArray();
			
			//Get the header for progress bar		
			$this->data['progress_header'] = $this->lang->line('account');
			
			//Set the progress value
			$this->data['progress_value'] = 60;
			
			//Set the class
			$this->data['progress'] = 'progress-bar-success';
			
			//Load the correct view
			$this->view($this->master);
			
		}
		
		else {
			
			//Failed the check so returned back to the index
			$this->fail_url();
		}
		
	}


function account_setup()

{
	//Again check for unauthorised access
	if($this->check())
		
		{
			
			//Protect the posts array
			$this->posts = $this->input->post(NULL, TRUE);
			//Get the header for progress bar	
			$this->data['progress_header'] = $this->lang->line('account_setup');
		    //Set the progress value
		    $this->data['progress_value'] = 90;
			//Set the class
			$this->data['progress'] = 'progress-bar-danger';
			
			//check for empty post array
			if(!empty($this->posts))
			
			{
			
			//Create an array of required fields
			$this->fields = array('signee',
			
								 'first_name', 
								 
								 'last_name', 
								 
								 'gender',  
								 
								 'email_address', 
								 
								 'daytime_telephone', 
								 
								 'mobile_telephone', 
								 
								 'username', 
								 
								 'password', 
								 
								 'password_confirm', 
								 
								 'pin', 
								 
								 'pin_confirm', 
								 
								 'signee_confirm');
			
			//Correspoding errors
			$this->errors = array('required',
			
								  'required|min_length[3]', 
								  
								  'required|min_length[3]', 
								  
								  'required',
								  
								  'required|valid_email', 
								   
								  'required|numeric|min_length[10]', 
								  
								  'required|numeric|min_length[10]',
								  
								  'required|min_length[6]', 
								  
								  'required|matches[password_confirm]|min_length[8]|alpha_numeric|password_check[1,1,1],',
								  
								  'required|matches[password]|min_length[8]|alpha_numeric|password_check[1,1,1],',
								  
								  'required|numeric|min_length[4]|max_length[4]|matches[pin_confirm]',
								  
								  'required|numeric|min_length[4]|max_length[4]|matches[pin]',
								  
								  'required');
			
		         $this->runValidator($this->fields, $this->errors);
			
				//Check for errors
			   if ($this->form_validation->run() == FALSE)
				
				  {
				  	
						//show the form and send the parameters of the failed
				  		$this->signUp(NULL, $this->data['data'], $this->form_validation->error_array());	
														
						//Load the view
		                $this->view($this->master);
					
					
				 }
			
			   else
			   	
				{
					//No errors so we start building data for the database
					$this->posts = array_merge($this->posts, $this->data['data']);
					
					//Update the company table
					$this->Registration_Model->update_row($this->posts['company_id'], 'id', 'company', array('master_id' => $this->posts['master_id']));
					
					//Get the encrypted password 
					$password = $this->Auth_model->hash_password($this->posts['password']);
					
					//Add some salt to the mix
					$salt = $this->Auth_model->salt();
					
					//Create an array then add them to the table
					$hash_id = $this->Registration_Model->insert_return(array('hash' =>  $password, 'salt' => $salt), 'md5');
					
					//Create a list of permissions
					$restrictions = array_merge($this->data['areas'], array('user_id' => $this->posts['user_id'], 'master_id' => $this->posts['master_id']));
					
					//Set the permissions as open for main user account
					$this->Registration_Model->insert($restrictions, 'restrictions');
					
					   //We need to check if the are having a second account for admin
						if(array_key_exists('signee_check', $this->posts))
					
							{
								//All the same so we update the users table
								$this->Registration_Model->update_row($this->posts['user_id'], 'id', 'users', array('active' => true, 'type' => (int)$this->config->item('signee_admin'), 'master_id' => $this->posts['master_id']));
							}
							
						     else
							
							{
					
								/*
								 * 
								 * Need to do this part, need to simply insert some new data
								 * 
								 * for the user 
								 * 
								 */ 
							}
					
					//Create a login profile 		
					$login = array('username' => $this->posts['username'], 
					
								   'md5_id' => $hash_id, 
								   
								   'user_id' => $this->posts['user_id']);
								   
					//Create a master profile			   
					$master = array('security_pin' => $this->posts['pin'], 
					
									'active' => true, 
									
									'package_id' => $this->data['package__id'] );
									
					//Insert the records into login table				
					$this->Registration_Model->insert($login , 'login');
					
					//Update the master table				
					$this->Registration_Model->update_row($this->posts['master_id'], 'id', 'master', $master);
					
					//We are all done here so redirect them to login and get started		
					header("Location:".base_url()."clientarea/login");			
					
				}
			
			}
			
			else {
				
				{
					
					
					//We are not posting so simply load the form
					$this->signUp(NULL, $this->data['data'], NULL);
					
					//Load the view
					$this->view($this->master);
					
				}
			}
	
		}
		
		else 
		
		{
			
			//Failed the check so redirect them back to main screen			
			$this->fail_url();
			
		}
	
}


/*
 * Ajax get requests here
 */
 
/*
 * Gets the address form and finds the address from Google Maps
 * 
 */ 
 
Public Function address_finder()

 {
 	
 	echo $this->addressFinder();
	
 }
 
 //The get request to send the payment data to chedder Getter
 
Public function payment($package, $id)

{
	//Update session vars with chosen package data
	$this->session->set_userdata(array('package' => $package, 'package__id' => $id));
	
	//Quickly override data array some ammended session data
	$this->data['data'] = $this->session->all_userdata();
	
	//Some attributes for the hidden form, these fields are required by Chedder Getter
	$atts = array('code', 'subscription[planCode]', 'first_Name', 'last_Name', 'email', 'company');
	
	//Start the counter
	$i=0;
	
	//Loop the attributes array
	foreach ($atts as $a)
		
		{
			//Increment the counter	
			$i++;
			
			//Replace the underscore with white space
			$f = str_replace('_', '',$a);
			
			//Explode the keys based upon parameter
			$t = explode( '[', $f );	
					
			//Array key is view var, manipulate data to get the correct values for the value attribute	
			$this->data[$t[0]] = array('name' => ($i == 2 ? $a : $f),
			
									   'class' => $this->class,
								
								       'type' => 'hidden',
										
								      'value' => ($i==1 ? $this->data['data']['master_id'].$this->data['data']['salt']:
								    
								    		   ($i==2 ? $package:($i > 2 && $i < 5 ? $this->data['data'][strtolower($a)] : 
											   
											   ($i ==5 ? $this->data['data'][$a.'_address'] : ($i== 6 ? $this->data['data'][$a.'_name']:NULL))))));
											   
			
		}
		
	//Assign the package 
	$this->data['package'] = $package;
	
	//Get a view file to send data back with
	$this->load->view('register/modules/payment', $this->data);
	
}




/*
 * Private function below here
 * The following functions will be inherited by the class
 * and will be used 
 * 
 */
 
 
 /*
  * Signup form
  * 
  * It builds all the attributes based upon cl form helper class
  */
 
Private function signUp($check=false, $data=NULL, $fields=NULL)

{
	
	$this->title();
	
	$atts = array('first_name', 'last_name', 'e-mail_address', 'daytime_telephone', 'evening_telephone', 'mobile_telephone', 'fax_number', 'username', 'password', 'password_confirm', 'pin', 'pin_confirm');
		
		$i=0;
		
		foreach ($atts as $a)
		
		{
			$i++;
			
			$ph = explode('_' , $a);
			
			$f = str_replace('-', '',$a);
				
			$this->data[$f] = array('name' => $f,
			
									'class' => $this->class,
								
								    'type' => ($i > 8 && $i < 11 ? 'password':'text'),
										
								    'placeholder' => ucwords($ph[0].'&nbsp;'.(!empty($ph[1]) ? ucwords($ph[1]):NULL)).'..',
										
									'style' => ((is_array($fields)) && (array_key_exists(str_replace('-','',$a), $fields)) ? $this->border : NULL),
										
									'value' => (array_key_exists($f, $data) ? $data[$f] : $this->input->post($f)));
			
		}
}
 
private function reg_form($fields=NULL) 

{
	/*
	 * Uses a set of functions from the core functs class
	 */ 
	
	$this->title();   
										
	$this->dob();
	
	$this->address($fields);
	
	for($i=0;$i<5;$i++)
	
	{
							
	$this->form_data($fields, NULL, $i);
	
	}
	
}

/*
 * Checks for an array key which is provided 
 * 
 * once the registration form has been correctly filled out
 * 
 */

Private function check()

{
	 return array_key_exists('salt', $this->session->all_userdata());
	
}

/*
 * The fail url for any checks that dont meet the criteria
 * 
 * 
 */

Private function fail_url()

{
	
	return header('Location:'.base_url().'register');
}

}
