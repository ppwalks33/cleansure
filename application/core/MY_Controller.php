<?php

class MY_Controller extends CI_Controller {
	
	//Jquery base starting point`
	Public $js =array('redactor');
	
	//Protect the post array
	Protected $posts = array();
	
	//Var to hold the allowed ips..
	Private $allowed;
	
	
		//Main constructor		
   		public function __construct() {
   					
        parent::__construct();
		
		//Load the helpers
		$this->load->helper(array('form', 'language', 'system', 'url'));
		
		/*
		 * ################# !WARNING   #########################################
		 * 
		 * ################# Turn off IP config for live site ###################
		 * 
		 * 
		 */ 
		
		//Load the libraries
		$this->load->library(array('form_validation', 'session','auth', 'uploader'));
		
		//Load the ip config
		$this->config->load('ips');
		
		//Get the allowed ips.
		$this->allowed = $this->config->item('ips');
		
		//Get the current time
		date_default_timezone_set('Europe/London');
		
		$this->time = date("Y-m-d H:i:s");
			
		//Bootstrap class for form helper array
		$this->class = 'form-control';
		
		//Custom select styling
		$this->dropdown = 'selectpicker show-tick';
		
		//Border Color for validation
		$this->border = 'border-color: #A94442;';
		
		//Autoload Views 
		$this->folder = $this->uri->segment(1);
		
		//View Prefix
		$this->prefix = $this->uri->segment(2);
		
		//Check if not index view, if not add a prefix
		$this->view = '/'.$this->uri->segment(1).(!empty($this->prefix) ? '_'.$this->prefix:NULL);
		
		//Use the prefix in the template to disable features
		$this->data['prefix'] = $this->prefix;
		
		$this->file_ext = '_'.$this->uri->segment(3);
		
		$this->posts = $this->input->post(NULL, TRUE);
		
		//Central modules folder..
		$this->clientarea = 'clientarea/modules/';
		
		
		if(!in_array($this->input->ip_address(), $this->allowed)) {
			
			exit('You do not have access to this area!');
		}
			
    }	
		
	
	/*
	 * Global Function 
	 */
	 
	 function runValidator($fields, $errors)
	 
	 {
	 	
		//Set the counter
			$i=0;
			
			//Loop them and build the validation profile
			foreach ($fields as $f)
		
					{
						//Validate
						$this->form_validation->set_rules($f, error_name($f), $errors[$i]);
						//Increment the counter
						$i++;
						
		             }
					
					//Set the delimiter, this is for kieran really
				    $this->form_validation->set_error_delimiters('<small class="help-block form-error">', '</small>');
	 }
	 
	 
	 function warning($notification)
	 
	 {
	 	
		$this->data['warning'] = $this->lang->line($notification);
						 
		echo json_encode(array_merge($this->form_validation->error_array(), array('warning' => $this->load->view('/clientarea/modules/flashmessagewarning', $this->data, true))));
						
		return false;
		
	 }
	 
	
	 /*
	  * Function to autoload the views.
	  * available to all classes
	  * 
	  */
	  
	 public function view($master, $Directory=NULL, $file_ext=NULL)
	
	 {
		//Create the file structure
		$this->data['page'] = $this->folder.
								//Does it have a directory, if so pass it through
								($Directory == NULL ? NULL : '/'.$Directory)
								//Use the pre-determined view data
							    .$this->view.
							    //Are we in the system if so, add the crud extensions
							    ($file_ext == NULL ? NULL: $file_ext);	
			
		//Load the view
		$this->load->view($master, $this->data);		
	 	
	 }
}

class Core_Funcs extends MY_Controller {
	
	 public function __construct() {
		
        parent::__construct();
		
		$this->load->library(array('cleansure'));
		
		$this->load->model(array('Registration_Model', 'Auth_model', 'Alerts_Model'));
		
		/*
	 	 * We need to check the form elements
	 	 * to see if they need to be arrays, 
	 	 * if so set to true
		 * 
	 	 */  
	
		$this->data['arr'] = false;
		
		$this->data['na'] = "<span class=\"na\">N/A</span>\n";
		
		//Contact fields for the loop
		$this->data['contactfields'] = array('daytime_telephone', 'evening_telephone', 'mobile_telephone', 'fax_number', 'email_address');
		
		//Address fields for the loop
		$this->data['addressfields'] = array('address_line_1', 'address_line_2', 'address_line_3', 'city', 'region', 'postcode');
		
		//Move post data to protected var
		$this->posts = $this->input->post(NULL, TRUE);

	 }

/*
 * 
 * core functions for certain controllers, not all,
 * 
 *  children can extend this...
 * 
 * 
 */	 

	Protected function addressFinder()
 	
