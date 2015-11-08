<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',0);
ini_set('display_errors',0);
error_reporting(0);
/*
 * Cleansure Machinery controller
 * 
 * Machinery controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Machinery
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Machinery extends Clientarea_Controller {
	
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
		
		$this->load->model('machinery_model');
		
		$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker','main','live', 'machinery');
		
		$this->data['js'] = javaScript($this->js); 
		
		$this->file_ext = '_'.$this->uri->segment(3);
		
		$this->posts = $this->input->post(NULL, TRUE);
		
		$this->modules = 'clientarea/machinery/modules/';
		
	}
	
	
	
	Public function index()
	
	{
			
		if( $this->machinery_model->count_machines($this->data['data']->master_id) > 0)
		
		{
			
			$this->data['machinery'] = $this->machinery_model->get_machnery($this->data['data']->master_id);
			
			// print_r($this->data['machinery']);
			
			$this->session->set_flashdata('info', ' Did You Know? You can edit certain items by simply clicking on them. Give it a try below! ');
			
			$this->view($this->master, $this->prefix);	
			
		}
		
		else 
		
		{
			
			
			$this->no_machines();
		}
		
	}
	
	
	Public function add()
	
	{
		
		if(!empty($this->posts))
		
		{
			
			//all the fields that want validation
			$this->fields = array('identifier', 'log_num', 'type', 'age', 'date[]');
			
			//Correspoding errors
			$this->errors = array('required', 'required','required','required', 'required');
			
			/*
			 * Created a function to return the loop
			 */
			  
			$this->runValidator($this->fields, $this->errors);
					
					//Check for errors
			      if ($this->form_validation->run() == FALSE)
				
				    {
				  	
					
												
						
				       echo json_encode($this->form_validation->error_array());	
						
						
					
						
					}
					
                     else
					 	
					
					{
					
					/*
					 * Insert the dates array into the dbn and retrieve the appropriate keys
					 * 
					 * format the data, rebuild the array ready for batch insert...
					 * 
					 */ 
					 
					 foreach($this->posts['date'] as $d)
					 
					 {
					 	
						$dates['date'][] = insert_date($d);
						
					 }
					 
					
					
					$keys = $this->machinery_model->batch_insert($dates, 'date', NULL);
					
					/*
					 * Unset the date value to we can create a clean insert...
					 * 
					 * 
					 */
					
					unset($this->posts['date']);
					
					
					 $machineArray = array('aq_date' => (int)$keys[0], 'pat_date' => ($this->posts['pat_tested'] == true ? (int)$keys[1]:false), 'master_id' => $this->data['data']->master_id);
					 
					 
					 $this->machinery_model->insert(array_merge($this->posts , $machineArray), 'machinery');
					 
					 
					 echo json_encode(array('message' => 'Machinery Has Been added successfuly....'));
					 
						
					 return false; 
						
					}							
						
					
					
					return false;
				  
			
		}
		
		$this->view($this->master, $this->prefix, $this->file_ext);	
		
	}

	/**
	 * @param $customer_id (int)
	 * 
	 * function to get the machinery for allocation..
	 * 
	 */

  Public function allocate($customer_id=NULL, $site_id=NULL)
  
  {
  	
  	/*
	 * Are we posting?
	 * 
	 */
	  
	if(!empty($this->posts))
	
	{
	
	/*
	 * Unset the hidden form field
	 */
	  	
	unset($this->posts['hidden']);
	
	/*
	 * Delete the records to insert new batch
	 * 
	 */ 
		
	$this->machinery_model->delete($site_id, 'site_id', 'allocation');	
  
	/*
	 * Insert the batch array...
	 */ 	
	        $this->machinery_model->my_array($this->posts, 
		    							
		    						        'allocation', 
		    										
		    						         NULL, 
		    										
		    						         array('customer_id' => $customer_id, 'site_id' => $site_id)
											 
											);
   
		//Return the success message
										
		 echo json_encode(array('message' => 'Allocation Successful..'));
		
		return false;
	}
	
	else 
	
	{
  	
	
	
	//Send the customer_id to the view 
	 
	$this->data['c_id'] = $customer_id;
	
	//Send the site_id to the view 
	 
	$this->data['s_id'] = $site_id;
	
	//Run the private function to get all the machinery data
	$this->machinery($site_id);
	
	
	//Load the view
	
	$this->load->view('clientarea/machinery/modules/allocation', $this->data);
	
	}
	
  }	


