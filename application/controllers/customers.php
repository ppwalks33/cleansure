<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',0);
ini_set('display_errors',0);
error_reporting(0);
/*
 * Cleansure Customers controller
 * 
 * ClientArea controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Customers
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Customers extends Clientarea_Controller {
	
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
		
		$this->load->model(array('customer_model','sites_model', 'supplier_model'));
		
		$js=array_push($this->js, 'bootstrap-select.min', 'bootstrap-datepicker', 'main', 'live', 'customers', 'sites', 'fileupload');
		
		$this->data['js'] = javaScript($this->js); 
		
		$this->file_ext = '_'.$this->uri->segment(3);
		
		$this->posts = $this->input->post(NULL, TRUE);
		
		$this->config->load('register');
		
		$this->data['types'] = array('Product', 'Consumable', 'Product/Consumable');
		
	}
	

	/*
	 * Index view, this shows all customer data
	 * 
	 * in the  main view...
	 * 
	 */
	  
	Public function index($function=NULL)
	
	{
		
		/*
		 * Has the user got any customers in the system yet
		 * 
		 * if no redirect the user to the "add" function by runing no_customers function
		 */
		  	
		if( $this->customer_model->count_customers() > 0)
		
		{
		
			//Generate some tips for the user to help with the GUI
			
			$this->data['info'] = $this->lang->line('info');
			
			//Run the query to get all the customer data
			
			$customer_data = $this->customer_model->get_customers($this->data['data']->master_id);
			
			// print_r($customer_data);
		
			$this->pagination('clientarea/customers/', $customer_data, 'customer_pag', 3);
			//Load the view 
			
			$this->view($this->master, $this->prefix);
			
		}
		
		else 
		
		{
			
			//Run the no customers function
			
			$this->no_customers();
		}
		
	}
	
	/*
	 * Function to add a customer into the system
	 * 
	 */ 
	
	Public function add($contacts = NULL)
	
	{
			
		//Are we posting
		if(!empty($this->posts))
		
		{
			
			
			//all the fields that want validation
			$this->fields = array('type', 'title', 'first_name', 'last_name', 'email_address[]', 'daytime_telephone[]', 'address_line_1[]', 'city[]', 'postcode[]');
			
			//Correspoding errors
			$this->errors = array('required', 'required','required', 'required', 'required|valid_email', 'required', 'required', 'required', 'required');
			
			/*
			 * Customers can be an individual or company, so for validation 
			 * 
			 * purposes we run an extra check on what is posting
			 * 
			 */ 
			 
			if($this->posts['type'] != 0)
			
			{
				/*
				 * We are dealing with a company so we need to add 
				 * 
				 * some rules to validation 
				 * 
				 * Extra fields have been unlocked so
				 * 
				 * They need validating too.
				 * 
				 */ 
				
				array_push($this->fields, 'company_name[]');
				
				array_push($this->errors, 'required');
				
			}
			
			/*
			 * Parent control function to 
			 * 
			 * automatically run the validator
			 * 
			 */ 
			
			$this->runValidator($this->fields, $this->errors);
			
		}
		
			//Check for errors
			if ($this->form_validation->run() == FALSE)
				
				  {
				  	
					//Are we transmitting through ajax
				  	
					if($this->input->is_ajax_request())
					
					{
						
					//Generate a warning	
						
					 $this->warning('customer_warning');
					 
					 return false;
					 
					}
					
					else
					
					{
						
						
						//show the form and send the parameters of the failed fields
						
				  		$this->customer_form($this->form_validation->error_array());	
											
					}								
					
				 }  else  {
				 	
					
					/*
					 * We are dealing with a company
					 * 
					 * so we need to create some keys for the multidimansional arrays
					 * 
					 */ 
					
					if($this->posts['type'] == true)
				
						{
					
							/*
							 * Generate company array
							 * 
							 */ 
							 
							 $companyArray = array_merge(array('active' => '1'),array_slice($this->posts, 9, 4));
							 
							 //Invoice Keys to join onto multidimensional post array
							
						     $invoice = array(0, 1, 0);
							 
							 //Which is the invoice address out of the 2 vars
					  
					         $addInvoice = array(1,0);
							
							
						}
				
						else 
						
						{
							
							//We are dealing with an individual, so we need a different array
					
						    $companyArray = array('active' => '1');
							
							//Smaller array so less keys needed
							
				            $invoice = array( 1, 0);
							
							//The second var will will be primary
							
							$addInvoice = array(0,1);
						
						
						}
					
					
				    //Insert the company data into the database and get the returned keys
					$company_id = $this->customer_model->insert_return($companyArray, 'company');
					
			        //Insert the date for the logs and so we can identify when the customer was added
					$date_id = $this->customer_model->insert_return(array('date' => $this->time), 'date');
					
					/*
					 * We need to identify the array key position of address data so
					 * 
					 * a slice of the post array can be taken to be formatted through the batch 
					 * 
					 * functions within the core model.
					 * 
					 */ 													
												   			
		    		$add_key = array_search('address_line_1', array_keys($this->posts));
												   
					$address_ids = $this->customer_model->my_array(array_slice($this->posts, $add_key, 6), 
		    										
		    									  									'address', 
		    										
		    									   									NULL, 
		    										
		    									   									array('company_id' => $company_id, 'invoice' => $addInvoice = array(1,0))
												   
												   						);
					
					/*
					 * The site data is mostly composed of returned data and we need to build the array accordingly 
					 * 
					 * to the post vars, we have multiple ways in which the data can be inserted into the database
					 * 
					 * depending on how the user has posted the form
					 * 
					 * We also create a unique reference through the createReference helper function
					 */ 
					 
					$a_id = count($address_ids) -1;
					
						
					$sites = array('site_name'         => 'Company Head Quarters', 
			
						   			'site_reference'    => createReference($this->name(), $company_id),
						   
						   			'address_id'        => $address_ids[$a_id],
						   
						   			'company_id'        => $company_id,
						   
						   			'domain'            =>  true);
									
					//Insert the site array and return the id accordingly
																
					$site_id = $this->customer_model->insert_return($sites, 'sites');
					
					$site_ids = ($this->posts['type'] == true ? array(0, 0, $site_id) : array( 0, $site_id));
			
					/*
					 * customer array function calls the core model functions to insert formatted batch data
					 * 
					 * additional parameters can be set such as adding custom arrays to the method which will 
					 * 
					 * be attached and formated alongside the post array
					 * 
					 */ 
					
					  
					
		    		$contact_ids = $this->customer_model->my_array(array_slice($this->posts, 4, 5), 
		    										
		    									  									'contact', 
		    										
		    									   				 					NULL, 
		    										
		    									   				 					array('user' => $this->data['data']->user_id, 
		    									   				 					
		    									   				 						  'company_id' => $company_id, 
		    									   				 						  
		    									   				 						  'site_id' => $site_ids, 
		    									   				 						  
		    									   				 						  'invoice' => $invoice)
												   
												   						);
					
					/*
					 * Create an array of customer data with all the corect foriegn 
					 * 
					 * keys and type.
					 * 
					 */ 
					
					$userData = array('company_id' => $company_id, 
					
									  'contact_id' => $contact_ids[0], 
									  
									  'address_id' => ($a_id == 1 ? $address_ids[1]: $address_ids[0]), 
									  
									  'type' => (int)$this->config->item($this->prefix),
									  
									  'master_id' => $this->data['data']->master_id
									  
									  );
									  
					//Insert the customer into the database, merge the array above with a slice of the post array.
									  
					$this->customer_model->insert(array_merge($userData, array_slice($this->posts, 1, 3)), 'users');
					
						//array_slice($this->posts, 1, 3)	
																		
					
					
					//Create a customer array and customer reference through the createReference helper function
		 
					$customerArray = array('reference'  => createReference($this->name(), $company_id),
								   
								   'company_id' => $company_id,
								   
								   'date_id' 	=> $date_id,
								   
								   'master_id'  => $this->data['data']->master_id,
								   
								   'individual' => $this->posts['type']);
								   
					//Insert the customer data into the customer table			   
			 	
			 		$this->customer_model->insert($customerArray, 'customers');	
					
					//Give the user a success message to say all well!
				
				  	$this->data['message'] = $this->lang->line('customer_added');
					
					//Encode view data and message into json format for ajax purposes
				
				   	echo json_encode(array('message' => $this->load->view('/clientarea/modules/flashmessage', $this->data, true)));
					
					//Return false so the user does not get double view load....
				   
				   	return false;
				
				
			     }
		
		
		//This arg opens up the form to be multidimensional array
		
		$this->data['arr'] = true;
		
		//Generate the form
		
		$this->customer_form(NULL);
		
		//Load the view file
		
		$this->view($this->master, $this->prefix, $this->file_ext);	
		
	}


	/*
 	 * Company Profile functions
 	 * 
 	 * Here we will display all the company data pertaining to each customer
 	 * 
 	 */ 
 
 		function profile($id)
 
 			{
				
				//Assign the title via the prefix
				$this->data['header'] = ucwords($this->prefix);
				
				//Declares the user value
				$this->data['type'] = $this->config->item($this->prefix);
				
				//Get the customers profile data from customer model
				
				$this->data['customer_data'] = ($this->data['type'] == 7 ? $this->customer_model->get_customer_profile($id)
				
						                                					:
						
																			$this->supplier_model->profile($id));
																			
																			
				//print_r($this->data['customer_data']);
																			
				//echo $this->data['customer_data'][0]->company_name;
					
					
				$path = array(
				
							 $this->data['data']->company_name, 
							 
							 $this->data['customer_data'][0]->company_name);
							 
				$dir = $this->uploader->create_path($path);													
																		
		
				if($this->uploader->folder_exists($dir) == false)
		
					{
					
						$this->uploader->create_dir($dir, true);
			
					}
																																
																				
				//Get the sites data from the sites model that belong to the selected customer
	
				$this->data['sites'] = $this->sites_model->get_sites($this->data['customer_data'][0]->comp_id);
				
				
	
				$this->view($this->master, $this->prefix, $this->file_ext);	
				
 }

