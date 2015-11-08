
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',0);
ini_set('display_errors',0);
error_reporting(0);
/**
 * Cleansure Stores controller
 * 
 * Stores controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   ClientArea
 *  @package    Stores
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2015 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */
 
 

class Stores extends Clientarea_Controller {
	
	/*
	 * Declare the tempory table we use to track the cart, this will help 
	 * 
	 * with keeping track of the stock control..
	 * 
	 */ 
	
	Private $temp_table = 'orders_temp';
	
	
	Private $modules = 'clientarea/stores/modules/';
	
	
	//Class constructor
	Public function __construct(){
		
        parent::__construct();	
		
		if($this->uri->segment(3) == '')
		
		{
			$js=array_push($this->js,'bootstrap-select.min','bootstrap-datepicker',  'main', 'live','jquery.matchHeight-min','stores');
			
		}
		else 
		
		{
			
			$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker', 'jquery.matchHeight-min', 'main', 'live', 'stores');
			
		}
		
		
		
		$this->data['js'] = javaScript($this->js); 
		
		
		$this->load->model(array('stores_model', 'specifications_model'));
		
		//Load the csv helper file..
		$this->load->helper('csv');
		
		$this->load->library('table');
		
		
		$this->data['deleted'] = $this->stores_model->count_tasks('orders', array('deleted' => true));
		
		//Load the cart class for checking in and out the products..
		$this->load->library('cart');
		
	}
	
	/*
	 * Index page for Stores
	 * 
	 */
	
	public function index($vars='', $csv=false)
	
	{
		
		//Get customers for dropdown
		
		$this->data['customers'] = $this->get_customers();
		
				
		 //Get the orders
		
		  $this->data['orders'] = $this->stores_model->get_orders(
		  
		  															$this->data['data']->master_id, 
		  															
		  															false, 
		  															
		  															(!is_array($vars) ? $vars:false), 
		  															
		  															($vars != '' && $vars > 1 ? $vars:NULL),
																	
																	$csv);
																	
		if($csv == true)
		
		{
			
			echo query_to_csv($this->data['orders'], TRUE, uniqid().'.csv');
			
			return false;
		}
																													
		//Lets create a list of parent_ids so we can identify which orders have been edited
		
		$parent_ids = array();
				
		foreach( $this->data['orders'] as $key => $order)
		
		{
			
			
			if($order['parent_id'] > 0)
			
			{
				
				$parent_ids[] = $order['parent_id'];
				
			}
			
			
			
		}
		
		$this->data['parent_ids'] = $parent_ids;
		
		//Load the view
		
		$this->view($this->master, $this->prefix);	
		
	}


	Public function view_saved_orders()	
	{		
		$this->load->helper('directory');
		//Get our account main directory
		$customer_dir = remove_punctuation($this->data['data']->company_name);
		//Path to saved files.
		$path = './uploads/'.$customer_dir.'/orders/files/';
		//Get the map of files...
		$map = directory_map($path);
		
		$files = array();
		
		foreach($map as $file)
		
		{
			$f=  new SplFileInfo($file);
			
			if($f->getExtension() != 'html')
			
			{
				
				$files[$f->getBasename('.txt')] = unserialize (file_get_contents($path.$file));
			}
			
		}
		
		
		
			$this->data['files'] = $files;
			
			$this->load->view($this->modules.'saved_orders', $this->data);
	}
	
	/*
	 * Orders search resulsts
	 */ 
	
	Public function search()
	
	{
		$csv =false;
		
		if(isset($this->posts['csv']))
		
		{
			$csv=true;
			
			unset($this->posts['csv']);
		}
		
		//Remove empty vars
		$search_data = array_filter($this->posts);
		
		//Run the post data through the filter function
		
		$post_vars = $this->post_filter($search_data);
		
		//if we still have an array load the index function
		
		if(count($post_vars) > 0)
		
		{
			
			$this->index($post_vars, $csv);
			
		}
		
		else 
		
		{
			//Show a message to the user
			$this->session->set_flashdata('info','&nbsp;&nbsp;<strong>Warning!</strong> Your must select at least 1 filter.');
			
			
			//Redirect them to stores
			
			header('Location: /clientarea/stores/');
			
			
		}
		
	}
	
	Public function delete($order_id, $permenent=false)
	
