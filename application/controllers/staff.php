<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',0);
ini_set('display_errors',0);
error_reporting(0);
/*
 * Cleansure Staff controller
 * 
 * Staff controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Staff
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Staff extends Clientarea_Controller {
	
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
	 *  For editing purposes we store the range of views into this array
	 * 
	 */ 
	
	Private $views = array('personal_data', 'staff_edit', 'convictions_checks', 'dbs_check', 'financial', 'medical', 'doctor_edit');
	
	/*
	 *   Corresponding tables that we will be inserting into
	 * 
	 */ 
	 
	 Private $tables = array(array('users', 'date'), array('date','staff','workwear'), 'convictions', 'certifications','finance','medical',array('medical', 'contact', 'address'));
	 
	 
	
	//Class constructor
	Public function __construct(){
		
        parent::__construct();	
		
		$this->load->model('staff_model');
		
		$js=array_push($this->js,'bootstrap-datepicker','main', 'live', 'staff');
		
		$this->data['js'] = javaScript($this->js); 
		
		$this->file_ext = '_'.$this->uri->segment(3);
		
		$this->posts = $this->input->post(NULL, TRUE);
		
		$this->config->load('register');
		
		$this->modules = 'clientarea/staff/modules/';
		
		$this->data['deleted'] = $this->staff_model->count_tasks('staff', array('deleted' => true));
		
	}
	
	
	
	Public function index($deleted=false, $sortable=false, $direction=false)
	
	{
			
		if( $this->staff_model->count_staff(false) > 0)
		
		{
			
			$row_data = $this->staff_model->all_staff(false, ((int)$deleted < 2 ? $deleted:0), $sortable, $direction);
			
			
			
			if(is_array($row_data) && count($row_data) > 0)
			
			{
				
			 
			
			  $this->pagination('clientarea/staff/'.($deleted == false ?  ($sortable != false ? 'sort_table/'.$sortable.'/'.$direction.'/':NULL):'deleted/'), 
			  
			  					$row_data, 
			  					
			  					'staff', 
			  					
			  					($deleted == false ?  ($sortable != false ? 6:3):4));
			  
			  }

		
			$this->view($this->master, $this->prefix);
			
		}
		
		else 
		
		{
			
			
			$this->no_staff();
		}
		
	}
	
	Public function sort_table($sort, $direction)
	
	{
		
		$this->index(false,$sort, $direction);
		
	}

	Public function deleted()
	
	{
		
		$this->data['final_delete'] = true;
		
		$this->index(true);
		
	}
	
	Public function reinstate($id)
	
	{
		
		$this->staff_model->update_row($id, 'id', 'staff', array('deleted' => (int)false));
		
		header('Location: /clientarea/staff'); 
	}
	
	
	Public function add_staff_member()
	
	{
		
		if(!empty($this->posts))
		
		{
			
			//all the fields that want validation
			$this->fields = array('title', 'first_name', 'last_name', 'gender', 'dob[]', 'evening_telephone','address_line_1[]', 'city[]', 'postcode[]', 'date[]');
			
			//Correspoding errors
			$this->errors = array('required', 'required','required', 'required', 'required', 'required', 'required', 'required', 'required','required');
			
			/*
			 * Created a function to return the loop
			 */
			  
			$this->runValidator($this->fields, $this->errors);
					
					//Check for errors
			      if ($this->form_validation->run() == FALSE)
				
				    {
				  	
					//Are we dealing with ajax?
					if($this->input->is_ajax_request())
					
					{
					   //Run the warning function
					   $this->warning('staff_warning');
						
		
					}
					
					else
					
					{
												
						//show the form and send the parameters of the failed fields
				  		$this->staff_form($this->form_validation->error_array());	
						
						
					}
						
					}
					
                     else
					 	
					
					{
						
						//Create the correct date of birth structure for insertion into db
						$this->posts['dob'] = strtotime($this->posts['dob'][2].'-'.sprintf('%02s',$this->posts['dob'][1]+1).'-'.sprintf('%02s',$this->posts['dob'][0]+1));
						
						//Get the id from the date table for the dob
						$dob_id = $this->Registration_Model->insert_return(array('date' => date('Y-m-d',$this->posts['dob'])), 'date');
						
						//When did we add the entry to the system
						$date_id = $this->Registration_Model->insert_return(array('date' => $this->time), 'date');
						
						/*
					 	 * Address Data to be inserted into the database 
					 	 * 
					 	 * We need to have a count of keys in case we need 
					 	 * 
					 	 * to add doctors address!!
					 	 */ 
					 
						$address_ids = $this->staff_model->my_array(array_slice($this->posts, 10, 6), 
		    										
		    									  										   'address', 
		    										
		    									   									            NULL, 
		    										
		    									   									           NULL);
																							   
																							  
						//Count array length....
					 
						$a_id = count($address_ids);
			
			          	/*
					 	 * Contact Data to be inserted into the database 
					 	 * 
					 	 * We need to have a count of keys in case we need 
					 	 * 
					 	 * to add doctors address!!
						 * 
					 	 */ 
					 
						 $contact_ids = $this->staff_model->my_array(array_slice($this->posts, 5, 5), 
		    										
		    									  										   'contact', 
		    										
		    									   									            NULL, 
		    										
		    									   									           NULL);
					
						 //Count array length....
					 
						 $c_id = count($contact_ids);
						 
						 
						 /*
					      * We now need to create the reference for the user profiles
					      * 
					      */ 
					      
					     $ref = array('reference' => createReference($this->posts['last_name'].$this->posts['first_name'], $dob_id));
						 
						 /*
						  * Insert the above array into the table "reference" so provide a unique reference that we can use to search from.
						  * 
						  * Get the id back for the user table
						  */ 
						 
						 $ref_id = $this->staff_model->insert_return($ref, 'reference', true);
						 
						 
						 $user_array = array('address_id'      => $address_ids[0], 
						 
						 					 'contact_id'      => $contact_ids[0], 
						 					 
											 'company_id'      => $this->data['data']->master_id,
						 					 
											 'dob_id'          => (int)$dob_id,
											 
											 'date_id'         => (int)$date_id,
											 
											 'reference_id'    => (int)$ref_id,
						 					 
						 					 'type'            => (int)$this->config->item('staff'),
											 
											 'master_id' => $this->data['data']->master_id);
											 
						 /*
						  * Create user array so we can trck them
						  * 
						  * Slice the post vars and merge above array
						  * 
						  * Get the user id returned..
						  */
											 
						 $user_id = $this->staff_model->insert_return(array_merge(array_slice($this->posts, 0, 4), $user_array),'users', true);
						 
						 /*
						  * Create a start date for the staff member
						  * 
						  * we have a datepicker in case they started before or
						  * 
						  * going to start in the future and pre-entered
						  * 
						  */
						 
						 $startDate = $this->staff_model->insert_return(array('date' => (isset($this->posts['startToday']) ? $this->time : date("Y-m-d",strtotime($this->posts['date'][0])))),
						 
						 													  'date');
																		
						/*
						 * We are dealing with an array that changes size dependant on user input
						 * 
						 * so we need to find its numeric position in the current post vars,
						 * 
						 * this class has private function to find the array position, then slice from the that offset!
						 */												
																		
						$staff_key = $this->arrayMarker('job_title');
						
						/*
						 * Create an array of additonal attributes for staff table
						 * 
						 */ 
																		
						$staffArray = array('user_id' => $user_id, 'master_id' => $this->data['data']->master_id, 'start_from' => $startDate, 'type' => false);
						
						/*
						 * Merge above array with a slice of the post vars, insert and return the correct id
						 * 
						 */ 
						
						$staff_id = $this->staff_model->insert_return(array_merge($staffArray, array_slice($this->posts, $staff_key, 10)), 'staff');
						
						/*
						 * Insert the workwear data into the system using @param staff_id
						 * 
						 */
						

						$this->staff_model->insert(array_merge(array('staff_id' => $staff_id), array_slice($this->posts, $staff_key + 10,2)), 'workwear');
						
						
						/*
						 * Use the above offset, count the correct position in array from that key
						 * 
						 * Check if convictions is true and move the counter on the slice to facilitate
						 * 
						 * the additional post vars ready to be inserted.
						 * 
						 */ 
							
						$this->staff_model->insert(array_merge(
						
													array_slice($this->posts, $staff_key + 12, ($this->posts['conviction'] == true ? 3:1)),
													
													array('staff_id' => $staff_id))
													
													, 'convictions');
						/*
						 * Have this user been dbs checked?
						 * 
						 * if so add the check to their records,
						 * 
						 * we are using certifications table to hold these records!
						 * 
						 */
						 
							
						$this->staff_model->insert(array('staff_id' => $staff_id, 
						
														 'type' => (int)$this->config->item('dbs'), 
														 
														 'dbs' =>  $this->posts['dbs'],
														 
														 'dbs' =>  $this->posts['dbs'],
														 
														 'signiture'=> $this->posts['signiture'],
														 
														 'discrepencies' => $this->posts['discrepencies']), 
														 
														 'certifications');
							
							
						
						/*
						 * Has the user decided to add payroll?
						 * 
						 * If yes, we slice the array using the arrayMarker function to get the array key
						 * 
						 * Add the staff id, merge arrays and insert....
						 */ 
						
						if(array_key_exists('payroll_number', $this->posts))
							
							{
								
								$this->staff_model->insert(array_merge(array('staff_id' => $staff_id), array_slice($this->posts, $this->arrayMarker('payroll_number'), 7)), 'finance');
								
							}
							
						/*
						 * Count how many contact vars are being posted
						 */ 
							
						$c = count($this->posts['daytime_telephone']);
						
						/*
						 * Are we posting more than 1?
						 * 
						 * If yes we need to insert these records into the contact table and return the id
						 * 
						 * This id will be used for medical join, doctors details
						 * 
						 */ 
							
						if( $c > 1 )
						
						{
							
						$cont_id = $this->staff_model->insert_return(array('daytime_telephone' => $this->posts['daytime_telephone'][1], 
						
																		   'evening_telephone' => $this->posts['evening_telephone'][1]), 'contact');
						
						}	
						
						/*
						 * Insert the medical records based upon certian conditions
						 * 
						 * 1.) has it got contact details? yes - insert id / no - insert 0
						 * 
						 * 2.) User the counter from the address id array? have we  got 2 entries? insert the second, if not 0
						 * 
						 * 3.) As this array can also change size depending on selection we need to create a double offset by you the arrayMarker function
						 * 
						 * on 2 periters, this allows us to calculate the array length so we insert the correct data
						 * 
						 */ 

						$this->staff_model->insert(array_merge(array('staff_id'   => $staff_id,
						
																	 'contact_id' => ($c > 1 ? $cont_id:0),
																	 
																	 'address_id' => ($a_id > 1 ? $address_ids[1]:0)),
																	 
																	 array_slice($this->posts, $this->arrayMarker('dermatitis'), 
																	 
																	 		     $this->arrayMarker((array_key_exists('doctors_name', $this->posts) ? 'doctors_name' : 'contact_doc')))) 
																	 
																	 ,'medical');
																	 
																	 
					
																	 
					 //Give the user a success message to say all well!
				
				  	$this->data['message'] = $this->lang->line('staff_added');
					
					//Encode view data and message into json format for ajax purposes
				
				   	echo json_encode(array('message' => $this->load->view('/clientarea/modules/flashmessage', $this->data, true)));
					
					//Return false so the user does not get double view load....		
						
					return false; 
						
					}							
						
					
					
					return false;
				  
			
		}
		
		$this->data['arr'] = true;
	
		$this->staff_form(NULL);
		
		$this->view($this->master, $this->prefix, $this->file_ext);	
		
	}


	/*
	 * To edit any of the staff profile modules or select the appropriate
	 * 
	 * editing form, this function will load views and submit
	 * 
	 */ 

		
	function edit($id, $view, $second_id=NULL, $third_id=NULL)
	
	{
		
		/*
		 * We need to check if we are posting or not!
		 * 
		 */ 
		
		if(!empty($this->posts))
		
		{
			
			
			/* 
			 * We need to find the key of the view in our array,
			 * 
			 * the key can then be used to identify the corresponding tables needed to insert data
			 * 
			 */ 
			
			$key =  array_search($view, $this->views);
			
			
			/*
			 * Is the corresponding table array key an array if so we
			 * 
			 * need to loop over them and insert into multiple tables
			 * 
			 */
			 
			if(is_array($this->tables[$key]))
			
			{
				
				/*
				 * Check over the post array to look for the dob key
				 * 
				 */ 
				
				if(array_key_exists('dob', $this->posts))
				
				{
					
					//Format the data so it can be converted into the correct structure					
				   $y = $this->posts['dob'][2]; $m = $this->posts['dob'][1] + 1; $d = $this->posts['dob'][0]+1;
					
				   //Create a correct date format for date of birth 
				   $this->posts['dob'] = $y.'/'.$m.'/'.$d;
				   
				   //run it through the helper function to correct the format to insert.				
				   $this->posts['date'] = insert_date(str_replace(' ', '',$this->posts['dob']));
					
				   //Remove the dob array element	
				   unset($this->posts['dob']);				
					
				}
				
				//Have we got the date key within the posts array
				elseif(array_key_exists('date', $this->posts))
				
				{
					
					//Again create the correct format using the datetime php function
					$this->posts['date'] = DateTime::createFromFormat('m-d-Y H:i:s',$this->posts['date'][0]);
					
				}
				
				/*
				 * splitkey array consists of the slicing values for each iteration of
				 * 
				 * the loop, we use the view data as keys to identify which inner array needs iterating...
				 * 
				 */
				  
				$splitKeys = array(
				
						
						'personal_data' => array(
						
												array(0,-1),
												
												array(4,1)
												
												),
												
						'staff_edit'    => array(
						
												array(0,1),
												
												array(1,-2),
												
												array(11,2)
											
												),
												
						'doctor_edit'  => array(
						
												array(0,2),
												
												array(2,2),
												
												array(4,6)
						
												)
					
				);
				
				/*
				 * Set a counter up to run some conditions
				 * 
				 */ 
				
				$i=0;
				
				/*
				 * Use the view to get the inner array by the key
				 * 
				 * We then loop over the inner array using foreach
				 * 
				 */ 
				
				foreach($splitKeys[$view] as $k)
				
				{
					
				/*
				 * Update the relavent tables using the arrays at the head of the class
				 * 
				 * Run checks on all the conditions to make sure we are inserting the correct credentials...
				 * 
				 */  
					
				$this->staff_model->update_row(
					
												($second_id != NULL && $i==1 ? $second_id:($third_id != NULL && $i == 1 ? $second_id: ($third_id != NULL && $i > 1 ? $third_id:$id))), 
													
												($view === 'personal_data' || ($view === 'staff_edit' && $i < 2) || ($view === 'doctor_edit' && $i > 0)  ? 'id':'staff_id'),
													
												$this->tables[$key][$i],
													
												array_slice($this->posts, $k[0], $k[1]));
					
					$i++;
					
				}
				
			
				
			}

               else
			   	
			{
				//We are not dealing with an array  so just a single insert				
				$this->staff_model->update_row($id, 'staff_id', $this->tables[$key], $this->posts);
				
			}
			
			//Return json success message
			echo json_encode(array('message' => 'Successfully updated'));
			
			return false;
			
		}

		//We are not posting at all, we need to get the correct view and data for editing purposes
		
		else 
		
		{
			
			
		/*
		 * Switch the view data to load correct data.
		 */
		  	
		switch($view)
		
		{
			
			case 'personal_data':
				
				$this->data['row_data'] = $this->staff_model->staff_details($id);
				
				$this->fields = array();
					
				$this->errors = array();
				
				$this->title();
				
				$this->form_data($this->fields, $this->data['row_data'], 0);
				
				$this->dob();
				
			break;
			
			case 'staff_edit':
				
			      $this->data['row_data'] = $this->staff_model->staff_employment($id);
				  
		    break;
			
			case 'dbs_check':
				
			      $this->data['row_data'] = $this->staff_model->get_row('certifications', 'staff_id', $id);
				  
		    break;
			
			case 'convictions_checks':
				
				$this->data['row_data'] = $this->staff_model->get_row('convictions', 'staff_id', $id);
				
			break;
			
            case 'financial':
				
				$this->fields = array();
				
				$this->data['row_data'] = $this->staff_model->get_row('finance', 'staff_id', $id);
				
				$this->financial($this->fields, $this->data['row_data']);
				
				$this->modules = 'clientarea/modules/';
				
			break;
			
			case 'medical':
				
				$this->data['row_data'] = $this->staff_model->get_row('medical', 'staff_id', $id);
				
			break;	
			
			case 'doctor_edit':
				
				
				$this->fields = array();
				
				$this->data['row_data'] = $this->staff_model->staff_medical($id);
				
				$this->form_data($this->fields, $this->data['row_data'], 4);
				
				$this->address($this->fields, $this->data['row_data']);
			
		}

    }

		/*
		 * Load the view based upon the above case statement
		 * 
		 * 
		 */
		  
        $this->load->view($this->modules.$view, $this->data);
		
	}

	/*
 	 * Delete function, we set the table column deleted to true 
	 * 
	 * if we still delete after setting the column to true, we then do full
	 * 
	 * delete, the user needs warning as this may affect other data within the system..
     * 
     */ 
     
     Public function delete($id, $user_id, $final_delete=false)
	 
	 {
	 	
		$ids = $this->staff_model->get_row('users', 'id', $user_id);
	 	
		//Are we running the final delete?
		
	 	if($final_delete == true)
		
		{
			
			//Yep! Get the rest of the tables we need to delete from..
			
			
			
			$tables = array('address.id'             => $ids->address_id, 
			
							'contact.id'             => $ids->contact_id, 
							
							'date.id'                => $ids->dob_id, 
							
							'date.id'                => $ids->date_id,
							
							'convictions.staff_id'   => $id,
							
							'finance.staff_id'       => $id,
							
							'holidays.staff_id'      => $id,
							
							'medical.staff_id'       => $id,
							
							'messages.user_id'       => $user_id,
							
							'staff.id'               => $id,
							
							'users.id'               => $user_id,
							
							'wk_orders_staff.staff_id' => $id
    							 
							);
							
				foreach($tables as $row => $key)
				
				{
					
					$table = explode('.', $row);
					
					$this->staff_model->delete($key, $row, $table[0]);
				}

			$this->addAlert($id, $ids->first_name.'&nbsp;'.$ids->last_name.' has been completely removed from the system!');
			
			return false;
		}
		
		//16/36
		
		else 
		
		{
			
			$this->staff_model->delete_row($id, 'staff');
			
			$this->addAlert($id, $ids->first_name.'&nbsp;'.$ids->last_name.' has been marked for final deletion!');
			
			return false;
								 
		
			
		}
		
		
	 }

	/*
	 * Profile Page data
	 * 
	 */ 

   Public function profile($staff_id)
	 
	 {
	 	
		$this->data['row_data'] = $this->staff_model->staff_profile($staff_id);
		
	//	print_r($this->data['row_data']);
		
		$this->view($this->master, $this->prefix, $this->file_ext);	
		
	 }
	 
	 /*
	  * View the sites the staff are working at...
	  * 
	  */ 


	Public function view_sites($staff_id)
	
	{
		
		$this->data['sites'] = $this->staff_model->get_sites($staff_id);
		
		
		$this->load->view($this->modules.'sites', $this->data);
	}

    /*
	 * Staff holiday request dates section
	 * 
	 * This section we will be able to book, confirm holdays through the model form on staff overview section
	 * 
	 * We will constrain the section so it will only bring out dates from the current year
	 * 
	 */
	  
	Public function holidays($view, $staff_id)
	
	{
		
		/*
	 	 * Get Staff Members Name
	     * 
	     */ 
									 
	    $staff_name = $this->staff_model->staff_name($staff_id);
		
		/*
		 * We need to check if we are posting data
		 * 
		 */ 
		
		if(!empty($this->posts))
		
		{
			
			
			//all the fields that want validation
			$this->fields = array('date[]');
			
			//Correspoding errors
			$this->errors = array('required');
			
			//Run them through the validator
			$this->runValidator($this->fields, $this->errors);
					
				//Check for errors
			      if ($this->form_validation->run() == FALSE)
				
				    {
				  		
						//Check we are dealing with ajax
						if($this->input->is_ajax_request())
					
							{
					   		
					   			//Run the warning function
					  			 $this->warning('staff_warning');
						
							}
					
								else
					
							{
												
								//show the form and send the parameters of the failed fields
				  				$this->form_validation->error_array();	
						
						
							}
					
					}
					
				  		else
				  	
							{
								
								
								/*
								 * Loop through the posts and rebuild array to format dates
								 * 
								 * ready to be inserted into the database...
								 * 
								 */ 
					
					 			foreach($this->posts['date'] as $p)
					 
					 				{
					 	
									$dates[] = insert_date($p);
						
					 				}
					 				
									/*
									 * Unset the post array so don't duplicate bad data
									 * 
									 */
									  
					 				unset($this->posts['date']);
									
									/*
									 * Move the new array back into post array ready for insertion
									 * 
									 */ 
					 
					 				$this->posts['date'] = $dates;
									
									/*
									 * Batch insert of the dates into the 
									 * 
									 * dates table and return both the last inserted keys..
									 * 
									 */ 
									 
									 
								/*
								 * We need to run some checks here, are we posting or editing...
								 * 
								 * Using the below switch, we can alternate the functions accordingly...
								 * 
								 */ 
						
								switch($view)
			
							{
								
							/*
							 * We are dealing with inserting a holiday first..
							 * 
							 */ 
				
							case 'holiday_request':
					
								
								
					
				     				$date_ids = $this->staff_model->my_array($this->posts, 'date', NULL, NULL);
									
									/*
									 * We now take the keys from inserting the dates and use the array to insert into holidays table...
									 * 
									 * We then need to add further keys to the array as its a new holiday request
									 * 
									 * Request = if the holiday is still in request mode, Approval = has it been approved by a manager?
									 * 
									 * Type = 0 = start date | 1 = end date, we can the calculate the duration
									 * 
									 */ 
					 
					 				$this->customer_model->insert(array('staff_id' => $staff_id, 
		    									   				 					
		    									   		   				'request'  => false, 
		    									   				 						  
		    									   		   				'approval' => false,
														                   
																		'year'     => date('Y'),
																		
																		'start_id' => $date_ids[0],
																		
																		'end_id'   => $date_ids[1]), 
		    										
		    									  				        'holidays'
		    										
		    									   	                );
									
									
									/**
									 * Private Alert function
									 * 
									 * @param $staff_id
									 * 
									 * @param $event
									 * 
									 */ 
									
									$this->addAlert($staff_id, sprintf($this->lang->line('holdiday_request_event'), $staff_name->first_name.'&nbsp;'.$staff_name->last_name));
										
				
				break;
				
				/*
				 * If we are updating holiday data we use the below statement
				 * 
				 * 
				 */ 
				
                 case 'staff_holidays':
					 
					 
					 if(!isset($this->posts['ids']))
					 
					 {
					 	
						$this->holidays('holiday_request', $staff_id);
						
						return false;
						
					 }
					 
					 /*
					  * We create some ids with jquery and append them with hidden input
					  * 
					  * explode the value to get the correct keys
					  * 
					  */ 
					 
					$ids = explode('#', $this->posts['ids']);
					
						/*
						 * Start the counter
						 * 
						 */ 
					 
					 $n=0;
					 
					 /*
					  * Loop the ids and update each row accordingly
					  * 
					  */ 
					 
					 foreach($ids as $id)
					 
					 {
					 	
						$this->staff_model->update_row($id, 'id', 'date', array('date' => $dates[$n]));
						
						$n++;
						
					 }
					 
					
				/**
		 		 * Private Alert function
		         * 
		         * @param $staff_id
		         * 
		         * @param $event
		         * 
		         */ 
									
		$this->addAlert($staff_id, 
		
								 $this->data['data']->first_name.'&nbsp;'.$this->data['data']->last_name. 
						
						         sprintf($this->lang->line('holdiday_edit_event'), 
						
						         $staff_name->first_name.'&nbsp;'.$staff_name->last_name)
								 
						);
		
					 
					  
				break;
				
			}
						
			//Return json success message
			echo json_encode(array('message' => 'Successfully updated'));
			
			return false;
			
			}

		}
		
		else 
		
		{
			/*
			 * Run a check on which view we are dealing with
			 * 
			 * 
			 */ 
			
			if($view == 'staff_holidays')
			
			{
			
				/*
				 * We got the right view
				 * 
				 */
				  
			   $data = $this->staff_model->get_holiday_dates($staff_id);
			   
			   /*
			    * Check $arr length, is it greater than 0, if yes we have some dates
			    * 
			    */ 
			   
			   if(is_array($data) && count($data) > 0)
			   
			   {
			   	
				/*
				 * Which staff member are we applying the holidays to
				 */ 
			   
			   $this->data['header'] = $data[0]->first_name."&nbsp;".$data[0]->last_name."&nbsp;-&nbsp;".$data[0]->reference;
			   
			   /*
			    * Loop the data
			    * 
			    */ 
			   		   
			   foreach($data as $d)
			   
			   {
			   	
				
				/*
				 * Upcoming holiday, it has been authorized by admin and the date is greater then the current date
				 * 
				 */ 
				
				if($d->request == true && $d->approval == true && strtotime($d->finish_date) > time())
				
				{
					/*
					 * Create a an array for the dates 
					 */
					  
					$this->data['row_data_1'][] = $d;
					
				}
				
				/*
				 * Holiday history, this will show what holidays the staff member has had in the current year
				 * 
				 */ 

				elseif($d->request == true && $d->approval == true && strtotime($d->finish_date) < time()) {
					
					/*
					 * Create a an array for the dates 
					 */
					 
					$this->data['row_data_2'][] = $d;
					
				 }
				
				/*
				 * Holidays awaiting confirmation
				 * 
				 */
				  
				elseif($d->request == false) {
					
					/*
					 * Create a an array for the dates 
					 */
					
					$this->data['row_data_3'][] = $d;
					
				 }
				
			    }
			   
			   }
			   
			}
			
			$this->load->view($this->modules.$view, $this->data);
			
		}
		
		
		
		
	}
	