Public function staff_machinery_allocation($staff_id)

{
	
	if(!empty($this->posts))
	
	{
	
	/*
	 * Unset the hidden form field
	 */
	  	
	unset($this->posts['hidden']);
	
	/*
	 * Delete the records to insert new batch
	 * 
	 */ 
		
	$this->machinery_model->delete($staff_id, 'staff_id', 'allocation');	
  
	/*
	 * Insert the batch array...
	 */ 	
	        $this->machinery_model->my_array($this->posts, 
		    							
		    						        'allocation', 
		    										
		    						         NULL, 
		    										
		    						         array('staff_id' => $staff_id)
											 
											);
   
		//Return the success message
										
		 echo json_encode(array('message' => 'Allocation Successful..'));
		
		return false;
	}
	
	else 
	
	{
		
	//Assign the staff id to the view
	
	$this->data['s_id'] = $staff_id;	
	
	//Run the private function to get all the machinery data
	
	$this->machinery(NULL);
	
	/*
	 * check we have an array to avoid 
	 * 
	 * array_push error with empty args..
	 * 
	 */
	 
	  
		if(!isset($this->data['available']) )
	
			{
		
				$this->data['available'] = array();
		
			}
	
	/*
	 * Loop the machines and find the machines that belong to this
	 * 
	 * staff member
	 * 
	 */ 
	
	foreach ($this->data['machines'] as $m)
	
	{
		
		if($m->staff_id == $staff_id)
		
		{
			/*
			 * If we have a match then push it into the available array
			 * 
			 */
			  
			array_push($this->data['available'], $m->mach_id);
		}
	

}
	
	//Load the view..
	
	$this->load->view('clientarea/machinery/modules/staff_allocation', $this->data);
	
	}
}


Private function machinery($site_id=NULL)

{
	
	/*
	 * Get this customers machinery...
	 * 
	 */
  	
	$this->data['machines'] =$this->machinery_model->allocated_machines($this->data['data']->master_id);
	
	//Staff Machines Array
	
	$this->data['staffMachines'] = $this->machinery_allocation($this->data['machines'], 'staff_id');
	
	//Site Machines Array
	
	$this->data['siteMachines'] = $this->machinery_allocation($this->data['machines'], 'site_id', $site_id);
	
	// Available machines array 
	
	$available = array_merge($this->data['staffMachines'][1], $this->data['siteMachines'][1]);
	
	/*
	 * We need to find all the duplicates so we know whats 
	 * 
	 * in the pool of available machines
	 * 
	 */ 
			foreach(array_count_values($available) as $val => $c)
			
			{
    
    			if($c > 1) {
    				
							//Build the array of available machines for the pool...
    				
							 $this->data['available'][] = $val;
					
						}
				
			}
	
	//Count how many machines belong to staff
	 
	$this->data['staffCount'] =  count($this->data['staffMachines'][0]);
	
	//Count how many machines belong to a site
	 
	$this->data['siteCount'] =  count($this->data['siteMachines'][0]);
	
}
 
 
 Private function machinery_allocation($array, $key, $skip=NULL)
 
 {

 	
	/*
	 * We need to run some counts
	 * 
	 * Initialise the array's
	 * 
	 */
	 
	 $staff_all = array();
	 
	 $left = array();
	 
	 $all = array();
	 
	 
	 /*
	  * Start the counter
	  * 
	  */
	 
	 $i = 0;
	 
	 /*
	  * Loop the machines to find all elements with a staff id
	  * 
	  */
	 
	 foreach($array as $c)
	 
	 {
	 	
	 	$i++;
		
		//Build an array of machines attached to staff, $skip the current site_id
		
		if(!empty($c->$key) &&  $skip != $c->$key)
		
		{
			
			//Return the array of select ids
			
			 $all[] = $c->mach_id;
			 
		}
		
		else 
		
		{
			
			//Return the remainder to idenify machines left in the pool
			
			$left[] = $c->mach_id;
			
		}
		
	 }
	 
	 //Return an array of arrays
	 
	 return array($all, $left);
 }
 
 Private function no_machines()
 
 {
 	
 	$this->session->set_flashdata('warning', 'No Machines Have Been added yet!');
	
	header('Location: /clientarea/machinery/add/');
 }


}