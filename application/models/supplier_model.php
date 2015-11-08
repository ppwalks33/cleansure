<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class Supplier_Model extends MY_Model {
   		
		/*
		 *Private Vars 
		 */
		  
		Private $users = 'users';
		
		
		Private $company = 'company';
		
		
		Private $product = 'products';
		
		
		function __construct()
	{
		parent::__construct();
		
		
	}
	
	
	function suppliers($credentials)
	
	{
		
		$this->db->select('users.id as u_id, users.first_name, users.last_name, users.title, users.company_id as c_id,
						  
						   users.type, contact.*, address.*, counties.region, company.*, company.id as comp_id,
						   
						   date.date')
				 
				 ->select('(select count(*) from products where company_id = users.company_id) as productCount',FALSE)
				 
				 ->select('(select count(*) from urls where company_id = users.company_id) as slugCount',FALSE)
		
				 ->from($this->users)
				 
				 ->where($credentials)
				 
				 ->join('contact', 'contact.id = users.contact_id', 'left')
				 
				 ->join('address', 'address.id = users.address_id', 'left')
				 
				 ->join('counties', 'address.county = counties.id', 'left')
				 
				 ->join('company', 'users.company_id = company.id', 'left')
				 
				 ->join('products', 'users.company_id = products.company_id', 'left')
				 
				 ->join('urls', 'urls.company_id = users.company_id', 'left')
				 
				 ->join('date', 'users.date_id = date.id', 'left')
				 
				 ->group_by('users.id ASC')
				 
				 ->order_by('company.company_name ASC');
				 
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		
		{
			
				
				return $q->result_array();
			
			
		}
		
		else {
			
			return false;
		}
	}
	
	function profile($company_id)
	
	{
		
		$consats = array('urls.id' => 'url_id', 'urls.name' => 'url_name', 'urls.slug' => 'slug', 
						
								'products.name' => 'product_name', 'products.type' => 'product_type', 'products.cost' => 'cost', 'products.price' => 'price', 'products.id' => 'prod_id', 'products.measurement_id' => 'meas_id', 'products.date_id' => 'prod_date'
								
								);
		
		$this->db->select('company.*,  company.id as comp_id,
						   
						   comp_date.id as join_id, comp_date.date as join_date,
						   
						   users.*, users.id as u_id,
						   
						   address.*,address.id as comp_add_id,
						   
						   comp_cont.email_address as comp_email, comp_cont.daytime_telephone as comp_tel, comp_cont.id as comp_cont_id,
						   
						   counties.region,
						   
						   ');
								
				foreach ($consats as $field => $name)
				
				{
					
					$this->db->select('GROUP_CONCAT( DISTINCT '.$field.' SEPARATOR "," ) AS '.$name.'', FALSE);
					
				}
						   
				
				
						   
				$this->db->where('company.id', $company_id)
						   
				         ->from($this->company)
				
						 ->join('users', 'users.company_id = company.id', 'left')
				
						 ->join('date as comp_date', 'users.date_id = comp_date.id', 'left')
				
						 ->join('contact as comp_cont', 'comp_cont.id  =  users.contact_id', 'left')
				
						 ->join('address',  'users.address_id = address.id ', 'left')
				
						 ->join('counties', 'address.county = counties.id', 'left')
						 
						 ->join('products', 'products.company_id = company.id', 'left')
				
						 ->join('urls', 'company.id = urls.company_id', 'left');
						 
						 	
				
				       $q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
		
		
	}

	
	
	function get_product($product_id)
	
	{
		
		$this->db->select('products.*, measurments.*, date.date')
		
				->where($this->product.'.id', $product_id)
		
				->from($this->product)
				
				->join('measurments', 'measurments.id = products.measurement_id', 'left')
				
				->join('date', $this->product.'.date_id = date.id', 'left');
				
				 $q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
	        			
						return $q->row();
	        			
					}
		
	}


	function products($c_id)
	
	{
		
		$this->db->select('products.*')
		
				 ->from($this->product)
				 
				 ->where('products.company_id', $c_id);
				 
				  $q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) 
	        		
	        		{
	        			
						return $q->result_array();
						
	        			
					}
					
					return false;
			}
	
   }
   
  ?>