/*
 * This function handle updating the dates or removing the holidays completely
 * 
 */ 
 
 
 function update_holidays($start_id=NULL, $finish_id=NULL, $hol_id=false, $staff_id=false)
 
 {
 	
	/*
	 * Get Staff Members Name
	 * 
	 */ 
	 
if($staff_id > 0)

{
									 
   $staff_name = $this->staff_model->staff_name($staff_id);
   
}
   
 	/*
	 * If the holiday we are going to get the data to edit
	 * 
	 * 
	 */ 
	
	if($hol_id == false)
	
	{
		
		/*
		 * Create an array of ids
		 * 
		 */ 
		
		$ids = array($start_id, $finish_id);
		
		/*
		 * Loop the ids to build a dates array from db query
		 * 
		 */
		  
		foreach ($ids as $i)
		
		{
			
		  /*
		   * We just get the date back here but we need to first remove the time before we can display
		   * 
		   */
		    
	      $dates[] = remove_time($this->staff_model->get_row('date', 'id', $i)->date);
		  
			
		}
		
		/*
		 * Return a json array to display data in the model
		 * 
		 */ 
		
		echo json_encode(array_merge($dates, $ids));
		
		return false;
		
	}
	
	else 
	
	{
		
		/*
		 * we are deleting data so we need to create an array
		 * 
		 * here we are inserting into same table twice, so add numeric value to key and remove again with substr
		 * 
		 */ 
		
		$vars = array('date1' => $start_id, 'date2' => $finish_id, 'holidays3' => $hol_id);
		
		/*
		 * Loop them and delete the data as requested
		 * 
		 * 
		 */ 
		
		foreach($vars as $table => $id)
		
		{
			
			$this->staff_model->delete($id, 'id', substr($table,0,-1));
			
		}
		
		
									
		/**
		 * Private Alert function
		 * 
		 * @param $staff_id
		 * 
		 * @param $event
		 * 
		 */ 
									
		$this->addAlert($staff_id, 
		
								 $this->data['data']->first_name.'&nbsp;'.$this->data['data']->last_name. 
						
						         sprintf($this->lang->line('holdiday_deny_event'), 
						
						         $staff_name->first_name.'&nbsp;'.$staff_name->last_name)
								 
						);
		
		/*
		 * Return confirmation message that all has been deleted. 
		 * 
		 */
		  
		echo json_encode(array('message' => 'Holiday Deleted'));
		
		return false;
	
	}
 }
 

