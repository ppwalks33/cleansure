<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',0);
ini_set('display_errors',0);
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

class Specifications extends Clientarea_Controller {
	
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
	
	
	/**
	 *@param array 
	 *
	 * Private varaible tasks
	 * 
	 * Array slice of posts Args
	 */ 
	
	
	Private $tasks = array();
	
	/**
	 *
	 * Private varaible folder
	 * 
	 * To store the name of the upload folder within the script;
	 */ 
	
	
	Private $my_folder;
	
	 
	 
	
	//Class constructor
	Public function __construct()
	
	{
		
        parent::__construct();	
		
		
		$this->load->library('uploader');
		
		/**
		 * @param load the corresponding model
		 * 
		 */
		
		$this->load->model('specifications_model');
		
		/**
		 * @param push the required js files for this section
		 * 
		 */ 
		
		
		$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker','live',  'specifications', 'fileupload');
		
		
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
		
		
		
		$this->data['modules'] = 'clientarea/specifications/modules/';
		
		/*
		 * Post array
		 * 
		 */
		 
		$this->posts = $this->input->post(NULL, TRUE);
		
		
		/**
		 * @param $this->date_id (int)
		 * 
		 */ 
		
		$this->date_id = (int)
		
		
		
		/*
		 * This array is used throughout to build the tables in most of the specification views
		 * 
		 * 
		 */ 
		
		$this->data['atts'] = array('Broom Sweep' => 'broom', 'Kex Sweep' => 'kex', 'Spot Mop' => 'spot', 'Full Mop' => 'full', 'Spot Vacuum' => 'spot_vac', 'Full Vacuum' => 'full_vac',
				
									'Remove Rubbish' => 'rubbish', 'Spray Wipe Furniture' => 'spray_furn', 'Spray Wipe Work Surfaces' => 'spray_surf', 'Clean Sink Unit' => 'sink', 'Dust Low Ledges' => 'low_dust',
				
				                    'Dust High Ledges' => 'high_dust', 'Clean Telephones' => 'tel', 'Clean Light Switches' => 'clean_light', 'Clean Skirtings' => 'clean_skirt', 'Clean Hand Rails' => 'clean_hand',
				
				                    'Lift Control Panel' => 'lift_panel', 'Clean Mirrors' => 'mirrors', 'Clean Toilet Bowls' => 'toilet_bowl', 'Clean Toilet Fittings' => 'toilet_fitting', 'Clean Hand Basins' => 'hand_basins', 
				
				                    'Clean Dispensers' => 'dispensers', 'Replenish' => 'replenish');
				
		 /*
		  * Headers array which gets inserted into the array above to produce custom headers...
		  * 
		  * Keep arrays seperate for further extendibility...
		  * 
		  */ 
			      
	     $this->data['headers'] = array('Floors', 'Fittings &amp; Fixtures', 'Toilets');
		 
		 
		 /**
		 * Qa Session array
		 * 
		 * @param Array..
		 */ 
		
		$this->scores = (is_array($this->session->userdata('scores')) ? $this->session->userdata('scores'):NULL);
		
		
		/**
		 * Qa files array
		 * 
		 * @param Array..
		 */ 
		
		$this->qafiles = (is_array($this->session->userdata('qafiles')) ? $this->session->userdata('qafiles'):NULL);
		 
		 /**
		 * Have we already got session keys, if so move them into variable
		 * 
		 * * @param Array.. 
		 */ 
		
		$this->sesskey = (is_array($this->session->userdata('siteCheck')) ? $this->session->userdata('siteCheck'):NULL);
		
		
		
	}
	
	
	
	Public function index($site_id=NULL, $unique=false)
	
