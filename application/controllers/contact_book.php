<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',0);
ini_set('display_errors',0);
error_reporting(0);
/*
 * Cleansure Contact_book controller
 * 
 * Contact_book controller is not to be edited or used by unauthorised personel and Gofish Web Design
 * 
 * hold full copyright to the code and maintanance of the cleansure system.
 * 
 *  @category   ClientArea
 *  @package    Contact Book
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Contact_Book extends Clientarea_Controller {
	
	
	//Class constructor
	public function __construct(){
		
        parent::__construct();	
		
		$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker', 'main', 'live', 'contact_book');
		
		$this->data['js'] = javaScript($this->js); 
		
		//Load the config file for this class
		$this->config->load('register');
		
		//Load the model file
		$this->load->model(array('contactbook_model', 'staff_model', 'customer_model'));
		
		//Acordains for the dropdown - key = id, val = glyph
		$this->data['accordians'] = array('personal' => 'star-empty', 'customer' => 'book', 'suppliers' => 'cog', 'staff' => 'user');
		
		//Modules folder
		$this->data['modules']  = "clientarea/contact_book/modules/";
		
		//Post Vars
		$this->posts = $this->input->post(NULL, TRUE);
	}
	
	/*
	 * Main contact Page
	 * 
	 * 
	 */
	
	public function index()
	
	{
		/*
		 * Get all the contacts where from master id
		 * 
		 * 
		 */
		 
		 if($this->customer_model->count_customers() > 0 || $this->staff_model->count_staff() > 0)
		 
		 {
		 
		$this->data['contacts'] = $this->contactbook_model->contacts(
		
																	array('master_id' => $this->data['data']->master_id),
																	
																	$this->data['data']->user_id
		
																	);
																	
		 }

		/*
		 * See which arrays we have and paginate the correct results within the
		 * 
		 * loop, we use the config items to recognise which arrays are being return through
		 * 
		 * through the arraySort function
		 * 
		 */															
		
		foreach ($this->data['accordians'] as $ref => $glyph)
	
	      {
	      	/*
			 * Check if we have a result
			 * 
			 * 
			 */
			  if(isset($this->data['contacts'][$this->config->item($ref)]))
		
		        {
		        	//We do so create a data array
		        	
					$data = $this->data['contacts'][$this->config->item($ref)];
					
					//Pass the data to pagination function...
		
					$this->pagination('clientarea/contact_book/get/'.$ref.'/', $data, $ref);
					
				}
		
		  }
			
		$this->view($this->master, $this->prefix);	
		
	}

	/*
	 * Function to add personal contacts to the system
	 * 
	 */ 

	Public function personal()
	
	{
		//Are we posting ?
		
		if(!empty($this->posts))
		
		{
			
			   //Fields to be validated
			  $this->fields = array('first_name', 'last_name', 'address_line_1', 'city', 'postcode', 'email_address', 'daytime_telephone');
			
			  //Corresponding errors 	
			  $this->errors = array('required', 'required', 'required', 'required' , 'required', 'required|valid_email', 'required');
			  
			  	//Run them through the validator
			    $this->runValidator($this->fields, $this->errors);
					
				//Check for errors
			      if ($this->form_validation->run() == FALSE)
				
				    {
				    	
						
				  		//show the form and send the parameters of the failed fields
				  	echo json_encode($this->form_validation->error_array());	
					
					return false;
						
					}
					
				  else
				  	
					{
						/*
						 * Keys for addtional user table attributes
						 * 
						 * 
						 */
						 
						$keys = array('company_id', 'contact_id', 'address_id');
						
						/*
						 * Table names and slice keys  
						 * 
						 */
						
						$vars = array(
						
								array('company', 0, 4),
							
								array('contact', 7, 5),
							
								array('address', 12, 6) 
						
						);
						
						/*
						 * Declare the user array
						 * 
						 */
						
						$userArray = array();
						
						/*
						 * Loop over the $vars to insert the records into appropriate table
						 * 
						 */
						
						for($i=0;$i<3;$i++)
						
						{
							
							/*
							 * Insert and return the value into the array
							 * 
							 */
							
							$userArray[$keys[$i]] = $this->contactbook_model->insert_return(array_slice($this->posts, $vars[$i][1], $vars[$i][2]), $vars[$i][0]);
							
						}
						
							/*
							 * Add additional attributes to the array
							 * 
							 */
						
							$userArray['type'] = $this->config->item('personal');
							
							$userArray['parent_id'] = $this->data['data']->user_id;
							
							$userArray['master_id'] = $this->data['data']->master_id;
							
							$this->contactbook_model->insert(array_merge($userArray, array_slice($this->posts,4,3)), 'users');
							
							//Return json success message
							echo json_encode(array('message' => 'Successfully inserted contact'));
			
							return false;
							
						
						
					}
		}
		
		/*
		 * We are not posting so we need to load the conatct form
		 * 
		 */
		 
		$this->contact_form(NULL);
		
		/*
		 * Load The View Template
		 * 
		 */
		$this->view($this->master,$this->prefix,$this->file_ext);
	}

    /**
	 * Function to get the paginated data through ajax
	 * 
	 * @param $type = which type of user we are extracting
	 * 
	 * @param $offset = offset of the page array
	 * 
	 */


	Public function get($type, $offset=true)
	
	{
		/*
		 * Get the customer data from the db 
		 * 
		 * Use specific requirements to extract the user args
		 * 
		 */
		
		$customers = $this->contactbook_model->contacts(
		
														array('master_id' => $this->data['data']->master_id,
																	
															  'type'      => $this->config->item($type),
																		  
															  'parent_id' => ($type == 'personal' ? $this->data['data']->user_id:false)),
																	
															  $this->data['data']->user_id);
																	
		/*
		 * Send the relavent data to the pager function
		 * 
		 */
																	
		$this->pagination('clientarea/contact_book/get/'.$type.'/', $customers, $type, 5);
		
		/*
		 * We need the ref as an identifier to the table id
		 * 
		 */
		
		$this->data['ref'] = $type;
		
		/*
		 * Load the view
		 * 
		 */
		
		$this->load->view($this->data['modules'].'pag_table', $this->data);
		
	}
	
	/*
	 * Generates the form to insert into the model
	 * 
	 */
	
	 Private function contact_form($fields=NULL)
 
 	{
 		
	/*
	 * Gets the title of the person
	 * 
	 */
 	
	$this->title($fields);  
	
	/*
	 * Loop to send all the array keys for the data we will require
	 * 
	 */
							
		for($i=0;$i<5;$i++)
	
			{
							
			$this->form_data($fields, NULL, $i);
	
	        }
			
	/*
	 * Address function
	 * 
	 */
	
	$this->address($fields);
 }


}