function approval($approval=false, $hol_id=NULL, $staff_id)
	
{
	
	if ($approval != false)
	
	{
		/*
		 * Approve the holiday
		 * 
		 */ 
		
		$this->staff_model->update_row($hol_id, 'id', 'holidays', array('request' => $approval, 'approval' => $approval));
		
		/*
	 	 * Get Staff Members Name
	     * 
	     */ 
									 
	    $staff_name = $this->staff_model->staff_name($staff_id);
									
		/**
		  * Private Alert function
		  * 
		  * @param $staff_id
		  * 
		  * @param $event
		  * 
		  */ 
									
		$this->addAlert($staff_id, 
		
								 $this->data['data']->first_name.'&nbsp;'.$this->data['data']->last_name. 
						
						         sprintf($this->lang->line('holdiday_confirm_event'), 
						
						         $staff_name->first_name.'&nbsp;'.$staff_name->last_name)
								 
						);
		
	     /*
		  * Return message
		  */ 
	
	    echo json_encode(array('message' => 'Approval Accepted'));
	
	}
	
	else {
		
		echo json_encode(array('message' => 'Whoops Something went wrong!, we have logged the error and will deal with issue shortly.. Error Code :#0087665'));
	}
	
	return false;	
}

/*
 * Function Status
 * 
 * Allows the user to de-activate the status...
 * 
 */ 