	{
		
		//Unset the files
		
		 $this->session->unset_userdata(array('qafiles', 'score'));
		 
		
		/*
		 * Check if we have an active form
		 * 
		 */ 
		
		if( $site_id != NULL )
		
		{
			
			
			
			/*
			 * Are we posting?
			 */ 
		
			if(!empty($this->posts))
		
		       {
					
					/*
					 * If we are sending a unique accross we don't need 
					 * 
					 * to generate one or test for session...
					 * 
					 */
					  
					if( $unique == false )
					
					   {
					   	
						
					   	
						/*
						 * Check we have an array and that the key exists
						 */
						  
						if(is_array($this->sesskey) && array_key_exists($site_id, $this->sesskey))
						
						{
							
							/*
							 * Return the right unique key from previous submission for ref
							 */ 
						
							$unique = $this->sesskey[$site_id][0];	
							
							
							/*
							 * Return the right unique key from previous submission for date
							 */ 
							
							$this->date_id = $this->sesskey[$site_id][1];	
							
							
    
						}

							else 
		
						{
						
						/*
					  	 * Insert the date for the logs and so we can identify when the specification was added
					     * 
					     * 
					     */
					  
					     $this->date_id = $this->specifications_model->insert_return(array('date' => $this->time), 'date');
						
						/*
						 * This hasn't been added yet so we need to generate a new unique key
						 * 
				         */ 
							 
						
							 
						$unique = uniqid();
						
						/*
						 * Add it to the array
						 * 
						 */ 
						
						$this->sesskey[$site_id] = array($unique, $this->date_id);	
						
						/*
						 * Add it to the session array...
						 * 
						 */ 				
 			
						$this->session->set_userdata('siteCheck', $this->sesskey);
						
						}
						
					   
					   //End if > unique
					   
					  }
					
					
					//all the fields that want validation
					$this->fields = array('area');
			
					//Correspoding errors
					$this->errors = array('required');
					
					//run the validator
					
					$this->runValidator($this->fields, $this->errors);
					
					//Are we valid
					
							if ($this->form_validation->run() == FALSE)
				
				  				{
					
									echo json_encode($this->form_validation->error_array());
					
				 				 }
				  
								else
						
								{
									
									
									
								/*
								 * We have some eronous array elements that need to be extracted
								 * 
								 * $ft - floor type was in the wrong position for slice
								 * 
								 * $note is singular so can be extracted for single query
								 * 
								 */ 	
									
									 
			                         $ft = $this->posts['floor_type'];
										
								     $note = $this->posts['message'];
									 
								/*
								 * Remove Them from the array
								 */ 
										
								unset($this->posts['floor_type'],  $this->posts['message']);
										
									
									
								/*
								 * Create the Spec array to insert into the spec db
								 * 
								 * 
								 */
					   
					                $spec = array('user_id' => $this->data['data']->user_id, 'date_id' => $this->date_id, 'site_id' => $site_id, 'area' => $this->posts['area'], 'unique' => $unique);
									
		
									
								/*
								 * Insert the spec into the spec table
								 * 
								 */
									
									$spec_id = $this->specifications_model->insert_return(array_merge( $spec, array_slice($this->posts, 0,3)), 'spec');
									
									
								
							   /*
								* Insert in measurment table
								* 
								*/ 
								
								
									$dim_id = $this->specifications_model->insert_return( array_slice($this->posts, 3,4), 'measurments');
									
									
								/*
								* Insert in messages table (Notes)
								* 
								*/ 
								
								
									$message_id = $this->specifications_model->insert_return( array('message' => $note), 'messages');
									
									
								/*
								 * Create an array to add to the data
								 * 
								 * Insert the SCI into the tasks table for that site and area...
								 * 
								 */
								 
								 $sci = array_merge(array('dim_id' => $dim_id, 'spec_id' => $spec_id, 'message_id' => $message_id, 'site_id' => $site_id), array_slice($this->posts, 7,8));
								 
								 
								 $this->specifications_model->insert($sci, 'sci');
								 
								 
								 /*
								 * Insert the tasks into the tasks table for that site and area...
								 * 
								 */
								 
								$this->tasks = array_slice($this->posts,15);
								
									
								$this->specifications_model->insert(array_merge(array('spec_id' => $spec_id), $this->tasks), 'tasks');
									
								/*
								 * Return Json message
								 * 
								 * 
								 */
								 
							     echo json_encode(array_merge(array('area' => $this->posts['area']), $this->tasks));
					   
								}
					
				}
			   
					else
				{
						
					/*
					 * Additional Form Attributes...
					 * 
					 * Spec type = type of spec required i.e type of area...
					 * 
					 * SCI = If the SCI is available
					 * 
					 * Density = Option (Dropdown) within the SCI form - new spec
					 * 
					 */ 	
						
					$this->data['spec_type'] = array(''=>'Please Select Type', 
		   					
		   								              '0'=>'Standard Room', 
		   								
		   								              '1'=>'Toilet',
													  
													  '2'=>'Staircase');
													  
													  
													  
				  $this->data['sci'] = array(''=>'Please Select Type', 
		   					
		   								              '0'=>'Eyeballing', 
		   								
		   								              '1'=>'Detailed SCI');	
													  
													  
													  
				 $this->data['density'] = array(      '1'=>'Very High', 
		   								
		   								              '2'=>'High',
													  
													  '3'=>'Medium',
													  
													  '4'=>'Low',
													  
													  '5'=>'Very Low');		
					
					/*
					 * Load model with tasks form
					 * 
					 */
					
					$this->load->view($this->data['modules'].'tasks', $this->data);
					
				}
		}
		
		else 
		
		{
			
		/*
		 * Main view to show the main specifications page
		 * 
		 * Get the customers for the dropdown
		 * 
		 */
			
		$this->get_customers();
		
		/*
		 * Have another check to see if we got a session key, if we are going to create 
		 * 
		 * another menu of recently added items so we can have multiple options available.
		 * 
		 */
		 
		 
		$this->hasKey();
		
		/*
		 * Show the message to alert the user what they can do
		 * 
		 * 
		 */

		$this->session->set_flashdata('info','&nbsp;&nbsp;Did You Know? You can overwrite the current Specification of Work by Creating a \'New\' Specification!');
		
		/*
		 * 
		 * Set The Header
		 * 
		 */
		 
		$this->data['header'] = 'Specification of Work Details';
		
		
		/*
		 * 
		 * Load the view..
		 * 
		 */
		
		
		
		$this->view($this->master, $this->prefix);	
		
		
		}
		
		
	}

