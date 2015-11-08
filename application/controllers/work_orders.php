<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
/*
 * Cleansure Work Orders controller
 * 
 * Work Orders controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Work Orders
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Work_orders extends Clientarea_Controller {
	
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
	 * Create a private var type to switch views.
	 */ 
	 
	Private $type;
	
	//Class constructor
	Public function __construct()
	
	{
		
        parent::__construct();	
	
		//Load the config file for this class
		$this->config->load('register');
		
		//Load the table class
		$this->load->library('table');
		
		//Needed Models..
		$this->load->model(array('worders_model', 'specifications_model', 'customer_model', 'staff_model'));
		
		//the current file ext for main view..
		$this->file_ext = '_'.$this->uri->segment(3);
		
		//push onto addtional js
		$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker', 'bootstrap-timepicker.min', 'main', 'live', 'work_orders');
		
		//js needed
		$this->data['js'] = javaScript($this->js); 
		
		//View var
		$this->data['modules'] = 'clientarea/work_orders/modules/';
		
		//Create a public var
		$this->modules = $this->data['modules'];
		
		//Explode the 3rd part of the url to find out where we are.
		$uri = explode('_',$this->uri->segment(3));
		
		//So we don't wipe out the session var
		if($uri[0] != 'deleted')
		{
			//Set the location we are via the url patterns
			if(in_array('purchase',$uri) )
				{
				//Purchase orders is 1
				$this->session->set_userdata('location', 1);
				//No 3rd uri segment so 2
				} elseif($uri[0] == ''){
				//Set to 2
				$this->session->set_userdata('location', 2);
				//Set the table
			}
			
		}
		//Move the session var into private object
		$this->type = $this->session->userdata('location');
		
		//Get the deleted itemsß
		$this->data['deleted'] = $this->worders_model->count_tasks(($this->type == 1 ? 'purchase_orders':'wk_orders'), array('deleted' => true));
		
		
	}
	
	Public function index($segment=false,$function=false, $deleted=false)
	
	{
		
		//Load the config file for this class
		$this->config->load('register');
		
		$this->data['customer_count'] = $this->customer_model->count_customers();
		
		$this->data['staff_count'] = $this->staff_model->count_staff();
		
		$this->get_customers();
		
		//Run a switch on what query we need 
		if($function == false)
		{
			$wo = array('wk_orders.master_id' => $this->data['data']->master_id, 'wk_orders.deleted' => $deleted);
			
			if(is_array($segment))
			
			{
				
				$wo = array_merge($wo,$segment);
			}
			  //Work oreders query here
			$this->data['wk_orders'] = $this->worders_model->work_orders($wo);
			//For Deleted it will let us know where we came from, 1 = work_orders
		}
		else 
		
		{
			
			$p = array('purchase_orders.master_id' => $this->data['data']->master_id, 'purchase_orders.deleted' => $deleted);
			
			if(is_array($segment))
			
			{
				
				$p = array_merge($p,$segment);
			}
			
			//Purchase Order Query here..
			$this->data['purchase_orders'] = $this->worders_model->pur_orders($p);
			//For Deleted it will let us know where we came from, 2 = purchase_orders
			//Get the suppliers
		    $this->data['suppliers'] = $this->worders_model->get_suppliers(array('users.master_id' => $this->data['data']->master_id,'users.type'=> $this->config->item('suppliers')));
		}

		if($deleted == true)
		{   //To change the message on the view..
			$this->data['delete'] = true;
			//Deleted View
			$this->view($this->master, $this->prefix, $this->file_ext);	
		} else {
			//To change the message on the view..
			$this->data['delete'] = false;
			//We using main view
			$this->view($this->master, $this->prefix);
		}
		
		
	}
 
    /*
	 * Function  to serach work orders
	 */ 
	Public function search_work_orders()
	{
		if($this->posts)
		{
			$this->search(false, 'wk_orders');
		}
		
	}

    //function to search the purchase orders..
	Public function search_purchase_orders()
	{
		//Are we posting?
		if($this->posts)
		{
			$this->search(true, 'purchase_orders');
			
		}
	}
	
	Private function search($index=false, $table)
	{
		//Filter the name entities of the post vars
			$this->filter_vars();
			
			//Remove empty post vars in the array
			$search_data = array_filter($this->posts);
			
			//If we hav'nt just sent a blank form
			if(is_array($search_data) && count($search_data) > 0)
			{
				//Change some array keys by running it through the function..
				$data = $this->create_search_array($search_data, $table);
				//Load the indexs
				$this->index($data,$index,false);
				//Stop the function
				return false;
				
			}
			else 
			{   //Show the error message for the empty form
				$this->session->set_flashdata('info','&nbsp;&nbsp;Please Select at least 1 Search Criteria');
			}
			//Show the index with no data..
			$this->index(false,$index,false);
	}
	
	
	
	/*
	 * We use this function to delete work orders and purchase orders
	 */ 
	
		Public function delete($id, $type, $permenent=false)
	    {
		//$this->data['delete'] = true;
		
		switch($type)
		{
			case 1:
				$table = 'work_orders';
			break;
			case 2:
				$table = 'purchase_orders';
			break;
		}
		
		$url = '/clientarea/work_orders/'.($type == 2 ? 'purchase_orders':NULL);
		
		
		
		if($permenent == false)
		
		{
			
			$this->worders_model->delete_row($id, $table);
			
			$this->session->set_flashdata('info','&nbsp;&nbsp;Your order has been deleted, it will be available in the deleted items.');
			
			header('Location: '.$url);
			
		}
		
		
	}
	
	//Function to show the deleted items
	Public function deleted()
	{   //Load the table class
		$this->load->library('table');
		
		$this->data['deleted'] = $this->worders_model->count_tasks(($this->session->userdata('location') == 1 ? 'purchase_orders':'wk_orders'), array('deleted' => true));
		//Run the main index func..
		$this->index(false,true,true);
	}
	
	//Show all the purchas orders
	Public function purchase_orders()
	
	{
		//Load the library class
		$this->load->library('table');
		//Use the main index function
		$this->index(false, true);
	}
	
	//Create a purchase order
	Public function create_purchase_order()
	{
		if($this->posts)
		{
			
			$this->posts['master_id'] = $this->data['data']->master_id;
			
			$this->posts['date'] = $this->time;
			
			$this->posts['purchase_ref'] = uniqid();
			
			$this->worders_model->insert($this->posts, 'purchase_orders');
			
			echo json_encode(array('message' => $this->lang->line('purchase_order_complete')));
			
			return false;
			
		}
		//Get the customers	
		$this->get_customers();
		//Load the view..
		$this->view($this->master, $this->prefix, $this->file_ext);
	}
	
	//Get the form to populate the orders in the purchase order section
	Public function get_order_form($comp_id,$site_id)
	{
		//Get the orders based upon customer id and site id
		$this->data['orders'] = $this->worders_model->get_orders(array('company_id' => $comp_id, 'site_id' => $site_id));
		//Get the suppliers
		$this->data['suppliers'] = $this->worders_model->get_suppliers(array('users.master_id' => $this->data['data']->master_id,'users.type'=> $this->config->item('suppliers')));
		//Send the ids to the view..
		$this->data['ids'] = array($comp_id,$site_id);
		//Load the view 
		$this->load->view($this->modules.'order_form', $this->data);
	}
	
	//View any notes for the purchase order
	Public function view_notes($purchase_id)
	{
		//Get the notes
		$this->data['note'] = $this->worders_model->get_row('purchase_orders','id',$purchase_id)->notes;
		//return the view..
		$this->load->view($this->modules.'purchase_notes', $this->data);
	}
	
	Public function task($wo_id)
	{
		//Get the tasks
		$this->data['customer_data'] = $this->worders_model->task($wo_id);
		//Load the view
		$this->view($this->master, $this->prefix, $this->file_ext);		
	}

	Public function create()
	
	{
		
		if(!empty($this->posts))
		
		{
			
			
			/*
			 * Loop through the posts and rebuild array to format dates
			 * 
			 * ready to be inserted into the database...
			 * 
			 */ 
			 
			 if(empty($this->posts['date'][0]))
			 
			 	{
			 	
					$this->posts['date'][0] = $this->time;
				
				 }
				
			 elseif(empty($this->posts['date'][1]))
			 
			 {
			 	
				$this->posts['date'][1] = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day"));
			 }
			 
			  if(!empty($this->posts['date'][1]))
			 
			 		{
					
						foreach($this->posts['date'] as $p)
					 
							{
					 	
								$dates['date'][] = insert_date($p);
						
					 				
							}
							
					 $aKeys = array('com_id', 'fin_id', 'date_id');
			
					 }


			         else 
			  
			        {
				  	
					
						$dates['date'][0] = $this->posts['date'][0] = $this->time;
			 			
						 $aKeys = array('com_id', 'date_id');
			 
			         }
			
				
					$key = count($dates['date']);
					
			
					$dates['date'][$key] =  $this->time;
		
					 				
					/*
			 		 * Unset the post array so don't duplicate bad data
			         * 
			         */
									  
						
					unset($this->posts['date']);
			
			
					$keys = $this->worders_model->my_array($dates, 
		    										
		    									 	 		'date', 
		    										
		    									  			 NULL,
												   
												  			 NULL);
		    										
		    		
		  
		  	$wk_orders = array_merge(array_slice($this->posts,0,4), array_slice($this->posts,11, 6));
			
			
			$wk_orders['days_id']  = $this->worders_model->insert_return(array_slice($this->posts, 4,7), 'days');
			
						
			$wk_orders['order_num'] = uniqid();
			
			
			$wk_orders['master_id'] = $this->data['data']->master_id;
			
			
			
			for($i=0;$i<count($aKeys);$i++)
			
			{
				
				$wk_orders[$aKeys[$i]] = $keys[$i];
				
			}
				
		
			$wk_ord_id = $this->worders_model->insert_return($wk_orders, 'wk_orders');
			
			
			
			$this->worders_model->my_array(array_slice($this->posts,-3), 
		    										
		    									 	 		'wk_orders_staff', 
		    										
		    									  			 NULL,
												   
												  			 $this->makeKey($wk_ord_id, $this->posts['staff_id']));
			
			
			echo json_encode(array('message' => 'Work Order Completed!'));
			
			return false;
		}
		
		$this->get_customers();
		
		$this->get_staff();
		
		$this->data['header'] = ucwords(str_replace('_', ' ',$this->uri->segment(2)));
		
		$this->view($this->master, $this->prefix, $this->file_ext);
		
	}


	Public function updateDate($id)
	
	{
		if(!empty($this->posts))
		
		{
			
			$this->worders_model->update_row($id, 'id', 'date',   array('date' => insert_date($this->posts['date'][0])));
			
			echo json_encode(array('message' => 'Date Updated'));
			
			return false;
			
		}
		
		$this->data['row_data'] = $this->worders_model->get_row('date', 'id', $id);
		
		$this->load->view('modules/datepicker', $this->data);
		
	}
	
	
	function staff($wo_orders)
	
	{
		
		if(!empty($this->posts))
		
		{
			
		
		$this->worders_model->delete($wo_orders, 'wk_order_id', 'wk_orders_staff');
			
			
		$this->worders_model->my_array(array_slice($this->posts,-3), 
		    										
		    									 	 		'wk_orders_staff', 
		    										
		    									  			 NULL,
												   
												  			 $this->makeKey($wo_orders, $this->posts['staff_id']));
			
			echo json_encode(array('message' => 'Staff Updated'));
			
			return false;
			
		}
		
		
		$this->get_staff();
		
		$this->data['staffTimes'] = $this->worders_model->staffTimes($wo_orders);
		
		$this->load->view($this->data['modules'].'staff_update', $this->data);
		
	}
	
	Public function notes($id)
	
	{
		
		if(!empty($this->posts))
		
		{
			
			$this->worders_model->update_row($id, 'id', 'wk_orders', $this->posts);
			
			echo json_encode(array('message' => 'Notes Have Been Updated'));
			
			return false;
			
		}
		
		$this->data['row_data'] = $this->worders_model->get_row('wk_orders', 'id', $id);
		
		$this->load->view($this->data['modules'].'desc', $this->data);
		
	}
	
	Public function costs($id)
	
	{
		
		$this->days('wk_orders', $id);
		
	}
	
	Public function days($table, $id)
	
	{
		
		if(!empty($this->posts))
		
		{
			
			$this->worders_model->update_row($id, 'id', $table, $this->posts);
			
			echo json_encode(array('message' => ucwords($table).' Have Been Updated'));
			
			return false;
			
		}
		
		$this->data['row_data'] = $this->worders_model->get_row($table, 'id', $id);
		
		$this->load->view($this->data['modules'].$table, $this->data);
		
	}
	
	
	Public function sci_check($site_id)
	
	{
		
	  $count = $this->specifications_model->count_spec($site_id);
	  
	  if($count > 0)
	  
	  {
	  	
		$this->data['info'] = 'This site has had an Specification Created!';
		
		
		$this->load->view('clientarea/modules/flashmessageinfo', $this->data);
		
	  }
	  
	  else 
	  
	  {
	  	
		$this->data['warning'] = "This site has had NO an Specification Created!";
		
	  	
		$this->load->view('clientarea/modules/flashmessagewarning', $this->data);
					
		  
	  }
		
	}
	
	
	Public function job_times()
	
	{
		
		if(!empty($this->posts))
		
		{
			
			$this->get_staff();
			
			
			$data = arraySort($this->data['staff'], 'staff_id');
			
			
			$this->data['selectedStaff'] = array();
			
			
			foreach($this->posts['staff_ids'] as $staff_id)
			
			
			{
				
				
				$this->data['selectedStaff'][] = $data[$staff_id];
				
			}
			
			
			$this->load->view($this->data['modules'].'selectedStaff', $this->data);
			
			
			
		}
		
		return false;
	}
	
	
	
	 /*
	  * Private function  to get the customers
	  * 
	  */
	  
	  Private function makeKey($wk_ord_id, $staff)
	  
	  {
		
		$wkKey = array();
		
		for($i=0;$i<count($staff);$i++)
			
			{
				
				$wkKey['wk_order_id'] = $wk_ord_id;
				
			}
			
			return $wkKey;
			
		
	  }
	  
	   
	 Private function get_customers()
	 
	 {
	 	
	 	return $this->data['customers'] = $this->specifications_model->get_customers($this->data['data']->master_id);
		
	 }
	 
	 Private function get_staff()
	 
	 {
	 	
		return $this->data['staff'] = $this->worders_model->get_staff(array('staff.master_id' => $this->data['data']->master_id));
		
	 }
	 
	 /*
	 * We need filter out some none NULL posts vars
	 */ 
	Private function filter_vars()
	{
		
		//We need to filter the dropdowns   
		$filter = array('customers', 'supplier_id', 'sites');
		//Find the dropdowns and remove them if they have not been selected
			foreach($filter as $key)
			{   //Check for filter
				if(isset($this->posts[$key]) &&  $this->posts[$key] == 'Select One...')
				{   //Unset the var
					unset($this->posts[$key]);
				}
				
			}
			
			return true;
	}
	
	//Switch post vars keys to match db
	Private function create_search_array($array, $table){
		
		//Loop the array we need to change
		foreach($array as $key => $val) {
			
			//run a swotch..
			switch($key) {
				
			case 'customers':
				
				if($table == 'wk_orders')
				{
					$array[$table.'.comp_id'] = $val;
					
				} else {
					
					$array[$table.'.company_id'] = $val;
				}
				
				unset($array['customers']);
				
			break;
			
			case 'date_from':
				
				$array['date >'] = $val;
				
				unset($array['date_from']);
				
			break;
			
			case 'date_to':
				
				$array['date <'] = $val;
				
				unset($array['date_to']);
				
			break;
			
			case 'sites':
				
				$array[$table.'.site_id'] = $val;
				
				unset($array['sites']);
				
			break;
			
		  }
	
		}
		return $array;
	}
	

}