 	{
 	    //XSS Clean the post vars	
 		$this->posts = $this->input->post(NULL, TRUE);
		//Have we go post data
		  if (!$this->posts)
		
		    {
				//Array for number field
				$this->data['number'] = array('name' => 'house_number', 
				
											  'class' => $this->class, 
											  
											  'placeholder' => 'House Number..');
				//Array for postcode field
				$this->data['postcode'] = array('name' => 'postcode', 
				
											    'class' => $this->class , 
											    
											    'placeholder' => 'Post Code..');
												
				//Array for flat field
				$this->data['flat'] = array('name' => 'flat', 
				
										    'class' => $this->class , 
										    
										    'placeholder' => 'Flat, Apartment or Building Name (Optional)..');
 				//Load the view and pass the data	
				$this->load->view('modules/addressFinder', $this->data);
	
		}
		
		else 
		
		{
			//Post vars available, run through lookup function for Google Api
			$data = $this->cleansure->postcode_lookup($this->posts['postcode']);
			
			//Have a look through database to get the region name from postcode
			$region = $this->Registration_Model->get_row('counties','postcode', substr(trim($this->posts['postcode']),0,-3));
			
			//Return the results
			return json_encode(array_merge($data, array('region' => $region->region, 'house_number' => $this->posts['house_number'], 'postcode' => $this->posts['postcode'], 'house_name' => $this->posts['flat'])));			
		}
		
 }

/*
 * Function for company data, 
 * this is used in registration, customers
 * 
 */ 
 
 	Protected function form_data($fields=NULL, $data=NULL, $key=NULL)
	
	{
		
		$atts = array(
		
					  array('first_name', 'last_name'),
					  
					  array('e-mail_address', 'daytime_telephone', 'evening_telephone', 'mobile_telephone', 'fax_number'),
					  
					  array('company_name','company_number', 'vat_number'),
					  
					  array('dob'),
					  
					  array('city', 'postcode'),
					  
					  array('title', 'message')
					  				  
					  );
		
		return $this->company_data($fields, $data, $atts[$key]);
		
		
	}


    Private function company_data($fields, $data, $atts)

     {
		
		$c=0;
		
		foreach ($atts as $a)
		
		{
			
			$ph = explode('_' , $a);
			
			$f = str_replace('-', '',$a);
				
			 $this->data[$f] = array('name' => $f,
			 
			 						 'data-name' => $f,
			
									 'class' => $this->class,
								
								     'type' => 'text',
										
								     'placeholder' => ucwords($ph[0].'&nbsp;'.(!empty($ph[1]) ? ucwords($ph[1]):NULL)).'..',
										
									 'style' => ((is_array($fields)) && (array_key_exists(str_replace('-','',$a), $fields)) ? $this->border : NULL),
										
									 'value' => (!empty($data) ? $data->$f : set_value($f)));
									 
									 		 
			
		$c++;							 

		}
		
		 $this->data['c_opts'] = array(''=>'Please Select Type', 
		   					
		   								'Sole Trader'=>'Sole Trader', 
		   									
		   								'Partnership'=>'Partnership', 
		   									
		   								'Limited Partnership'=>'Limited Partnership', 
		   									
		   								'Limited Company'=>'Limited Company', 
		   									
		   								'Limited Liability Partnership'=>'Limited Liability Partnership');
										
										
										return false;
		
}


Protected function address($fields=NULL, $data=NULL)

{
	 //Retieve unique county data from db
										
	 $this->data['counties_ops'] = $this->Registration_Model->get_all('counties','region', 'country_string');
	 
	// print_r($this->data['counties_ops']);
	
	//build the address part of the form
												  
		 					for ($i=1; $i < 4; $i++)
							
							{
								
								$adress = 'address_line_'.$i;
								
								 $this->data[$adress] = array('name' => $adress,
								 
								 				  'data-name' => $adress,
			
												  'class' => $this->class,
								
										          'type' => 'text',
										          
												  'style' => ((is_array($fields)) && (array_key_exists($adress, $fields)) ? $this->border : NULL),
										
										          'placeholder' => 'Address Line '.$i.'..',
												  
												  'value' => (!empty($data) ? $data->$adress : set_value($adress)));
												  
							}
	
}
	 
	
/*
 * We use the title dropdown more than once 
 * 
 * so we can recall it in this class
 */

Protected function title()

{
	$this->data['t_opts'] = array('Mr'=>'Mr', 'Mrs'=>'Mrs', 'Ms'=>'Ms', 'Miss'=>'Miss', 'Dr'=>'Dr', 'Prof'=>'Prof', 'Fr'=>'Fr', 'other'=>'other');
	
	$this->data['g_opts'] = array(''=>'Please Select Gender', 'Male'=>'Male', 'Female'=>'Female');
	
}

Protected function dob($fields=NULL) {
	
	//Date of birth processing
	
	//Days and months for the dropdown
	
	//Dates array outer loop
	$dates = array('day' => '31', 'month' => '12');
	
	foreach ($dates as $key => $val)
		{
			for ($i = 1; $i <= $val; $i++) 
			{
				$this->data[$key][$i] = $i;

			}

	}
	//Years for the dropdown
	//Get this year and minus 15
	 $year = date('Y') - 15;	
	//subtract 80 for "for loop" counter	
     $past = $year - 80;
	 //Decrement from most recent year
	 for($y=$year; $y >= $past; $y--)
	 
	 {
	 	//build the array
		$this->data['year'][$y] = $y;
		
	 }	
	
}

Protected function financial($fields=NULL, $data=NULL)

{
	
	  $this->data['financials'] = array('payroll_number', 'bank', 'branch', 'sort_code','account_number', 'roll_number', 'account_name');
	  
	  foreach ($this->data['financials'] as $a)
		
		{
			
			
			 $f = str_replace('_', '',$a);
				
			 $this->data[$a] = array('name' => $a,
			 
			 						 'data-name' => $a,
			
									 'class' => $this->class,
								
								     'type' => 'text',
										
								     'placeholder' => ucwords($f).'..',
										
									 'style' => ((is_array($fields)) && (array_key_exists(str_replace('-','',$a), $fields)) ? $this->border : NULL),
										
									 'value' => (!empty($data) ? $data->$a : set_value($a)));
			
		}
	
}

Protected function pagination($slug=NULL, $array=array(), $prefix, $segment=NULL, $qty = NULL) 
	
