<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//ini_set('display_startup_errors',1);
//ini_set('display_errors',1);
error_reporting(0);
/*
 * Cleansure Sites controller
 * 
 * Sites controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Sites
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Sites extends Clientarea_Controller {
	
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
	
	
	//Class constructor
	Public function __construct(){
		
        parent::__construct();	
		
		$this->load->model(array('sites_model', 'specifications_model'));
		
		$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker', 'main', 'live', 'sites', 'lightbox');
		
		$this->data['js'] = javaScript($this->js); 
		
		$this->file_ext = '_'.$this->uri->segment(3);
		
		$this->posts = $this->input->post(NULL, TRUE);
		
		$this->load->helper('directory');
		
		$this->load->library('uploader');
		
		
		
	}
	
	/*
	 * Sites overview page 
	 * 
	 */ 

	Public function index($company_id)
	
	{
		
		
		
		$this->data['sites'] = $this->sites_model->get_sites($company_id);
		
		$this->data['company_info'] = $this->sites_model->get_row('company', 'id', $company_id);
				
		$this->view($this->master, $this->prefix);
			
		
	}
	
	/*
	 * Function to display the profile page
	 * 
	 * We load the site data and load appending contact lists
	 * 
	 */
	
	
	Public function profile($site_id)
	
	{
		
		
		
		/*
		 * Get customer data
		 * 
		 */
		  
		$this->data['customer_data'] = $this->sites_model->site_profile($site_id);
		
		
		
		/*
		 * Use the uploader class which handles our upload structures
		 * 
		 * Send our params for this section and create a returned path..
		 */ 			   
		
		$dir = $this->uploader->create_path(array(
				
					  								$this->data['data']->company_name, 
							 
					   								$this->data['customer_data'][0]->company_name)
													
												);													
				
				/*
				 * Do we have folder structure yet?
				 * 
				 * 
				 */ 														
		
				if($this->uploader->folder_exists($dir) == false)
		
					{
						
						/*I
						 * Nope lets create one then!
						 */ 
					
						$this->uploader->create_dir($dir, true);
			
					}
          
		  //For lightbox we send the path
		  
		  $this->data['path'] = './uploads/'.$dir.'/qa';
		  	
		  /*
		   * Load the map function to scan the correct folder for spec
		   */ 	
		   
		   
	     $map = directory_map($this->data['path']);
		 
		 
		 /*
		  * Run the mapped array through a sorting function..
		  * 
		  */ 
		 
		 $this->data['folders'] = $this->uploader->sort_folders($map);
		 
	 
		
		 /*
		  * Get site contacts
		  * 
		  */ 
				
		$this->data['site_contacts'] = $this->sites_model->site_contacts($site_id);
		
		/*
		 * Get the last spec created
		 * 
		 */ 
		
		
		$this->data['last_spec'] = $this->specifications_model->last_site_spec($site_id);
		
		
		$last_qa = $this->specifications_model->last_qa($this->data['data']->master_id);
		
	
		
		
		
		
		/*
		 * Get the previous score data regarding QA
		 * 
		 */
		  
		$this->data['previous_score'] = $this->specifications_model->previous_score($site_id, 2, $last_qa->unique);
		
		/*
		 * Have we got previous score data?
		 * 
		 */ 
		
		if($this->data['previous_score'] != false)
		
		{
			
			for($i=0;$i<count($this->data['previous_score']);$i++)
			
			{
			
				$this->data['score'][$i] = $this->specifications_model->calculate_score($this->data['previous_score'][$i]['overall'], $this->data['previous_score'][$i]['score'], 'score');
			
			   $this->data['myScore'][$i] = $this->specifications_model->difference($this->data['score'][$i][2], $this->data['score'][$i][0]);
			   
			   
			}
			
			
		}
		
		$this->view($this->master, $this->prefix, $this->file_ext);
	}
	
	/*
	 * Our google maps function, this may be moved to parent class 
	 * 
	 * We send the postcode to google to retrieve some co-ordinates
	 * 
	 * This allows us to set the marker to the sites location
	 * 
	 */ 


  function maps($postcode="")

  {
  	
	/*
	 * Use the get co-ords function inside the cleansure main library file
	 * 
	 */ 
	 
	$my_cords = $this->cleansure->get_cords($postcode);
	
	/*
	 * Have we got an array?
	 * 
	 */ 
	
	if(is_array($my_cords))
	
	{
		
		$co_ords = implode(',', $my_cords);
	
		/*
	 	 * Load the Google maps library, this generates javascript based upo params
	     * 
	     */ 
	
		$this->load->library('googlemaps');
	
		/*
	 	 * Tell the libarary we a loading through ajax (Asynchronously)
	 	 * 
	 	 */ 
	
		$config['loadAsynchronously'] = TRUE; 
	
		/*
	 	 * Put a delay on it so ajax has enough time to get the data
	 	 * 
	 	 */ 
	
		$config['loadAsynchDelay'] = 7000;
	
		/*
	 	 * We show the map based on our params, getting the correct location
	 	 * 
	 	 */ 
	
		$config['center'] = $co_ords;
	
		 /*
	 	  * Set a zoom value for the map so we can display more/less data
		  * 
		  */ 

		$config['zoom'] = '17';
	
		 /*
	 	  * Initialize the above settings
	 	  * 
	 	  */ 
	
		$this->googlemaps->initialize($config);
	
		/*
	 	 * Create a marker array
	 	 * 
	 	 */ 

		$marker = array();
	
		/*
	 	 * Lets use site co-ords to place a marker on the map
	 	 * 
	 	 */ 
	
		$marker['position'] = $co_ords;
	
		 /*
	 	  * Run the add marker function in the Google maps class
	  	  * 
	 	  */ 

		$this->googlemaps->add_marker($marker);
	
		/*
	 	 * Generate the map data through the google class
	     * 
	 	 */ 

		$this->data['map'] = $this->googlemaps->create_map();
		
		/*
	     * Return the view with the map data on it
	     * 
	     */ 

	   $this->load->view('modules/map', $this->data);
	
	}
	
      else
	  	
	{
		
		/*
		 * Invalid Postcode, return the correct message!
		 * 
		 * 
		 * 
		 */ 
		
		echo "<h2>".$my_cords."</h2>\n";
		
	}
	
	
    
}