	{
		
		$this->data['delete'] = true;
		
		if($permenent == false)
		
		{
			
			$this->stores_model->delete_row($order_id, 'orders');
			
			$this->session->set_flashdata('info','&nbsp;&nbsp;Your order has been deleted, it will be available in the deleted items.');
			
			header('Location: /clientarea/stores/');
			
		}
		
		else 
		
		{
			
			$tables = array('orders' => 'id', 'order_history' => 'order_id', 'order_items'=> 'order_id');
			
			foreach ($tables as $table => $where)
			
			{
				
				$this->stores_model->delete($order_id, $where, $table);
				
			}
			
			$this->session->set_flashdata('info','&nbsp;&nbsp;Your order has been permenently deleted!');
			
			header('Location: /clientarea/stores/deleted');
			
		}
		
	}
	
	Public function confirm_delete_order($order_id, $confirm=false)
	{
		
		$this->data['order_id'] = $order_id;
		
		$this->load->view('clientarea/stores/modules/confirm_order_delete', $this->data);
		
	}


	Public function deleted()
	
	{
		
		$this->data['orders'] = $this->stores_model->get_orders($this->data['data']->master_id, false, true);
		
		$this->data['delete'] = true;
		
		$this->index(true);
		
	}
	
	/*
	 * Function to undelete record from soft delete
	 */ 


	Public function reinstate($order_id)
	
	{
		
		$this->stores_model->update_row($order_id,'id' , 'orders', array('deleted' => (int)false));
		
		$this->session->set_flashdata('info','&nbsp;&nbsp;Your order has been reinstated back into the system');
		
		header('Location: /clientarea/stores/');
		
		
	}
	
	/*
	 * Function to add restock data
	 * 
	 */ 


	Public function re_stock($order_id, $update=false)
	
	{
		
		//Are we posting?
		
		if(!empty($this->posts))
		
		{
			//Are we updating ?
			if($update == false)
			
			{
			  //Nope insert the record
			  $this->insert_restock($order_id);
			  
			}
			
			else 
			
			{
				//Yep run the update function
				$this->update_restock($order_id);
			}
			
			/*
		     * Return message
		     */ 
		
		    echo json_encode(array('message' => 'Re-stock Updated'));
			
			return false;
			
		}
		
		//If we are trying to update we need to get the data
		if($update == true)
		
		{
			//Get the data 
			$this->data['row_data'] = $this->stores_model->get_restock($order_id);
			
			
		}
		
		//Load the view
		$this->load->view($this->modules.'restock', $this->data);
	}


	Private function insert_restock($order_id)
	
	{
		    //Get the date
		    $restock = date("Y-m-d", strtotime($this->posts['date'][0]));
			//Remove date from array
			unset($this->posts['date']);
			//Get the week Id from the insert
			$week_id = $this->stores_model->insert_return(array_slice($this->posts,0,7), 'days');
			//Get the month id from the insert
			$month_id = $this->stores_model->insert_return(array_slice($this->posts,13,12), 'months');
			//Create the whole array for the restock table
			$order_ar = array_merge(
									 array('date' => $restock, 
									
									        'days_id' => $week_id, 
									
									        'month_id' => $month_id, 
									
									        'order_id' => $order_id),
									
									 array_slice($this->posts,7,6));
			//Insert in onto the restock table
		    $this->stores_model->insert( $order_ar , 'order_restock');
			
	
	}
	
	/*
	 * Update function for restock
	 * 
	 */ 
	
	Private function update_restock($order_id)
	
	{
		
		//Get the date
		$restock = date("Y-m-d", strtotime($this->posts['date'][0]));
	    //Remove date from array
	    unset($this->posts['date']);
		//Get the keys from the post array
		$keys = array_slice($this->posts,0,2);
		//Loop them to trim them down
		foreach($keys as $key => $val)
		
		{
			//Create new array
			$newKeys[] = $val;
			//Unset the post vars
			unset($this->posts[$key]);
			
		}
		
		//Update the days table
		$this->stores_model->update_row($newKeys[0], 'id','days', array_slice($this->posts,0,7));
		//Update the months table
		$this->stores_model->update_row($newKeys[1], 'id','months', array_slice($this->posts,13,12));
		//Update the order_restock table
		$this->stores_model->update_row($order_id, 'order_id','order_restock', array_merge(array('date' => $restock),array_slice($this->posts,7,6)));
		
	}
	
	/*
	 * Quick functions from the home page
	 * 
	 */ 
	