/*
 * Company Profile Ajax Functions Here
 * 
 * Use Model to edit segment of company profile
 */ 
 
 function edit($table, $id)
 
 {
 	/*
	 * We need to check for ajax usage
	 * 
	 */ 
	 
 	if($this->input->is_ajax_request())
					
		{
			
			//Row from the table based url params
			
			$this->data['row_data'] = $this->customer_model->get_row($table, 'id', $id);
			
			//Run switch on table type
			switch($table)
			{
				
				case 'company':
					
				$this->fields = array('company_type');
					
				$this->errors = array('required');
				
				$this->form_data($this->fields, $this->data['row_data'], 2);
				
				$view = 'company_details';
				
				break;
				
				case 'contact';
				
				$this->fields = array('email_address');
					
				$this->errors = array('required');
				
				$view = 'contact_details';
				
				$this->form_data($this->fields, $this->data['row_data'], 1);
				
				break;
				
				case 'users';
				
				$this->fields = array('title', 'first_name','last_name');
					
				$this->errors = array('required', 'required', 'required');
				
				$view = 'title';
				
				$this->title();
				
				$this->form_data($this->fields, $this->data['row_data'], 0);
				
				break;
				
				case 'address';
				
				$this->fields = array('address_line_1', 'city', 'postcode');
					
				$this->errors = array('required', 'required', 'required');
				
				$view = 'address';
				
				$this->address($this->fields, $this->data['row_data']);
				
				$this->form_data($this->fields, $this->data['row_data'], 4);
				
				break;
				
			}

			//Have we got post vars
			
			if(!empty($this->posts))
		
		      {
		      	//run the form validation
				
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
					
					//Update the row on specified table
						
					$this->customer_model->update_row($id, 'id', $table, $this->posts);
					
					//Return json success message
					echo json_encode(array('message' => 'Successfully updated'));
					
					return false;
					
				   }
			
		      	
			  } 
 				
				//We are not posting so give the view
	    		$this->load->view('modules/'.$view, $this->data);
					  
				}

        			 else
		 	
					{
				
				//No JS enabled, alert user to switch it back on
					echo "Please Enable Javascript To use These Features";
				}
	
 }