	Public function recent($site_id, $unique)
	
	{
		
		/*
		 * Have another check to see if we got a session key, if we are going to create 
		 * 
		 * another menu of recently added items so we can have multiple options available.
		 * 
		 */
		 
		 
		$this->hasKey();
		
		/*
		 * get the data from the database
		 * 
		 */ 
		 
		 $this->data['tasks'] = $this->specifications_model->recent($site_id, $unique);
		 
		
		/*
		 * Load the view...
		 */ 
		
		$this->view($this->master, $this->prefix , $this->file_ext);	
	}
	
	/*
	 * Simply show the user the last specification in the system
	 * 
	 */ 
	
	function last_spec($site_id, $unique)
	
	{
		
		/*
		 * get the data from the database
		 * 
		 */ 
		 
		 $this->data['tasks'] = $this->specifications_model->recent($site_id, $unique);
		
		/*
		 * Load the view...
		 */ 
		
		$this->view($this->master, $this->prefix , $this->file_ext);	
	}
	
	/*
	 * Simply show the user the last specification in the system
	 * 
	 */ 
	
	function last_sci($site_id, $unique)
	
	{
		
		/*
		 * get the data from the database
		 * 
		 */ 
		 
		$this->data['recentSci'] = $this->specifications_model->recent_sci($site_id, $unique);
		
		
		/*
		 * Load the view...
		 */ 
		
		$this->view($this->master, $this->prefix , $this->file_ext);	
		
	}

	/*
	 * For the customer dropdown -- loads the sites into the  corresponding dropdown list
	 * 
	 * 
	 */

	Public function sites($id)
	