	Public function view_order($order_id, $quickView=false, $editable=false)
	
	{
		
		//Model View
		if($quickView == true)
		
		{
			//Is the order ediatble?
			$this->data['editable'] = $editable;
			//Get the order
			$this->data['orders'] =	$this->stores_model->get_order_products($order_id);
			//Load the view..
			$this->load->view('clientarea/stores/modules/quick_view_order', $this->data);
			//Return as false
			return false;
			
		}
		
		else 
		
		{
			
			
			//Put the order_id into a session var			
			$this->session->set_userdata('order', $order_id);
			
			//Run the ammend order functin						
			$this->amend_order($order_id);
			
			//Show the view...
			$this->stock(NULL, '_stock', $order_id);
			
		
			
		}
		
	}

 /*
  * This function is called at the end if the user navigates away from the page, it will put the
  * 
  * the stock back into the system if it was not successful.
  */ 
	
	
	Public function temp_stock()
	
	{
		
		//Get the data from the temp table
		
		$temp_stock = $this->stores_model->get_where($this->temp_table, 'session_id', $this->data['data']->session_id, false);
		
		//print_r($temp_stock); break;
		
		//Check we got an array
		
		if(is_array($temp_stock) && count($temp_stock) > 0)
		
		{
			
		//Loop the data and put the stock back into the system
		
		foreach($temp_stock as $item)
		
		{
			
			
			
			$this->stores_model->update_qty($item['product_id'], $item['qty'], ($item['subtract'] == 1 ? '-':'+'));
		
			
		 }
		
		  //Clear the temp table for this session id...
		    
	      $this->stores_model->delete($this->data['data']->session_id, 'session_id', $this->temp_table);
		  
		  }
		
		
		return true;
		
	}
	
	
	
	/** 
	 * Show the stock i.e stores
	 * 
	 * @param sort_by = array (query filters)
	 * 
	 * @param file_ext = str - to overide the view change
	 */
	 
	Public Function Stock($sort_by=NULL, $file_ext=NULL, $order_id=false)
	
	{
		
		if($sort_by > 0)
		
		{
			
			 $this->session->set_userdata('paging', true);
			
		}
		
			 $paging = $this->session->userdata('paging');
		
		/*
		 * Are we looking ar an order
		 * 
		 * if not unset any session vars we 
		 * 
		 * need to...
		 */ 
		 
		
		
		if(($order_id == false) && ($paging == false))
		
		{
			
			//Destroy the cart
			$this->cart->destroy();
			
			$this->session->unset_userdata('order');
			
			/*
			 * Check we have not got a shopping cart in play anyway..
			 * 
			 */ 
			
			if($this->cart->total_items() > 0 )
			
			{
				
				
				
					//$this->put_stock_back();
					
					
			
					//Destroy the session
					$this->session->unset_userdata('order');
				
			}
		}
	
		/*
		 * Create a list of query vars
		 * 
		 */
		
		$where = array('products.master_id' => $this->data['data']->master_id);
		
		/*
		 * Check the params recieved and ajdust the array if necassary 
		 * 
		 */
		
		
		if($sort_by != NULL && is_array($sort_by))
		
		{
			
			/*
			 * Sort by is an array, we need to merge
			 * 
			 * with the current where array...
			 * 
			 */
			
			$newArr = array_merge($where, $sort_by);
			
			$where = $newArr;
			
		}
		
		/*
		 * Get the products from the db
		 * 
		 */
		
		$products = $this->stores_model->products($where);
		
		//print_r($products);
		
		/*
		 * Send the data through pagination function so we dont handle to many records at once
		 * 
		 */
		
		$this->pagination('clientarea/stores/'.($order_id > 0 ? 'view_order/'.$order_id.'/'.(int)false.'/':'stock/'), 
		
						  $products, 
						  
						  'stock_pag', 
						  
						  ($file_ext == NULL ? 4: 6), 
						  
						  8);
		
		/*
		 * Have we got an array 
		 * 
		 */
		
		if(is_array($products) && $sort_by == NULL)
		
		{
			/*
			 * Build the menu on the eft for the suppliers
			 * 
			 */
			 
			$this->build_supplier_menu($products);
			
		}
		
		else 
		
		{
			/*
			 * Nope -- 
			 * 
			 * Query and get the right records back
			 * 
			 */
			
			$this->build_supplier_menu(
			
										$this->stores_model->get_suppliers($this->data['data']->master_id)
										
									);
			
		}
		
		/*
		 * Are we sending a custom file ext
		 * 
		 */
		
		if($file_ext != NULL)
		
		{
			
			
			//Yep lets ammend it then...
			
			$this->file_ext = $file_ext;
			
		}
		
		$this->data['checkedOut'] = $this->checkedOut();
		
		if(!is_numeric($this->uri->segment(4)))
		
		{
				
			$this->session->unset_userdata('paging');
			
			$paging = false;
			
		}
		
		
		//Load the view
		
		$this->view($this->master, $this->prefix, $this->file_ext);	
	}