	{
		
		$this->load->library("pagination");
			
			$quantity = ($qty != NULL ? $qty:35); 
			

				$start = $this->uri->segment($segment); // this is auto-incremented by the pagination class
				
					if(!$start) $start = 0; // default to zero if no $start

					// slice the array and only pass the slice containing what we want (i.e. the $config['per_page'] number of records starting from $start)
						$this->data['pageData'] = array_slice($array, $start, $quantity);

						$config['base_url'] = base_url().$slug;

						$config['uri_segment'] = $segment;
						
						$config['total_rows'] = count($array);
						
						$config['per_page'] = $quantity;

								$this->pagination->initialize($config);

						$this->data[$prefix] = $this->pagination->create_links(); 
		
		
		
	}

	
}

class Clientarea_Controller extends Core_Funcs {
	
	public $master = 'clientarea'; 
	
	
    public function __construct(){
		
        parent::__construct();
		
		if(!$this->auth->is_logged_in() == true) {
			 
			
			show_404();

		}
		
		else 
		
		{
			
			//Check session has not expired on us
			
			$user_id = $this->session->userdata('user_id');
       
       			if(!$user_id) {
       				
				//If it has log the user out...
            
     			header('Location: /clientarea/logout/', '301');
      
	  	      }
				
			/*
			 * Messages will be site wide so we need to load the 
			 * 
			 */ 
			
			$this->load->model('messages_model');
			
			/*
			 * Load the cleansure library
			 * 
			 */ 
			
			
			$this->load->library('cleansure');
			
			/*
			 * To attach form class on the fly
			 */ 
			
			$this->data['class'] = $this->class.' '.$this->dropdown;
			
			
			
			/*
			 * Display the message count on each page
			 * 
			 */ 
			 
			/*
			 * Logged in data, make this available in views and
			 * 
			 * controller functs
			 */
		
		    $this->data['data'] = (object)$this->session->all_userdata();
			
			/*
			 * We need to check for any alerts upon logging into the system
			 * 
			 * Do we have a valid session var, if not we run the update alerts function.
			 */ 
			   $this->updateAlerts();
			   
			   //Update the data object
			   
			   $this->data['data'] = (object)$this->session->all_userdata();
			  
			
			 
			//print_r($this->data['data']);
			/*
			 * For true false bootstrap glyphicons
			 */
			 
		    $this->data['glyphs'] = array('glyphicon glyphicon-remove', 'glyphicon glyphicon-ok'); 	
			
		}
		
		
		
		
		
	}

/*
 * Update alerts function, this will be used to initiate and refresh
 * 
 * messages/ alerts.
 * 
 */

Protected function updateAlerts()

{
	//Create an array of alerts by querying the db
	
	$alertData = array(
                       
                         'messageCount'  => $this->messages_model->count_tasks('recipitent', 
																			
																			    array('recipitent_id' => $this->data['data']->user_id, 'status' => '1')
																			
																			   ),
																			   
                         'alertCount'     => $this->messages_model->count_tasks('events', 
																			
																			     array('master_id' => $this->data['data']->master_id, 'status' => '1')
																			
																			      )
                   
               );
		
		
      //Add/ Update session Vars
      
    return  $this->session->set_userdata($alertData); 
	
 }
	
}

class Login_Controller extends MY_Controller {
	
	public $master = 'login'; 
	
    public function __construct() {
		
        parent::__construct();
		
		$this->load->model(array('Auth_model'));

	
		
	}
}

class Register_Controller extends Core_Funcs {
	
	public $master = 'register'; 
	
    public function __construct() {
		
        parent::__construct();
		
		
		$this->load->library(array('cheddargetter/cheddargetter'));
		
    }    

	
}

class Public_Controller extends MY_Controller {
	
    public function __construct(){
		
        parent::__construct();
		
    }    

	
}