	{
		/*
		 * Get the sites data from the selected table via company id
		 * 
		 */
		
		$this->data['sites'] = $this->specifications_model->get_where('sites', 'company_id', $id, true);
		
		/*
		 * Reload the little module...
		 * 
		 */
		
		$this->load->view('/clientarea/specifications/modules/sites', $this->data);
		
		
	}
	
	/*
	 * Delete site specification function
	 * 
	 */ 
	
	Public function delete($site_id, $area_id=false, $unique=NULL)
	
	{
		
		/*
		 * Have we got posts and an area_id active
		 * 
		 */
		  
		if(!empty($this->posts) && $area_id > 0)
		
		{
			
			/*
			 * Create a tables array
			 */ 
			
			$tables = array('spec' => 'id', 'tasks' => 'spec_id', 'areas' => 'area_id', 'sci' => 'spec_id');
			
			/*
			 * Run the loop to delete the records from the correct tables
			 * 
			 */ 
			
			foreach ($tables as $table => $key)
			
			{
				
				$this->specifications_model->delete($area_id, $key, $table);
				
			}
			
			/*
			 * Return a success message
			 * 
			 */ 
			
			    echo json_encode(array('message' => 'Area Deleted!!!'));
			
		   }
		
		
		else 
		
		{
		
		if((int)$area_id == false)
		
		{
			
			
			if(is_array($this->sesskey) || $unique != NULL)
						
						{
							
						/*
						 * Return the right unique key from previous submission
						 * 
						 * 
						 */ 
						
							$unique = ($unique == NULL ? $this->sesskey[$site_id][0]: $unique);	
							
							$this->data['areas'] = $this->specifications_model->get_where('spec', 'unique', $unique);
							
							$this->load->view($this->data['modules'].'delete_area', $this->data);
    
						}
				
							else 
							
						{
							
						echo 	$this->data['error'] = 'No Areas Available...';
				
				
						}
			
			
			}
		
		}
		
	}


	Public function complete($site_id)
	
	{
		
		$arr = array();
		
		$mykey = $this->sesskey[$site_id][0];
	
		foreach($this->sesskey as $key => $temp)
		
		{
			
			if($key != $site_id)
			
			 {
			
			    $arr[$key] = $temp;
				
			 }
			
		}
		
		$this->sesskey = $arr;
		
		$this->specifications_model->update_row($mykey, 'unique', 'spec', $this->posts);
		
		$this->session->set_userdata('siteCheck', $arr);
		
		$this->data['message'] = "Specification Has Been Added!";
		
		$this->load->view('clientarea/modules/flashmessage', $this->data);
		
	}