     /*
	  * Sort by function for filtering
	  * 
	  */
	
	Public function sort_by($type, $company_id)
	
	{
		
		if($type == true)
		
		{
			//Load the stock function and send the overrides to it..
			
			$this->Stock(array('company_id' => $company_id), '_stock');
			
			return false;
		}
	}
	
	/*
	 * Function to process orders
	 * 
	 */ 
	
	Public function process_order($company_id, $site_id, $parent_id = false) {
		
		/*
		 * Get the order qty
		 * 
		 * Loop the post array to find the inner array
		 * 
		 * then create an array of uniques to count..
		 * 
		 */ 
		 
		
		 for($i=0;$i<count($this->posts);$i++)
		 
		 {
		 	
			if(array_key_exists($i, $this->posts))
			
			{
				
				$counter[] = $i;
				
			}
			
		 }
		 
		 
		/*
		 * Is this the first order..
		 */ 
		 
		
		$first_order = (isset($this->posts['order_id']) ? false:true);
		
		/*
		 * Get todays date
		 */ 
		 
		 
		 
		 $now = $this->time;
		 
		 /*
		  * Create a unique ref
		  */ 
		 
		$unique = '#'.uniqid();
		
		/*
		 * Log the date
		 */ 
		 
			
		$date_id = $this->stores_model->insert_return(array('date' => $now), 'date');
		
		/*
		 * Create an orders table array
		 * 
		 * master_id = so we can get all our orders for account
		 * 
		 * user_id = who created the order
		 * 
		 * company_id = what customer the order is for
		 * 
		 * site_id = which site of the customers we are supplying
		 * 
		 * date_id date of the order
		 * 
		 * order_ref = a unique reference for the order
		 * 
		 * save = whether we should save the order, this will be useful for repaeat orders
		 * 
		 */
		 
		 if($first_order == true || $parent_id > 0)
		 
		 {
		
		     $orders = array(
		
						     'master_id'    => $this->data['data']->master_id,
						
						     'user_id'      => $this->data['data']->user_id,
						
						     'company_id'   => $company_id,
						
						     'site_id'      => $site_id,
						
						     'date_id'      => $date_id,
						
						     'ref'          => $unique,
						
						     'save'         => false,
						     
							 'qty'          => count($counter),
						     
							 'parent_id'    => $parent_id,
		
		                   );
		
		//Unset it, we are finished with it now..
						   
		unset($this->posts['order_id']);
		
		/*
		 * Insert the orders
		 */ 				
						
		$order_id  =$this->stores_model->insert_return($orders, 'orders');
		
		 }
		 
		 else 
		 
		 {
		 	
			$order_id = $this->posts['order_id'];
			 
		 }
		
		/*
		 * Create the first instance of an order
		 * 
		 */ 
		
		$order_hist =	$this->stores_model->insert_return(array('date_id' => $date_id, 'order_id' => $order_id), 'order_history');
		
		/*
		 * Run  a loop to create 2 seperate arrays
		 * 
		 * first to update the qty field for the stock levels by deducting the checkout qty in products
		 * 
		 * order items table - we create a batch array of items to be inserted..
		 * 
		 */ 
		 
		 $i=0;
		 
		foreach($this->posts as $arr)
		
			{
				
				if($i < count($counter))
				
				{
					//Can't remeber why I did this

			      $update_items[] = array('id' => $arr['product_id'], 'qty' => $arr['original_stock']);
						
		          $order_items['product_id'][] = $arr['product_id'];
				
				  $order_items['qty'][] = $arr['qty'];
				
				  $order_items['master_id'][] = $this->data['data']->master_id;
				
				  $order_items['order_id'][] = $order_id;
				
				  $order_items['order_history'][] = $order_hist;
				
				  $order_items['updated'][] = (int)(isset($this->posts['order_id']) ? '1':'0');
				  
				}
				
			$i++;
				
			 }
			
			//print_r($update_items); break;

			    //Update the database quantities
			
			    $this->stores_model->batch_update($update_items, 'products', 'id');
				
				//Insert the batch array of order items
				
				$this->stores_model->batch_insert($order_items, 'order_items', NULL);
				
				//Get the company data to append to the alert
				
				$company_data = $this->stores_model->get_company($site_id);
				
				/*
				 * Create the alert
				 */ 
 				
				$event = vsprintf($this->lang->line('order_alert'), 
				
									array(
											$this->data['data']->first_name."&nbsp;".$this->data['data']->last_name,
											
											(isset($this->posts['order_id']) ? 'Updated':'Created'),
											
											$company_data->company_name,
											
											$company_data->site_name,
											
											$unique,
											
											$now
											
											));
											
			 /*
			  *Run the alert function 
			  * 
			  */ 
		
		      $this->addAlert($event);
			  
			  
			  /*
			   * Destroy The Basket
			   * 
			   */ 
			  
			   $this->cart->destroy();
			   
			    //Clear the temp table for this session id...
			    		    
	            $this->stores_model->delete($this->data['data']->session_id, 'session_id', $this->temp_table);
				
		       return false;
		
	}


