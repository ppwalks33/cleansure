<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//ini_set('display_startup_errors',1);
//ini_set('display_errors',1);
error_reporting(0);
/*
 * Cleansure Specifications controller
 * 
 * Specifications controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Specifications
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Subcontractors extends Clientarea_Controller {
	
	/**
	 * 
	 *@param array 
	 *
	 * Private varaible fields
	 * Store the  fields that need validating
	 * 
	 */ 
	
	Private $fields = array();
	
	/**
	 *@param array 
	 *
	 * Private varaible errors
	 * Store the errors that coorespond to fields array
	 * 
	 */ 
	
	Private $errors = array();
	
	
	 
	
	
	//Class constructor
	Public function __construct()
	
	{
		
        parent::__construct();	
		
		/**
		 * @param load the corresponding model
		 * 
		 */
		
		$this->load->model('staff_model');
		
		
		
		//Load the config file for this class
		$this->config->load('register');
		
		/**
		 * @param push the required js files for this section
		 * 
		 */ 
		
		
		$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker','live',  'main');
		
		
		/**
		 * @param create javascript include array
		 * 
		 */ 
		
		$this->data['js'] = javaScript($this->js); 
		
		/**
		 * @param url segment for correct view
		 * 
		 */ 
		
		
		$this->file_ext = '_'.$this->uri->segment(3);
		
		/*
		 * Modules folder
		 * 
		 */ 
		
		
		
		$this->data['modules'] = 'clientarea/subcontractors/modules/';
		
		/*
		 * Post array
		 * 
		 */
		 
		$this->posts = $this->input->post(NULL, TRUE);
		
		
	}
	
	
	
	Public function index()
	
	{	
			
		  $this->data['sc'] = $this->staff_model->all_staff(
		  
		  													(int)$this->config->item('subcontractor')
															
															);
		
		  $this->view($this->master,$this->prefix);
		
		
	}
	
	
	Public function insert()
	
	{
		
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
						
			
					$this->insert_data($this->posts);
			
					}
			
		}
		
		else 
		
		{
			
			$this->generate_form();
			
		  
		   
		   $this->view($this->master, $this->prefix, $this->file_ext);
			
		}
		
		
		
	}
	
	Private function insert_data($data)
	
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
							
							$userArray[$keys[$i]] = $this->staff_model->insert_return(array_slice($data, $vars[$i][1], $vars[$i][2]), $vars[$i][0]);
							
						}
						
							/*
							 * Add additional attributes to the array
							 * 
							 */
						
							$userArray['type'] = (int)$this->config->item('subcontractor');
							
							
							$userArray['master_id'] = $this->data['data']->master_id;
							
							
							$userArray['user_id'] = $this->staff_model->insert_return(array_merge($userArray, array_slice($this->posts,4,3)), 'users');
							
							
							$this->staff_model->insert(array_slice($userArray,3), 'staff');
							
							//Return json success message
							echo json_encode(array('message' => 'Successfully inserted Subcontractor'));
							
			
							return false;
		
	}
	
	Private function generate_form($fields=NULL)
	
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