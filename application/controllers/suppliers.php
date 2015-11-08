<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
/*
 * Cleansure Suppliers controller
 * 
 * Suppliers controller is not to be edited or used by unauthorised personel and Gofish Web Design
 * 
 * hold full copyright to the code and maintanance of the cleansure system.
 * 
 *  @category   ClientArea
 *  @package    Suppliers
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Suppliers extends Clientarea_Controller {
	
	
	//Class constructor
	public function __construct(){
		
        parent::__construct();	
		
		$js=array_push($this->js, 'bootstrap-datepicker', 'bootstrap-select.min', 'main', 'live');
		
		$this->data['js'] = javaScript($this->js); 
		
		//Load the config file for this class
		$this->config->load('register');
		
		$this->config->load('products');
		
		$this->data['types'] = array('Product', 'Consumable', 'Product/Consumable');
		//Load the model file
		$this->load->model('supplier_model');
		
		//Modules folder
		$this->data['modules']  = "clientarea/suppliers/modules/";
		
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
		
		$this->data['suppliers'] = $this->supplier_model->suppliers(array(
		
																		  'users.master_id' => $this->data['data']->master_id,
												
																		  'users.type'      => $this->config->item('suppliers') 
		
																			));	
																			
		//print_r($this->data['suppliers']);															
			
		$this->view($this->master, $this->prefix);	
		
	}


	Public function view_products($c_id)
	
	{
		
		$this->data['products'] = $this->supplier_model->get_where('products', 'company_id', $c_id);
		
		$this->load->view($this->data['modules'].'products_view', $this->data);
		
	}
	
	
	Public function view_links($c_id)
	
	{
		
		$this->data['slugs'] = $this->supplier_model->get_where('urls', 'company_id', $c_id);
		
		$this->load->view($this->data['modules'].'slugs_view', $this->data);
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
						
								array('company', 1, 4),
							
								array('contact', 8, 5),
							
								array('address', 13, 6) 
						
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
							
							$userArray[$keys[$i]] = $this->supplier_model->insert_return(array_slice($this->posts, $vars[$i][1], $vars[$i][2]), $vars[$i][0]);
							
						}
						
							/*
							 * Add additional attributes to the array
							 * 
							 */
							 
							$userArray['date_id'] = $this->supplier_model->insert_return(array('date' => insert_date($this->posts['date'][0])), 'date');
							
						
							$userArray['type'] = (int)$this->config->item('suppliers');
							
							
							$userArray['master_id'] = $this->data['data']->master_id;
							
							
							$this->supplier_model->insert(array_merge($userArray, array_slice($this->posts,5,3)), 'users');
							
							//Return json success message
							echo json_encode(array('message' => 'Successfully inserted Supplier'));
			
							return false;
							
						
						
					}
			
		}
		
		else 
		
		{
			
			$this->form();
			
			$this->view($this->master, $this->prefix, $this->file_ext);
			
		}
		
		
	}


	/*
	 * #########################Profile Section##########//
	 * 
	 * We hijack the customer controller and route the user and 
	 * 
	 * apply a switch based upon what parameter is send by the 
	 * 
	 * url. most corresponding files will be in the customers modules...
	 * 
	 */ 
	 
	 
	 /**
	  * 
	  * @param id(int) = either company id or slug_id
	  * 
	  * @param bool(int) = Decides whether its a edit(true) or insert(false)
	  * 
	  */ 
	 
	 function slugs($id, $bool)
	 
	 {
	 	
		if($bool == true)
		
		{
			
			$this->data['slug'] = $this->supplier_model->get_row('urls', 'id', $id);
			
		}
		
		if(!empty($this->posts))
		
		 {
		 	
			 //Fields to be validated
			  $this->fields = array('name', 'slug');
			
			  //Corresponding errors 	
			  $this->errors = array('required', 'required');
			  
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
						
						if($bool == true)
		
							{
								
								$this->supplier_model->update_row($id, 'id', 'urls', $this->posts);
								
								//Return json success message
							    echo json_encode(array('message' => 'Successfully Updated URL'));
			
							    return false;
								
							}
							
						    else
								
							{
								
								$this->supplier_model->insert(array_merge(array('company_id' => $id), $this->posts), 'urls');
								
								//Return json success message
							    echo json_encode(array('message' => 'Successfully Inserted URL'));
			
							    return false;
									
							}
						
						
					}
			
		 }
		
		
		$this->load->view($this->data['modules'].'slugs', $this->data);
		
	 }

   Public function slug($action, $id=false)
   
   {
   	
		if($action == false)
		
		{
			
			$this->supplier_model->delete($id, 'id', 'urls');
			
			//Return json success message
			echo json_encode(array('message' => 'Successfully Deleted URL'));
			
			return false;
			
		}
   	
	
   } 
   
   
   Public function products($company_id, $product_id=NULL, $measurement_id=false, $date_id=false)
   
   {
   	
	if($product_id != NULL)
	
	{
		
		$this->data['row_data'] = $this->supplier_model->get_product($product_id);
		
	}
   	
	if(!empty($this->posts))
	
	{
		
		 //Fields to be validated
		$this->fields = array('name', 'type', 'cost', 'price');
		
		 //Corresponding errors 	
	     $this->errors = array('required', 'required', 'required|decimal', 'required|decimal');
			  
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
						
						if($measurement_id != false && $date_id !=false)
						
						{
							
							
							
							$keys = array(
							
											array('products', $product_id, 0,7),
											
											array('measurments', $measurement_id, 8,4)
							
										);
										
							for($i=0;$i<2;$i++)
							
							{
								
								$this->supplier_model->update_row($keys[$i][1], 'id', $keys[$i][0], array_slice($this->posts, $keys[$i][2], $keys[$i][3]));
							}
							
								$this->supplier_model->update_row($date_id, 'id', 'date',  array('date' => insert_date($this->posts['date'][0])));
						
						        //Return json success message
			                     echo json_encode(array('message' => 'Successfully Updated Product'));
								 
								 return false;
							
						}
						
						else 
						
						{
							
						
						$measurement_id = $this->supplier_model->insert_return( array_slice($this->posts, 8,4), 'measurments');
						
						$date_id = $this->supplier_model->insert_return( array('date' => insert_date($this->posts['date'][0])), 'date');
						
						$vars = array_merge(
						
											array('measurement_id' => $measurement_id, 'date_id' => $date_id, 'company_id' => $company_id, 'master_id' => $this->data['data']->master_id),
											
										    array_slice($this->posts, 0, 7)
										  
										  );
						
						$this->supplier_model->insert($vars, 'products');
						
						//Return json success message
			            echo json_encode(array('message' => 'Successfully Added Product'));
						
						return false;
						
						}
						
					}
			
		
		
	}

	if($product_id != NULl && $measurement_id == false)
	
	{
		
		  $this->load->view($this->data['modules'].'product_overview', $this->data);
	}
   	
	else 
	
	{
		
		$this->data['type'] = array('1' => 'Product', '2' => 'consumable', '3' => 'Both');
   	
	    $this->load->view($this->data['modules'].'products', $this->data);
		
	}
	
   	
	
   }


 	
	Private function form($fields=NULL)
	
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