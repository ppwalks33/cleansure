<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class Worders_Model extends MY_Model {
   	
   	
	Private $table = 'wk_orders';
   		
		
		function __construct()
	{
		
		parent::__construct();
		
	}
	
	
	function work_orders($args)
	
	{
		
		$this->db->select('wk_orders.*, wk_orders.id as wk_id, company.company_name, company.id as comps_id, customers.id as cust_id, sites.id as sites_id, 
		
						   sites.site_name, startDate.date as startDate, finishDate.date as finishDate, created.date as created')
		
				 ->from('wk_orders')
				 
				 ->where($args)
				 
				 ->join('company', 'company.id = wk_orders.comp_id', 'left')
				 
				 ->join('customers', 'company.id = customers.company_id', 'left')
				 
				 ->join('sites', 'sites.id = wk_orders.site_id', 'left')
				 
				 ->join('date as startDate', 'startDate.id = wk_orders.com_id', 'left')
				 
				 ->join('date as finishDate', 'finishDate.id = wk_orders.fin_id', 'left')
				 
				 ->join('date as created', 'created.id = wk_orders.date_id', 'left');
				 
			$q = $this->db->get();
		
					if($q->num_rows > 0 )
		
						{
			
							return $q->result_array();
			
						}
		
	}
	
	//Get all the purchase orders...
	
	function pur_orders($args=array())
	{
		$this->db->select('purchase_orders.*, purchase_orders.id as p_id, company.company_name, company.id as comp_id, sites.id as sites_id, 
		
						   sites.site_name, supplier.company_name as supplier, supplier.id as sup_id, orders.ref, customers.id as cus_id')
						   
				 ->from('purchase_orders')
				 
				 ->where($args)
				 
				 ->join('company', 'company.id = purchase_orders.company_id', 'left')
				 
				  ->join('customers', 'company.id = customers.company_id', 'left')
				 
				 ->join('company as supplier', 'supplier.id = purchase_orders.supplier_id', 'left')
				 
				 ->join('sites', 'sites.id = purchase_orders.site_id', 'left')
				 
				 ->join('orders', 'orders.id = purchase_orders.order_id', 'left');
				 
		$q = $this->db->get();
		
					if($q->num_rows > 0 )
		
						{
			
							return $q->result_array();
			
						}
		
		
	}
	
	function staffTimes($wo_id)
	
	{
		
		$this->db->select('wk_orders_staff.*, users.first_name, users.last_name, staff.id as staff_id')
		
				 ->from('wk_orders_staff')
				 
				 ->where('wk_order_id', $wo_id)
				 
				 ->join('staff', 'wk_orders_staff.staff_id = staff.id', 'left')
				 
				 ->join('users', 'staff.user_id = users.id', 'left');
				 
			$q = $this->db->get();
		
					if($q->num_rows > 0 )
		
						{
			
							return $q->result_array();
			
						}
				 
	}
	
	
	function get_staff($args)
	
	{
		
		$this->db->select('users.first_name, users.last_name, staff.id as staff_id')
		
				 ->from('staff')
				 
				 ->where($args)
				 
				 ->join('users', 'staff.user_id = users.id')
				 
				 ->order_by('users.last_name ASC');
				 
		$q = $this->db->get();
		
		if($q->num_rows > 0 )
		
		{
			
			return $q->result_array();
			
		}
		
		
			return false;
		
	}
	
	
	function task($wo_id)
	
	{
		
		$this->db->select('wk_orders.*, wk_orders.type as jobType, company.*, sites.site_name, address.*, 
			
						   days.*, wk_orders.id as wk_id, days.id as d_id, address.id as comp_add_id,
						   
						   contact.id as comp_cont_id, users.title, users.first_name, users.last_name, contact.email_address as comp_email, 
						   
						   contact.daytime_telephone as comp_tel, contact.evening_telephone as comp_eve_tel, contact.mobile_telephone as comp_mob,
						   
						   contact.fax_number as comp_fax,
						   
						   startDate.date as start_date, finishDate.date as finish_date, created.date as created')
						   
				// ->select('GROUP_CONCAT( users.first_name SEPARATOR "," ) AS first_name', FALSE)
				 
				// ->select('GROUP_CONCAT( users.last_name SEPARATOR "," ) AS last_name', FALSE)
				 
				// ->select('GROUP_CONCAT( start_time SEPARATOR "," ) AS startTime', FALSE)
				 
				 ->select('GROUP_CONCAT( end_time SEPARATOR "," ) AS endTime', FALSE)
		
				 ->from($this->table)
				
				 ->where($this->table.'.id', $wo_id)
				
				 ->join('company', 'company.id = wk_orders.comp_id', 'left')
				
				 ->join('sites', 'sites.id = wk_orders.site_id', 'left')
				
				 ->join('address', 'sites.address_id = address.id', 'left')
				 
				 ->join('contact', 'sites.id = contact.site_id', 'left')
				 
				 ->join('users', 'users.contact_id = users.id', 'left')
				 
				 ->join('days', 'days.id = wk_orders.days_id')
				 
				 ->join('date as startDate', 'startDate.id = wk_orders.com_id', 'left')
				 
				 ->join('date as finishDate', 'finishDate.id = wk_orders.fin_id', 'left')
				 
				 ->join('date as created', 'created.id = wk_orders.date_id', 'left')
				 
				 ->join('wk_orders_staff', 'wk_orders_staff.wk_order_id = wk_orders.id', 'left')
				 
				 ->group_by('wk_orders.id')
				 
				 ->limit('1');
				
			    $q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
		
	}

//Get the orders for the purchase orders.
	
	function get_orders($args)
	{
		
		$this->db->select('orders.id, orders.ref')
		
				 ->from('orders')
				 
				 ->where($args);
				 
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		{
			
		   return array($q->result_array());
		   
		}
		
		return false;
		
	}

   //Get suppliers

	function get_suppliers($args)
	{
		
		$this->db->select('company.id, company.company_name')
		
				 ->from('users')
				 
				 ->where($args)
				 
				 ->join('company', 'users.company_id = company.id', 'left');
				 
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		{
			
		   return array($q->result_array());
		   
		}
		
		return false;
		
	}
	
	
   }
   
  ?>