	/*
	 * QA Section, this will use some of the specifications functions,
	 * 
	 * easier to combine the logic and alter the route
	 * 
	 * Main QA function
	 */ 
	 
	 
	 Public function qa($site_id=false, $company_id=false, $ajax=false, $unique = false)
	 
	 
	 {
	 	
		
		//Unset any arrays before we start
		
		 $this->session->unset_userdata(array('qafiles' => '', 'score' => ''));
		 
		 //If we have a company id available we can build the structure
		 
		 if($company_id > 0)
		 
		 {
		 	
			//Get that row from db...
		 	
			$this->data['row_data'] = $this->specifications_model->get_company_row(array( $company_id, $site_id));
			
			if( $this->specifications_model->has_spec($site_id) > 0  )
			
			{
				
				/*
			     * Get the last specification created for this site
			     * 
			     */ 
			
			    $this->data['areas'] = $this->specifications_model->last_site_spec($site_id, $unique);
				
				/*
				 * Create an array of values to be exploded
				 * 
				 */ 
			
				$keys = array('areas', 'spec_id');
				
				/*
				 * explode each key by looping the keys and create a multidimensional array
				 * 
				 * 
				 */ 
				
					foreach($keys as $key)
				
						{
				
							$this->data['rows'][] = explode(',',$this->data['areas'][0]->$key);
				
				
						}
						
						
				/*
				 * Check we are not posting
				 * 
				 */ 
			
				
				
			  }
			
			   else 
			
			  {
				
				
			 /*
			  * No specification has been created so we redirect the user to the specifications area
			  * 
			  */
			   	
			    echo 'Please Provide A '.anchor('/clientarea/specifications/','site Specification').' First';
			  
				
			  }
		
			  if(empty($this->posts) && $ajax > 0)
		
		        {
					
				
					    $this->load->view($this->data['modules'].'qa_score_form', $this->data);	
					
					   /*
					    * Stop the function
					    * 
					    */
					   
				       return false;

				}
	 	
		    
		 }
			
				
				/*
				 * We are posting
				 * 
				 */ 
			
			if(!empty($this->posts) )
		
		        {
		        	
					//All the fields that want validation
					$this->fields = array('area[]');
			
					//Correspoding errors
					$this->errors = array('numeric|less_than[5]');
					
					//run the validator
					
					$this->runValidator($this->fields, $this->errors);
					
					
					
					//Are we valid
					
							if ($this->form_validation->run() == FALSE)
				
				  				{
					
									echo json_encode($this->form_validation->error_array());
									
									
					
				 				 }
				  
								else
						
								{
									
									 
									
									/*
									 * Because we are sending files we need to check 
									 * 
									 * if we have created a folder today for it.
									 * 
									 */ 
									
									if(isset($_FILES) && count($_FILES) > 0)
									
									{
										
									    /**
										 * Send file data to the upload function
										 * 
										 * @param array, string
										 * 
										 * function return file data for inserting into the db
										 * 										 
										 */ 
										 
										
										 $dir = $this->uploader->create_path(array(
				
					  								                               $this->data['data']->company_name, 
							 
					   								                               $this->data['row_data']->company_name,
					   								                               
																				   'qa'
																				   
																				   )
													
												                               );
																			   
										
										$uploadData = $this->uploader->dated_dir($_FILES, $dir.'/', $site_id);
										
										/*
										 * Have we got a valid array returned from the upload function
										 */ 
										
										if(is_array($uploadData) && count($uploadData) > 0 )
										
											{
												/*
												 * Explode the areas
												 * 
												 * to create the same array as on screen
												 * 
												 */
												  
												$areas = explode(',', $this->data['areas']->areas);
												
												/*
												 * Loop the upload data and extract the custome key from the array
												 * 
												 * The keys acts as the corresponding array number from the exploded array
												 * 
												 * so we can assign the right area to the image...
												 */ 
												
												foreach($uploadData as $key => $path)
												
												{
													         //Create the first array of the file paths
													
														     $arr1[] = $path;
															 
															 //Create a second array of the areas they belong to 
													
														     $arr2[] = $areas[$key];			 

												}
												
												//Create a third array combining the 2 above arrays to create a multidimensional array
												
												$this->qafiles['qafiles'] = array(
																					'file' => $arr1, 
																					
																					'title' => $arr2
																					
																				);
												
												//Set the data in the session to save later.
												
												$this->session->set_userdata($this->qafiles);
											
											}
											
										else 
										
										{
											
											/*
											 * We have an error from the upload function, we create a json array 
											 * 
											 * and send it back to the view...
											 * 
											 */ 
											
											echo json_encode(
											
													array('error' => $this->load->view('clientarea/modules/flashmessagewarning', 
													
																							array('warning' => $uploadData),
																							
																							true)
																							
																							)
																							
																);
											
											return false;
											
										}
										
									}
									
									/*
									 * unset any previous values created
									 */ 
									 
									
									unset($this->scores);
									
									/*
									 * Count how many areas we have in the post array
									 * 
									 */ 
									
									$count = count($this->posts['ids']);
									
									/*
									 * Loop them and build an array the can easily be inserted into the db
									 * 
									 */ 
									
										for($i=0;$i<$count;$i++)
										
										{
											
											$this->scores['scores'][$this->posts['ids'][$i]] = $this->posts['area'][$i];
											
										}	
										
										$this->session->set_userdata($this->scores);
										
										
										
											
									/**
		 							 * 
		 							 *@param array
		 							 * 
		 							 * Score data for the page
									 * 
		 							 */ 
									 
											
										$this->data['scores'] = $this->scores;
										
										
										
										
									/**
									  * Model function to calculate scores 
									  * 
									  * @param $count = number of areas
									  * 
									  * @param Post array of area scores
									  * 
									  */
									     
									 
									
									 $this->data['score'] = $this->specifications_model->calculate_score($count, $this->posts['area'], 'score');
										
										
									/*
									 * If the site has a previous score, we will get the last score submitted.
									 * 
									 */ 
			
										
										$prev_score = $this->specifications_model->previous_score( $site_id , false, $unique);
										
										/*
										 * Move the array here so we can get the rest of the data
										 * 
										 */ 
										
										$this->data['previous_auth'] = $prev_score;
										
										/*
										 * Send Previous Score to the function to calculate previous score
										 * 
										 * returns calculated data from "calculate_score" function
										 */ 
										
										
										$this->data['previous_score'] = $this->specifications_model->prev_score($prev_score);
										
										
										/*
										 * Have we got a previous score?
										 * 
										 */ 
										
											if(isset($this->data['previous_score']))
											
											{
												
												/*
												 * Submit some returned values from "calculate_score" function
												 * 
												 */
												  
												$lastScore = $this->data['previous_score'][2];
												
												
												$currentScore = $this->data['score'][2];
												
												/*
												 * Run the function to calculate the difference
												 * 
												 */ 
												
												
												$this->data['myScore'] = $this->specifications_model->difference($lastScore, $currentScore);
												
												
												
												
											}
										
										
										/*
										 * We need the site id for confirmation of session array.
										 * 
										 */ 
										
										
										$this->data['site_id'] = $site_id;
										
										
									    $this->data['unique'] = $unique;
										
										
	 									echo json_encode(array('html' => $this->load->view($this->data['modules'].'scores', $this->data, true)));
										
									
								}
					
					
				}
	 	
		
		else 
		
		{	
		
		/*
		 * Main view to show the main specifications page
		 * 
		 * Get the customers for the dropdown
		 * 
		 */
		 
		 
		
			
		$this->get_customers();
		
		/*
		 * Appropriate Header 
		 */ 
		 
		 
		$this->data['header'] = ' Quality Audit Details';
		
		$this->data['skip'] = false;
		
		/*
		 * Load the view...
		 */ 
		 
		
		
		$this->view($this->master, $this->prefix , $this->file_ext);	
		
		
		}
		
	 }



