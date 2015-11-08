<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class Schedules_Model extends MY_Model {
   	
	
	Private $table = 'wk_orders';
   		
		
		function __construct()
	{
		parent::__construct();
		
		
	}
	
	
	
	function scheduled_jobs($first_day, $last_day, $master_id, $type = NULL)
	
	{
		
		$this->db->select('start.date as startDate, finish.date as finishDate, days.*')
		
				 ->from($this->table);
				 
				 if($type != NULL)
				 
				 {
				 	
					$this->db->where('wk_orders.type', $type);
					
				 }
				 
				 
				 
				 $this->db->where('start.date <=', $last_day)
				 
				 ->where('finish.date >=', $first_day)
				 
				 ->where('wk_orders.master_id', $master_id)
				 				 
				 ->join('date as start', 'wk_orders.com_id = start.id', 'left')
				 
				 ->join('date as finish', 'wk_orders.fin_id = finish.id', 'left')
				 
				 ->join('days', 'days.id = wk_orders.id', 'left');
				 
				 $q = $this->db->get();
				 
				 if($q->num_rows > 0)
				 
				 {
				 	
					return $q->result_array();
					
				 }
				 
				 
	}
	
	function staff_schedule($first_day, $last_day, $master_id, $staff_id)
	
	{
		
		$this->db->select('start.date as startDate, finish.date as finishDate, days.*')
		
				 ->from('wk_orders_staff')
				 
				 ->where('wk_orders_staff.staff_id', $staff_id)
				 
				 ->where('start.date <=', $last_day)
				 
				 ->where('finish.date >=', $first_day)
				 
				 ->where('wk_orders.master_id', $master_id)
				 
				 ->join('wk_orders', 'wk_orders.id = wk_orders_staff.wk_order_id', 'left')
				 
				 ->join('date as start', 'wk_orders.com_id = start.id', 'left')
				 
				 ->join('date as finish', 'wk_orders.fin_id = finish.id', 'left')
				 
				 ->join('days', 'days.id = wk_orders.id', 'left');
				 
				 $q = $this->db->get();
				 
				 if($q->num_rows > 0)
				 
				 {
				 	
					return $q->result_array();
					
				 }
		
	}
	
	
	function daily_jobs($date, $day, $master_id, $type = NULL)
	
	{
		
		$this->db->select('start.date as startDate, finish.date as finishDate, days.*, wk_orders.*, company.company_name, sites.site_name, customers.id as cust_id, sites.id as sites_id')
		
				 ->select('GROUP_CONCAT( users.first_name SEPARATOR "," ) AS first_name', FALSE)
				 
				 ->select('GROUP_CONCAT( users.last_name SEPARATOR "," ) AS last_name', FALSE)
				 
				 ->select('GROUP_CONCAT( start_time SEPARATOR "," ) AS start_time', FALSE)
				 
				 ->select('GROUP_CONCAT( end_time SEPARATOR "," ) AS end_time', FALSE)
			
				 ->from($this->table);
				 
				  if($type != NULL)
				 
				 {
				 	
					$this->db->where('wk_orders.type', $type);
					
				 }
				 
			
		$this->db->where('start.date <=', $date)
			 
			     ->where('finish.date >=', $date)
				
				 ->where('days.'.$day, true)
			 
			     ->where('wk_orders.master_id', $master_id)
			 
			     ->join('date as start', 'wk_orders.com_id = start.id', 'left')
				 
				 ->join('date as finish', 'wk_orders.fin_id = finish.id', 'left')
				 
				 ->join('days', 'days.id = wk_orders.id', 'left')
				 
				 ->join('company', 'company.id = wk_orders.comp_id', 'left')
				 
				 ->join('customers', 'company.id = customers.company_id', 'left')
				 
				 ->join('sites', 'sites.id = wk_orders.site_id', 'left')
				 
				 ->join('wk_orders_staff', 'wk_orders_staff.wk_order_id = wk_orders.id', 'left')
				 
				 ->join('staff', 'wk_orders_staff.staff_id = staff.id', 'left')
				 
				 ->join('users', 'staff.user_id = users.id', 'left')
				 
				 ->group_by('wk_orders.id');
				 
				 
				 $q = $this->db->get();
				 
				 
				 if($q->num_rows > 0)
				 
				 
				 {
				 	
				 	
					return $q->result_array();
					
					
				 }
			
		}


	
	
   }
   
  ?>