	function update_order($order_id)
	
	{
		
		
		
		$order_data = $this->stores_model->get_row('orders', 'id', $order_id);
		
		$this->temp_stock();
		
		//$this->put_stock_back();
		
	    $this->process_order($order_data->company_id, $order_data->site_id, $order_id);
		
		
		
	}


	/*
	 * Get the list of customers for the dropdown..
	 * 
	 */ 
	
	Public function customers($type, $id=NULL)
	
	{
		
		$this->get_customers();
				
		$this->load->view('/clientarea/stores/modules/customer_select' , $this->data);
		
	}
	
	/**
	 * 
	 * Function to add or checkout stock
	 * 
	 * @param product_id = (int)
	 */
	 
	 Public function add_stock($product_id)
	 
	 {
	 	
		  //Fields to be validated
		   $this->fields = array('qty');
		   
			
		  //Corresponding errors 	
	      $this->errors = array('required|integer');
		  
			  
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
						 * Which submit button has been clicked?
						 * 
						 * Checkout or update?
						 * 
						 */ 
						 
						if(isset($this->posts['checkout_stock']))
						
						{
							
							//Create an array for the tempory table to insert new data to track the users input
							
							 $temp = array('session_id' => $this->data['data']->session_id, 'product_id' => $product_id, 'qty' =>  $this->posts['qty']);
							 
							 //Insert the data into the temp table..
							 
							 $this->stores_model->insert($temp, $this->temp_table);
							 
							 /*
							 * Update the qty in the database
							 * 
							 */ 
							 
							
							 $this->stores_model->update_qty($product_id, $this->posts['qty']);
							
							 //Checkout, so we run the add basket item function..
							
							$this->insert_basket_item($product_id, false);
							
						}
						
						elseif(isset($this->posts['update_stock']))
						
						{
							/*
							 * Updating stock instead..
							 * 
							 * We need to get the updated total
							 * 
							 * Add the post quantity to the current stock levels
							 * 
							 */ 
							
							$qty = $this->posts['stock'] + $this->posts['qty'];
							
							/*
							 * Update the database..
							 */ 
							
							$this->stores_model->update_row($product_id, 'id', 'products', array('qty' => $qty));
							
							//return a json confirmation...
							
							echo json_encode(array('qty' => $qty));
							
							return false;
							
							
						}
						
						
					}
	 }

 /*
  * Update basket function with quantity
  * 
  */ 
	 
    Public function update_row($product_id=NULL)
	
	{
		
		/*
		 * We need to update the qty in the database first..
		 * 
		 */ 
		 
		// $this->calculate_difference(
		 
		 //							$this->posts['qty'], 
		 							
		 //							$this->posts['qty_before'], 
		 							
		 //							$product_id
									
		//							);
									
		
		
		/*
		 * Create the array of data to update
		 * 
		 */ 
			
		$data = array(
	
        			'rowid' => $this->posts['row_id'],
		
        			'qty'   => $this->posts['qty']
		
                );
				
		/*
		 * Update the cart
		 * 
		 */ 
	
		$this->cart->update($data); 
		
		/*
		 * Return message
		 */ 
		
		echo json_encode(array('message' => 'Quantity Updated'));
		
		return true;
	}
	
	/*
	 * Empty the order completely,
	 * 
	 * distroy the session..
	 * 
	 */ 
	 
	 Public function remove_order($order_id = false)
	 
	 {
	 	/*
		 * Destroy the cart
		 */  
		 
		 if($order_id == false)
		 
		 {
		 	
			//This was initiated from destroying the cart on a fresh order
		 	
			$this->put_stock_back();
			
		 }
		 
		 /*
		  * Nope this is a current order so we need to compare the 
		  * 
		  * updated basket to what has already been checked out and adjust accordingly..
		  * 
		  */ 
		 
		 elseif($order_id > 0)
		 
		 {
		 	
			//Run the coparison function...
		 	
		 	$this->compare_stock_changes($order_id);
			
		 }
		 
		 
	 	
		$this->cart->destroy();
		
		//Confirm !
		
		$this->load->view('clientarea/stores/modules/basket', $this->data, false);
		
		return true;
		
	 }
	 
	 /*
	  * Updating function below  --------
	  * 
	  * Loads the confirmation view for updating products
	  * 
	  */ 
	  
	  function confirm()
	  
	  {
	  	
		return $this->load->view('clientarea/stores/modules/confirm');
		
	  }
	  
	  function delete_order($order_id, $destoy_cart=false, $final=false)
	  
	  {
	  	
		if($destoy_cart == 1)
		
		{
			
			/*
			 * On process order we will put back the original stock then create a new order with a parent id of current order to show the
			 * 
			 * history of the order..
			 * 
			 */ 
			
			$this->temp_stock();
			
			$this->cart->destroy();
			
			echo json_encode(array('basket' => $this->load->view('clientarea/stores/modules/basket', NULL, true)));
			
			return true;
			
		 }	
	
	  
		elseif($destoy_cart ==  2)
			
	     {
	     	
	     	
			
				$this->temp_stock();
				
				if($final == true)
				
				{
					
					//Need to put the order back from query.
					
					$this->put_stock_back();
					
					$this->delete($order_id, true);
					
				}
			
				$this->cart->destroy();
			
				$this->stores_model->update_row($order_id, 'id', 'orders', array('cancelled' => true));
			
				echo json_encode(array('redirect' => true));
			
				return true; 
			
		
				
				
	     }
	  
	        return $this->load->view('clientarea/stores/modules/confirm_delete', array('order_id' => $order_id));
	  
	     }
	  
	 /*
	  * Saved order functions here...
	  * 
	  * 
	  */ 
	  
	  
	  Public function save_order_form($order_id)
	  
	  {
	  	
		$this->load->view('clientarea/stores/modules/save_order_form', array('order_id' => $order_id));
		
	  }
	  
	  Public function save_order($order_id)
	  
	  {
	  	
		/*
		 * Have we got posrt data
		 */ 
	  	
		if(!empty($this->posts))
		
		{
			
			//Get the saved orders
			
			$saved_order = $this->stores_model->get_order_products($order_id);
			
			//Initiate the upload library
			
			$this->load->library('uploader');
			
			//Create the path
			
			$dir = $this->uploader->create_path(array(
				
					  								$this->data['data']->company_name, 
							 
					   								'orders')
													
												);
												
			//Does the upload folder exists
												
			if($this->uploader->folder_exists($dir) == false)
		
					{
						
						/*I
						 * Nope lets create one then!
						 */ 
					
						$this->uploader->create_dir($dir, true);
			
					}
					
			//Lets load the file helper
			
			$this->load->helper('file');
			
			//open the permissions up
			
			chmod('./uploads/'.$dir.'/files', 0777);
			
			//Have we set a name for the saved entry
			
			$order_name = (!empty($this->posts['order_name']) ? $this->posts['order_name']:uniqid());
			
			//Can we write the file
			
			if ( !write_file($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$dir.'/files/'.$order_name.'.txt', serialize($saved_order)))

				{
					
					//relay the message that the file could not be saved
    		
					//Crete a log file
				
				}
				
				
				echo json_encode(array('message' => $this->lang->line('order_saved')));
				
			}
		
	  }
	
	
	/**
	 * Private functions here -------------
	 * 
	 * Function to build the suppliers menu and format the array
	 * 
	 * correctly...
	 * 
	 * @param array extract the supplier data from the array
	 * 
	 */
	
	Private function build_supplier_menu($array)
	
	{
		
		/*
		 * Loop the array
		 * 
		 */
		 
		foreach($array as $s)
			
			{
				
				/*
				 * Create new array with the part we
				 * 
				 * want...
				 * 
				 */
				
				$suppliers[] =array($s['company_name'], $s['comp_id']);
				
			}
		/*
		 * We have amulti-dimensional array
		 * 
		 * we need to only get the uniques back from it...
		 * 
		 */	
			
		$this->data['suppliers'] = array_map("unserialize", array_unique(array_map("serialize", $suppliers)));
		
	}

	/*
	 * Function to insert an item into the checkout
	 * 
	 */
	
	Private function insert_basket_item($product_id, $reload=false)
	
	{
		//Create some vars
		
		$qty = $this->posts['qty']; 
		
		//Get the cart contents

        $cart = $this->cart->contents();
		
		//Set a variable
		
        $exists = false;  
		
		//Create an empty var
			         
        $rowid = '';
		
		//Loop the cart

        foreach($cart as $item) {
        	
		//Have we got a match
				
         if($item['id'] == $product_id)    
				
             {
             	
			/*
			 * Yep so we set exists to true to mark it
			 * 
			 */
            
			$exists = true;	   
			
			//Get the session row_id 
					
            $rowid = $item['rowid'];
			
			//Increase the quantity
					
            $qty = $item['qty'] + $qty;
										
                }       
           }
		
			//Now check it exists

            if($exists)
           {
           		
           	//Update teh basket          
			     
              $this->stores_model->update_item($rowid, $qty);  
			  
			  //Do we need a view returning ?  
				               
				if($reload == false)
				
				{
					
				 echo json_encode(
				
									array('view' => $this->load->view('clientarea/stores/modules/basket', $this->data, true))
									
								  );
								  
				}
				
				//print_r($this->cart->contents());
				
				return true;
				   
           	 }
		   
          else
		  	
            {
            	
			/*
			 * Nope does not exists
			 * 
			 * We simply add the item to the basket
			 * 
			 */
			
            if($this->stores_model->add_item($product_id) == TRUE)
            
			{
             
				//Return the cart to the screen
				
				echo json_encode(
				
									array('view' => $this->load->view('clientarea/stores/modules/basket',$this->data, true))
									
								  );
              }
		
	
            }   
	}