/**
 * 
 * @param $type (int)
 * 
 * @param $company_id (int)
 * 
 * Loads the contracts pertaining to the customer...
 * 
 */ 

 //clientarea/specifications/last_spec/1/54d4cee59dfe1

Public function contracts($type, $company_id, $site_id=NULL)

{
	
	$this->data['jobs'] = $this->customer_model->get_contracts($type, $company_id, $site_id);

	$this->load->view('clientarea/customers/modules/contracts', $this->data);
	
}


Public function view_staff($comp_id, $site_id=NULL)

{
	
	$this->data['jobs'] = $this->customer_model->get_staff($comp_id, $site_id);
	
	$this->load->view('clientarea/customers/modules/staff', $this->data);	
	
}

	
/*
 * Private functions go here
 * 
 */
 
 Private function customer_form($fields=NULL)
 
 {
 	//What we delaing with company or individual
	
	$this->data['c_type'] = array(''=>'Please Select Type', 
							
		   								'1'=>'Company');		
											
	//Run title function in parent class
		   																
	$this->title();
	
	//Run Address function in parent class
	
	$this->address($fields);
	
	//Run form function in parent class
	
	for($i=0;$i<5;$i++)
	
	{
	
	   $this->form_data($fields,NULL, $i);
	   
	}
	
 }
 
 /*
  * Function to see what is being posted so 
  * 
  * we know what arrtibutes to generate for the unique ref;
  * 
  */
  
 Private function name() {
 	
	return (!empty($this->posts['company_name']) ? $this->posts['company_name'][0] : $this->posts['first_name']);
 }

 //Redirect the user if they have not inserted no customers into the system
 
 Private function no_customers()
 
 {
 	
 	$this->session->set_flashdata('warning', $this->lang->line('no_customer'));
	
	header('Location: /clientarea/customers/add/');
 }


}