/*
 * Add site contacts section
 * 
 * Creates a new contact for customer site
 * 
 */ 
	function contacts($user_id=false, $site_id=NULL, $contact_id=NULL, $type=NULL )
	
	{
		
		if(!empty($this->posts))
		
		{
			
			//Lets set some required fields
			
			$this->fields = array('first_name', 'last_name', 'daytime_telephone');
			
			//What errors to show
					
			$this->errors = array('required', 'required', 'required');
			
			//Run the parent class validator
			
			$this->runValidator($this->fields, $this->errors);
			   
			    //Is it Valid?
				 if ($this->form_validation->run() == FALSE)
				
				  {
				  	
					//show the form and send the parameters of the failed fields
				  	echo json_encode($this->form_validation->error_array());	
					
					//Stop the function here
					
					return false;
					
				  }
				  
				 else
				 	
				 	{
				 		/*
						 * We are posting and its all valid
						 * 
						 * We need to run some checks on whether we are adding or updating
						 * 
						 * If  the user id is recieved as a integer continue..
						 * 
						 */
						  
						if(is_numeric($user_id))
						
						{
							
							/*
							 * We post a 0 to update the primary contact as it has no name, we post a "-" to add
							 * 
							 * which isn't numeric...
							 * 
							 * anything above 0 will tell the system we are updating the record
							 * 
							 * 
							 */ 
							
							if($user_id > 0 )
							
							{
								
								/*
								 * If the value is greater than 0 we are updating a record
								 * 
								 * Slice the post array and update the contacts name
								 */ 
									
								$this->sites_model->update_row($user_id, 'id', 'users', array_slice($this->posts, 0, 3));
								
							}
							
							/*
							 * all types of data here have contacts so no need
							 * 
							 * to check against it.
							 */
							  
							$this->sites_model->update_row($contact_id, 'id', 'contact', array_slice($this->posts, 3));
							
							/*
							 * Return a json array to alert the user all is well
							 * 
							 */ 
							
							echo json_encode(array('message' => 'Contact Updated!'));
							
							/*
							 * Stop the function
							 */ 
							
							return false;
							
						}
						
						else 
						
						{
							
						
						/*
						 * We have recieved a - rather than an integer, this tells
						 * 
						 * the system to add data rather than update
						 * 
						 * Insert the records into the corresponding tables
						 * 
						 */ 
							 		
						$contact_id = $this->sites_model->insert_return(array_merge(array_slice($this->posts,3), array('site_id' => $site_id)), 'contact');
						
						              $this->sites_model->insert(array_merge(array('contact_id' => $contact_id, 'master_id' => $this->data['data']->master_id), array_slice($this->posts,0,3)), 'users');
									  
						
						/*
						 * Return a json array to inform the user that they have added a contact.
						 * 
						 */ 
						
						              echo json_encode(array('message' => 'Contact Added!'));
									  
										/*
							 			 * Stop the function
							 			 */
				 		
									  return false;
										
						}
										
						
				 	}
			
		}

		/*
		 * We need to send the user id to the view
		 * 
		 * and get date in case we are editing a record
		 */ 
		
		$this->data['user'] = $user_id;
		
		$this->data['row_data'] = $this->sites_model->get_contact($user_id, $site_id, $contact_id);
		
		/*
		 * Run the title function to get some form data
		 * 
		 */ 
		
		$this->title($this->fields,$this->data['row_data']);
		
		/*
		 * Loop the possible form views to build the form
		 * 
		 * We need the first 2 in the array
		 * 
		 */ 

			for($i=0;$i<2;$i++)
		
				{
					/*
					 *Build the form now
					 * 
					 * Send it all to the view 
					 * 
					 */
					  
					$this->form_data($this->fields, (!is_numeric($user_id)  ? NULL: $this->data['row_data']),  ($user_id == false ? 1:$i));
		
				}
				
		/*
		 * Load the view file
		 * 
		 */ 

		$this->load->view('clientarea/sites/modules/'.$type, $this->data);
		
	}

	/*
	 * Function to add a note to the contact
	 * 
	 * 
	 */ 

	function notes($user_id,  $message_id = NULL, $date_id = NULL)
	
	{
		
		/*
		 * Check for ajax request
		 * 
		 */ 
		
		if($this->input->is_ajax_request())
					
		{
			
			/*
			 * Are we posting?
			 * 
			 */ 
		
		if(!empty($this->posts))
		
		{
			/*
			 * What needs valaidating?
			 * 
			 */ 
			
			$this->fields = array('title');
					
			$this->errors = array('required');
			
			/*
			 * Run the parent class validator
			 * 
			 */ 
			
			  $this->runValidator($this->fields, $this->errors);
			   
			    //Is it Valid?
				 if ($this->form_validation->run() == FALSE)
				
				  {
				  	
					//show the form and send the parameters of the failed fields
				  	echo json_encode($this->form_validation->error_array());	
					
					/*
					 * Stop the function
					 * 
					 */ 
					
					return false;
					
				  }
				  
				 else
				 	
			      {
			      	
					/*
					 * If date_id is NULL, we are adding a note to the contact
					 * 
					 */
					
			      	if($date_id == NULL)
					
					{
						
						/*
						 * Yep date is Null so add the following
						 * 
						 * Insert the date to say when it was added
						 * 
						 * return its table id
						 * 
						 */ 
					  	  
					  		$date = $this->sites_model->insert_return(array('date' => $this->time), 'date');
							
							/*
							 * Create an additonal array of keys and values to insert into the messages table
							 * 
							 */
					  
					  		$arr = array('date_id' => $date, 'user_id' => $user_id, 'note' => true);
							
							/*
							 * Merge the array with the post array and insert the record into the messages table, return its id
							 */ 
					  
					  		$message_id = $this->sites_model->insert_return(array_merge($arr, $this->posts), 'messages');
							
							/*
							 * Insert into joining table and join it with the logged in user id to identify who post the note
							 * 
							 */ 
					  
					  		$this->sites_model->insert(array('message_id' => $message_id, 'recipitent_id' => $this->data['data']->user_id), 'recipitent');
							
							/*
							 * Return confirmation message
							 */
					  
					  		echo json_encode(array('message' => 'Note Added!'));
							
							/*
							 * Stop the function
							 * 
							 */ 
							
					  		return false;
					  
					  
					}
					
					else 
					
					{
						/*
						 * date_id has a value so it tells the system we are updating
						 * 
						 * Update when the record was added
						 * 
						 */ 
						
							$this->sites_model->update_row($date_id, 'id', 'date', array('date' => $this->time));
							
							/*
							 * Update the message
							 * 
							 */ 
						
							$this->sites_model->update_row($message_id, 'id', 'messages',  $this->posts);
							
							/*
							 * Has a different user updated this note, if so then isert there id
							 * 
							 */ 
						
							$this->sites_model->update_row($message_id, 'message_id', 'recipitent',  array('recipitent_id' => $this->data['data']->user_id));
							
							/*
							 * Return success message
							 * 
							 */ 
						
						 	echo json_encode(array('message' => 'Note Updated!'));
							
							/*
							 * Stop the function
							 * 
							 */ 
						
							return false;
						
			
						
					  }
					
				  }
			
		     } 
		     
		     elseif($_SERVER['REQUEST_METHOD'] == "GET" )
    				
    		{
    			
				/*
				 * Are we getting data, if so then get date from the database for eding purposes
				 * 
				 */ 
    			
							
					$this->data['row_data'] = $this->sites_model->get_row('messages', 'id', $message_id);
			
							
				   
			}
		
		/*
		 * Build the form ready for the view
		 * 
		 * @function form_data => Parent Controller
		 * 
		 */ 
		
		$this->form_data($this->fields, (is_object($this->data['row_data']) ? $this->data['row_data']:NULL), 5);
		
		/*
		 * Load the view 
		 * 
		 */ 
		
		$this->load->view('modules/messages', $this->data);
		
		}
	}

	/*
	 * Function To add site to the customer
	 * 
	 * We need to build a custom form to facilitate,
	 * 
	 * This will be used elsehwere to.
	 */ 

	function update_sites($company_id, $siteId=NULL, $addressId=NULL, $bypass=false)
	
	{
		
		/*
	 	 * Are we adding or editing data, if we are adding a new site we need contact data.
		 * 
		 * If not we only edit site name or address because the site could have multiple contacts
		 * 
		 * and would make the form to big and cumbersome...
	 	 * 
	 	 */ 
	 	 
		$this->data['hideContact'] =  ($siteId == NULL  ? NULL:'NOT NULL');
		
		/*
		 * Run a check for ajax posting
	 	 * 
	 	 */ 
		
		if($this->input->is_ajax_request())
					
		{
			
			/*
			 * Are we posting data
			 * 
			 */
			
			if(!empty($this->posts))
		
		      {
				//Set the validation for the add/edit site form, adding will require additional fields
		
			   $this->fields = array('site_name', 'address_line_1', 'city', 'postcode');
					
			   $this->errors = array('required', 'required', 'required', 'required');
			   
			 /*
			  * If we dont have a site id sent as param we are adding
			  * 
			  * So we need some additional rules to validate because we are using 
			  * 
			  * So we push some additonal data onto the array...
			  * 
			  */
			   
			   if($siteId === NULL)
			
								{
								
								/*
								 * If we are adding data we need to validate 
								 * 
								 * addional fields wich are not present during edit
								 * 
								 */
								
								array_push($this->fields, 'email_address', 'daytime_telephone','first_name');
				
								array_push($this->errors, 'required|valid_email', 'required|validate_uk_phone', 'required');
				
								}
								
				/*
				 * Run the validator in the parent class
				 * 
				 */			
			   
			    $this->runValidator($this->fields, $this->errors);
			   
			    //Is it Valid?
				 if ($this->form_validation->run() == FALSE)
				
				  {
				  	
					//show the form and send the parameters of the failed fields
				  	echo json_encode($this->form_validation->error_array());	
					
					return false;
					
				  }
				  
				 else
				 	
			      {
			      	
					/*
					 * Again are adding or editing
					 * 
					 * If it equals NULL we are adding data so 
					 * 
					 * we need to run different functions to add
					 */ 
			      	
					if($siteId == NULL)
			
						{
						
						/*
						 * Insert the site address into the system
						 * 
						 * 
						 */
							
			      		$address_id = $this->sites_model->insert_return(array_slice($this->posts,1,6), 'address');
						
						/*
						 * Create an array to insert the correct site data
						 * 
						 * 
						 */
					
			      		$siteData = array('company_id'     => $company_id, 
			      			
			      					  	  'address_id'     => $address_id, 
			      							  
			      					      'domain'         => 0, 
			      							  
			      					      'site_name'      => $this->posts['site_name'], 
			      							  
			      					      'site_reference' => createReference($this->posts['site_name'], $company_id) 
											  
											 );
					//Insert the site data
											 
			      	$site_id = $this->sites_model->insert_return($siteData, 'sites');
					
					//Insert the contact data
					
					$contact_id = $this->sites_model->insert_return(array_merge(array('site_id' => $site_id), array_slice($this->posts,10)), 'contact');
					
					
					$this->sites_model->insert(array_merge(array('contact_id' => $contact_id, 'master_id' => $this->data['data']->master_id), array_slice($this->posts,7,3)), 'users');
					
						}
						
					     else
						 	
						{
							/*
							 * We are editing!!!
							 * 
							 * Update address and sites table with the correct
							 * 
							 * Params sent through url
							 * 
							 */
							 
							$this->sites_model->update_row($addressId, 'id', 'address', array_slice($this->posts,1,6));
							
							$this->sites_model->update_row($siteId, 'id', 'sites', array('site_name' => $this->posts['site_name']));
						
						}
								
					//Return json success message
					echo json_encode(array('message' => 'Site Address Changes Saved'));
					
					return false;
			      	
				  }
			
			
			  }
		
			
			
			if($siteId == NULL)
			
			{
				
			 //Load company form blank with validation fields
		
			 $this->form_data($this->fields, '',1);
			  
			}
			
			else {
				
					//We are editing so we need to get the data from the database
									
					$this->data['row_data'] = $this->customer_model->get_modal_site_edit($siteId);
					
					/*
					 * When editing site data from customers page we use a get request
					 * 
					 * so we need to detect from the server what the request is..
					 * 
					 * If its GET just return a json array
					 */ 
					
					if($this->input->server('REQUEST_METHOD') == 'GET' &&  $bypass == true)
					
					{
						
						echo json_encode($this->data['row_data']);
						
						return false;
						
					}
			
				}
			
				
			$this->title($this->fields,($siteId == NULL  ? NULL: $this->data['row_data']));
					
			$this->form_data($this->fields, ($siteId == NULL  ? NULL: (!empty($this->data['row_data']->last_name) ? $this->data['row_data']:NULL)), 0);
			
			//Run the address form with data if needed...
			
			$this->address($this->fields,($siteId == NULL  ? NULL: $this->data['row_data']));
			
			//Load the company data 
		
			$this->form_data($this->fields, ($siteId == NULL  ? NULL: $this->data['row_data']), 4);
			
			//Load the view...
		
			$this->load->view('clientarea/sites/modules/sites', $this->data);
		
		}
		
		 else
		 	
		{
				
		//No JS enabled, alert user to switch it back on
		echo "Please Enable Javascript To use These Features";
		
		}
		
	}

	/*
	 * Customers section to view the sites in the model
	 * 
	 */ 
		
	function view_sites($company_id)
	
	{
		
		
		
		$this->data['sites'] = $this->sites_model->get_sites($company_id);
		
		$this->data['company_id'] = $company_id;
		
		$this->data['hideContact'] = "NOT NULL";
		
		$this->address($this->fields, NULL);
			
		//Load the company data 
		
		$this->form_data($this->fields, NULL, 4);
		
		$this->load->view('/clientarea/sites/modules/customer_sites', $this->data);
		
	}

/*
 * Private functions below here
 * 
 * 
 */


}