/*
 * Incase we refresh the page we don't want to loose all that data
 * 
 * so we load the cart data and create a small array of updated values
 * 
 */

Private function checkedOut()

{
	/*
	 * Create the array with cart contents
	 * 
	 */
	
	$checkedOut = $this->cart->contents();
	
	//create an empty array
	
	$vals = array();
	
	//Loop the cart contents to build the array
		
	foreach($checkedOut as $args => $val)
	
	{
		/*
		 * We use the product id as key and qty as value, 
		 * 
		 * use array_key_exists in the view..
		 * 
		 */
	
		$vals[$val['id']] = $val['qty'];
		
	}
	
	//Return the array
	
	return $vals;
	
}

Private function get_customers()
	 
	 {
	 	
	 	return $this->data['customers'] = $this->specifications_model->get_customers($this->data['data']->master_id);
		
	 }
	

Private function addAlert($event)
 
 {
 	
									 
	/*
	 * Insert the log
	 * 
	 */ 
									  
	$log_id = $this->stores_model->insert_return(array(
									  
									                   'ip'  => ip2long($this->data['data']->ip_address),
		
					 
					 								    'user_id' => $this->data['data']->user_id
																					   
													  ), 
																					   
												'logs');
													
	 /*
	  * We need to now add an event to the system, this will provide an alert for admins
	  * 
	  * 
	  */ 
									 
									 
	$this->stores_model->insert(array(
									 
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

/*
 * Function to amend the current order..
 * 
 */

Private function amend_order($order_id)

{
	
	/*
	 * Destroy the cart to make sure we only have our order
	 * 
	 */
	
    $this->cart->destroy();
	
	/*
	 * Get the current orders from the db
	 * 
	 */
	
	$orders = $this->stores_model->get_order_products($order_id);
	
	
	/*
	 * We need to run a function here to store the data 
	 * 
	 * in a flat file to update stock levels and such...
	 * 
	 */
	 
	 $this->create_temp_file($orders, $order_id);
	
	//create an array of current products
	
	$prep_cart = array();
			
		foreach($orders as $order)
		
		{
			//Create the correct array for the cart
			
			$prep_cart[] = array(
			
								'id'             => $order->product_id,
								
								'qty'            => $order->qty,
								
								'name'           => $order->name,
								
								'price'          => '0.00',
								
								'target'         => $order->product_id,
								
								'original_stock' => $order->original_stock
								
								);
								
								
			
		}
		
    //Create a new cart with these products
		
	$this->cart->insert($prep_cart); 
	
	//Use the ref as an argument in the cart
	
	$this->data['order_id'] = $order_id;
	
	//Return true
	
	return true;
	
}

/*
 * Function to create a tempory file to store 
 * 
 * previous order_details
 * 
 */

Private function create_temp_file($orders, $id)

{
	//Load the file helper
	
	$this->load->helper('file');
	
	//Create the file
	
	$file = './temp/order'.$id.'.txt';
	
	//Does the file exist
	
	if (file_exists($file)) {
			
    		delete_files($file);

	 } 
	
	if ( ! write_file($file, serialize($orders)))
	
		{
     		
     		$this->addAlert($this->lang->line('order_fail'));

		}

	}

/*
 * If we change sessions we need to put the stock
 * 
 * back into the system...
 * 
 */
 
Private function put_stock_back()

{
	
	//Loop the current cart
	
	foreach($this->cart->contents() as $item)
	
	{
		
		//Put the stock back in the db
		
		$this->stores_model->update_qty($item['id'], $item['qty'], '+');
	}
	
}

/*
 * Function to update the stock levels from the 
 * 
 * qty field within the shopping cart..
 * 
 */

Private function calculate_difference($qty, $qty_before, $product_id)

{
	
	/*
	 * Get the tempory table data..
	 */ 
	
	$temp_stock = $this->stores_model->get_where($this->temp_table, 'session_id', $this->data['data']->session_id, false);
	
	
	/*
	 * Is the qty greater than previous value
	 * 
	 */
	
	if($qty > $qty_before)
	
	{
		
		//Calculate the difference
		
		$difference = $qty - $qty_before;
		
		//Create an array for the tempory table to insert new data to track the users input
							
		$temp = array('session_id' => $this->data['data']->session_id, 'product_id' => $product_id, 'qty' =>  $difference);
							 
		 //Insert the data into the temp table..
							 
		$this->stores_model->insert($temp, $this->temp_table);
		
		
		
		//Update the db
		
		$this->stores_model->update_qty($product_id, $difference, '-');
		
		return true;
		
	}

    //It isn't greater we are putting stock back
	
	else if($qty < $qty_before)
	
	{
		
		//Calculate the difference
		
		$difference = $qty_before - $qty;
		
		$temp = array('session_id' => $this->data['data']->session_id, 'product_id' => $product_id, 'qty' =>  $difference, 'subtract' => true);
							 
		 //Insert the data into the temp table..
							 
		$this->stores_model->insert($temp, $this->temp_table);
		
		//Update the db
		
		$this->stores_model->update_qty($product_id, $difference, '+');
		
		return true;
		
	}
	
  }

/**
 * Clean the post vars for the search area
 * 
 * we are sending different keys so we need to change them 
 * 
 * accordingly..
 * 
 * We already trimmed of any empty vars..
 * 
 * @param array
 */
 
 Private function post_filter($post_vars)
 
 	{
 		
		//if customers dropdown is left at 'select' option..
 		
		if($post_vars['customers'] == 'Select One...')
		
		{
			
			//Get rid if it is..
			
			unset($post_vars['customers']);
			
		}
 		
		//Create an array for keys and replacement keys
 		
		$find_replace = array('customers' => 'orders.company_id' , 'date_from' => 'date.date >', 'date_to' => 'date.date <');
		
		//Loop them to find any that need replacing
		
		foreach($find_replace as $find => $replace)
		
		{
			//Does the key exist that needs replacing
			
			if(array_key_exists($find, $post_vars))
			
			{
				//Create the new var..
				
				$post_vars[$replace] = (strpos($find,'date') !== false ?  insert_date($post_vars[$find]):$post_vars[$find]);
				
				//Unset the old var..
				
				unset($post_vars[$find]);
			}
		}
		
		//return function output..
		
		return $post_vars;
 	
	
 	}

}