	Public function spec_qa($site_id, $company_id, $unique)
	
	{
		$this->data['site_id'] = $site_id;
		
		$this->data['company_id'] = $company_id;
		
		$this->data['unique'] = $unique;
		
		return $this->qa($site_id, $company_id, false, $unique);
		
	}
	
	
	Public function qa_get_spec($site_id, $company_id, $unique)
	
	{
		
	if(!empty($this->posts))
	
	{
		
		$this->qa($site_id, $company_id, true);
		
		return false;
	}
		
	$this->data['areas'] = $this->specifications_model->last_site_spec($site_id, $unique);
		
	 $keys = array('areas', 'spec_id');
				
				/*
				 * explode each key by looping the keys and create a multidimensional array
				 * 
				 * 
				 */ 
				
					foreach($keys as $key)
				
						{
				
							$this->data['rows'][] = explode(',',$this->data['areas'][0]->$key);
				
				
						}
						
	
	  
	  
	  $this->load->view($this->data['modules'].'qa_score_form', $this->data);	
	  
	  }
	
	Public function qa_history($site_id)
	
	{
		
		$this->load->library('table');
		
		$this->data['history'] = $this->specifications_model->previous_score( $site_id , 50, false);
		
		
		$this->data['tabheaders'] = array();
		
		
		foreach($this->data['history']  as $header)
		
		{
			
			$rowHeaders[] = $header['spec_name'];
		}
		
		$this->data['tabheaders'] = array_unique($rowHeaders);
		
		$this->view($this->master, $this->prefix , $this->file_ext);
		
	}



