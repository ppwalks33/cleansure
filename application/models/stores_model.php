<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class Stores_Model extends MY_Model {
   	

   		
		
		function __construct()
		
			{
				
			parent::__construct();
			
			$this->posts = $this->input->post(NULL, TRUE);
		
			}

Public function get_orders($master_id, $cancelled = false, $deleted=NULL, $where,$raw=false)

{
	
	//var_dump( $deleted );
	
	$this->db->select('orders.ref, orders.qty as orderTotal, order_restock.date as restock, orders.id as order_id, orders.parent_id, company.company_name, sites.site_name, 
	
					   date.date, customers.id as customer_id, sites.id as site_id')
	
	         ->select('(select count(order_items.id) from order_items where order_items.order_id = orders.id) as orderTotal',FALSE)
			 
			 ->where(array('orders.master_id' =>  $master_id, 'cancelled' => $cancelled, 'deleted' => (int)$deleted));
			 
			 if(is_array($where))
			 
			 {
			 	
				$this->db->where($where);
			 }
			 
			
	
		   $this->db->from('orders')
			 
			 		->join('company', 'company.id = orders.company_id', 'left')
			 
			 		->join('sites', 'sites.id = orders.site_id', 'left')
					
					->join('order_restock', 'order_restock.order_id = orders.id', 'left')
			 
			 		->join('date', 'date.id = orders.date_id', 'left')
			 
			 		->join('customers', 'customers.company_id = company.id', 'left')
					
					->order_by('date.date');
			 
			$q = $this->db->get();
	
			if($q->num_rows > 0)
	
				{
					//Return raw query for csv helper..
					if($raw == true)
					
					{
						
						return $q;
					}
		
					return $q->result_array();
		
				}
	
					return false;
}

Public function get_restock($order_id)

{
	
	$this->db->select('order_restock.*, order_restock.id as restock_id, days.*,months.*')
	
			 ->from('order_restock')
			 
			 ->where('order_restock.order_id', $order_id)
			 
			 ->join('days','days.id = order_restock.days_id')
			 
			 ->join('months','months.id = order_restock.month_id');
			 
		$q = $this->db->get(); 
		
	        if ($q->num_rows() > 0) {
				
	            
				return $q->row();
				
			}
			
			return false;
}

Public function get_order_products($order_id)

{
	$this->db->select('orders.ref, orders.id as order_id, order_items.qty, products.id as product_id, products.name, products.case_qty, 
	
	                   products.core_size, products.price, products.type, products.qty as original_stock')
	
	         ->from('order_items')
			 
			 ->where('order_items.order_id' , $order_id)
			 
			 ->join('orders', 'orders.id = order_items.order_id', 'left') 
			 
			 ->join('products', 'products.id = order_items.product_id', 'left');
			 
			 $q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
	
}

			
		
Public function products($where)
		
		{
			
			$this->db->select('products.*, products.id as prod_id, measurments.*, company.company_name, company.id as comp_id')
			
					 ->from('products')
					 
					 ->where($where)
					 
					 ->join('company', 'products.company_id = company.id', 'left')
					 
					 ->join('measurments', 'products.measurement_id = measurments.id', 'left')
					 
					 ->order_by('products.name');
		
		  $q = $this->db->get();
		  
		  if($q->num_rows > 0)
		  
		  {
		  	
			return $q->result_array();
			
		  }
			
			return false;		 
					 
			
		 }
		

Public function get_company($site_id)
		
{
	 
  $this->db->select('company.company_name, sites.site_name')
			
		   ->from('sites')
					 
		   ->where('sites.id', $site_id)
					 
		   ->join('company', 'sites.company_id = company.id');
					 
			$q = $this->db->get();
		  
		  	if($q->num_rows > 0)
		  
		  		{
		  	
					return $q->row();
			
		  		}
			
					return false;	
		}
		

Public function get_suppliers($master_id)
		
		{
			
			$this->db->select('DISTINCT(products.company_id), company.company_name, company.id as comp_id')
			
			         ->from('products')
					 
					 ->where('products.master_id', $master_id)
					 
					 ->join('company', 'products.company_id = company.id', 'left');
					 
					 $q = $this->db->get();
		  
		             if($q->num_rows > 0)
		  
		                 {
		  	
			                return $q->result_array();
			
		                 }
			
			return false;	
		}


   function update_item($rowid, $qty) {
		     
        $data = array(
		
            'rowid' => $rowid,
			 
             'qty'   => $qty
			 
          );
		  
        $this->cart->update($data);
    }


Public function add_item($id) {
    	
	    $this->posts['target'];
		
        $this->db->where('id', $id); 
		
        $query = $this->db->get('products', 1);

        if($query->num_rows > 0){
			
            foreach ($query->result() as $row)
			
           {
               $data = array(
               
                    'id'      => trim($id),
                    
                    'qty'     => trim($this->posts['qty']),
                    
                    'name'    => trim($this->posts['item']),
                    
					'price'   => '0.00',
					
					'target'  => trim($this->posts['target']),
					
					'original_stock' => trim($this->posts['original_stock'])
                    
				   );
			   
			
               
          }
		   
		   $this->cart->insert($data); 

                return TRUE;
		
	        
        }
		
		return false;
		
	}

/*
 * Qty update functions below here...
 * 
 * Function to update the qty within the database
 * 
 */

Public function update_qty($product_id, $qty, $synbol='-')

{
	//we are adding products to the cart so we will deduct the qty
	
	$this->db->set('qty', 'qty'.$synbol.$qty, FALSE)
	
                    ->where('id',$product_id)
					
                    ->update('products');
					
					if($this->db->affected_rows() > 0 ) 
		
						{
							//return the id from the record
							return $this->db->insert_id();
						}
}
	
	}
   
  ?>