Public function status($id, $status)

{
	
	$this->staff_model->update_row($id, 'id', 'staff', array('status' => (int)$status)); 
	
	header('Location: /clientarea/staff');
}
	
/*
 * Private functions go here
 * 
 */
 
 Private function arrayMarker($key)
 
 {
 	
	return array_search($key, array_keys($this->posts));
	
 }
 
 
 Private function addAlert($staff_id, $event)
 
 {
 	
									 
	/*
	 * Insert the log
	 * 
	 */ 
									  
	$log_id = $this->staff_model->insert_return(array(
									  
									                   'ip'  => ip2long($this->data['data']->ip_address),
		
					 
					 								    'user_id' => $staff_id
																					   
													  ), 
																					   
												'logs');
													
	 /*
	  * We need to now add an event to the system, this will provide an alert for admins
	  * 
	  * 
	  */ 
									 
									 
	$this->customer_model->insert(array(
									 
									 	'master_id' => $this->data['data']->master_id,
									 									
										'event' => $event,
																		
										'time'  => $this->time,
																		
										'status' => true,
																		
										'logs_id' => $log_id
									 
									 	), 
									 	
									 	'events');
									
	  /*
	   * Update the alerts in the session data
	   * 
	   */ 								
																	
	    $this->updateAlerts();
		
		return true;
 }
 
 
 Private function staff_form($fields=NULL)
 
 {
 	
	$this->title($fields);  
	
	for($i=0;$i<5;$i++)
	
	{
							
	$this->form_data($fields, NULL, $i);
	
	}
										
	$this->dob($fields);
	
	$this->address($fields);
	
	$this->financial($fields);
	
 }
 
 
 Private function no_staff()
 
 {
 	
 	$this->session->set_flashdata('warning', $this->lang->line('no_staff'));
	
	header('Location: /clientarea/staff/add/');
 }


}