	/*
	 * To submit the Quality audit from session to database
	 * 
	 * 
	 */ 

	Public function qa_confirm($site_id, $unique=false)
	
	{
		
		/*
		 * Are we posting?
		 */ 
		
		if(is_array($this->posts))
		
		{
			
			/*
			 * Get todays date
			 */ 
			
			$this->date_id = $this->specifications_model->insert_return(array('date' => $this->time), 'date');
			
			/*
			 * Build array for the qa table and insert the data
			 */ 
			
			
			$qa = array('master_id' => $this->data['data']->master_id, 
			
						'date_id' => $this->date_id, 
						
						'user_id' => $this->data['data']->user_id, 
						
						'site_id' => $site_id,
						
						'unique'  => $unique,
						
						'score'   => array_sum($this->scores),
						
						'overall' => count($this->scores));
						
			$qa_id = $this->specifications_model->insert_return($qa, 'qa');
			
			/*
			 * Initiate Scores Array
			 * 
			 */ 
			
			
			$scores = array();
			
			/*
			 * Build the correct formated array to insert the bulk data
			 * 
			 */ 
			
			foreach ($this->scores as $id => $score)
			
			{
				
				$scores['area_id'][] = $id;
				
				$scores['score'][]   = $score;
				
				$scores['qa_id'][] = $qa_id;
				
			}
			
			/*
			 * Insert Batch data
			 * 
			 */
			  
			$this->specifications_model->batch_insert($scores, 'areas');
			
			
			/*
			 * Have we got files with the qa, if so lets add the paths
			 * 
			 * lets check for an array first.
			 * 
			 */ 
			
			  if(is_array($this->qafiles) && count($this->qafiles) > 0 )
			  
			  {
			  	
				/*
				 * Insert the file paths into db, it can be more than one so we need to 
				 * 
				 * use a batch insert method...
				 * 
				 */ 
			  	
				$file_ids = $this->specifications_model->my_array($this->qafiles, 
		    										
		    									  				  'files', 
		    										
		    									   				   NULL, 
		    										
		    									   				   NULL
												   
												   					);
				//Start an array...
				
				$qafiles = array();
				
				//Loop the returned ids from the file table and build another array for the joining table.
																	
					foreach($file_ids as $id)
				
						{
					
							$qafiles['qa_id'][] = $qa_id;
					
							$qafiles['file_id'][] = $id;
				
						}
				
					//Insert another batch array...
				
				    $this->specifications_model->batch_insert($qafiles, 'qafiles');
				
			    } //endif;
			  
			
			
			/*
			 * Show success responce
			 */ 
			
			$this->data['message'] = "Quality Audit Has Been Saved!";
			
			/*
			 * Return the flash message
			 */ 
			
			$this->load->view('clientarea/modules/flashmessage', $this->data);
		}
		
		
	}
	 
	 /*
	  * Private function  to get the customers
	  * 
	  */
	  
	   
	 Private function get_customers()
	 
	 {
	 	
	 	return $this->data['customers'] = $this->specifications_model->get_customers($this->data['data']->master_id);
		
	 }
	
	
	//To get all the specs available in the current session
	
	Private function hasKey()
	
	{
		
		 if($this->sesskey)
		
		{
			
			$unique = array();
			
			/*
			 * We need to extract site id from key and the unique ref,
			 * 
			 * then re-create the array to query the db correctly
			 * 
			 */
			
			foreach($this->sesskey as $u => $d)
			
			{
				
				//Build the correct array
				
				$unique[$u] = $d[0];
				
			}
			
			//Send that data to the view...
			
			$this->data['recent'] = $this->specifications_model->get_recent($unique);
	
			
		}
		
	}

}