<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Cleansure Clientarea Machinery model
 * 
 * Copyright Gofish Web Design
 * 
 * author: Paul Stevenson
 * 
 * date:  02/10/2014
 * 
 */

class Machinery_model extends MY_Model

{
	/*
	 * Machinery Table 
	 * 
	 */
	 
	Private $table = 'machinery';
	
	/*
	 * Customer Table 
	 * 
	 */
	
	
	Private $posts = array();

	/*
	 * Class Constructor
	 * 
	 * Load the Language file for customers
	 * 
	 * Globalise the posts array
	 */
	

	public function __construct()
	{
		parent::__construct();
		
		//Post array
		$this->posts = $this->input->post(NULL, TRUE);
	}

	/*
	 * Count the customers for the account
	 * 
	 * if 0, we redirect the user to add 
	 * 
	 * the first instance...
	 * 
	 */

	
	function count_machines($master_id)	
	
	{
		
		$this->db->where('master_id', $master_id)

				->from($this->table);

				return $this->db->count_all_results();
		
	}
	
	function get_machnery($master_id)
	
	{
		
		$this->db->select('machinery.*, machinery.id as mach_id, aq.date as aquire_date, pat.date as p_date, allocation.staff_id, allocation.customer_id')
		
				 ->from($this->table)
				 
				 ->where('master_id', $master_id)
				 
				 ->join('date as aq', $this->table.'.aq_date = aq.id', 'left')
				 
				 ->join('date as pat', $this->table.'.pat_date = pat.id', 'left')
				 
				 ->join('allocation', $this->table.'.id = allocation.machine_id', 'left');
				 
				 $q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
	}
	
	
	function allocated_machines($master_id)
	
	{
		$this->db->select('machinery.id as mach_id,machinery.type, machinery.identifier, allocation.machine_id as m_id, 
		
						   allocation.staff_id, allocation.customer_id, allocation.site_id,
						   
						   users.first_name, users.last_name, company.company_name, sites.site_name')
		
		         ->where('machinery.master_id', $master_id)
				 
				 ->from($this->table)
				 
				 ->join('allocation', $this->table.'.id = allocation.machine_id', 'left')
				 
				 ->join('staff', 'allocation.staff_id = staff.id', 'left')
				 
				 ->join('users', 'staff.user_id = users.id', 'left')
				 
				 ->join('customers', 'customers.id = allocation.customer_id', 'left')
				 
				 ->join('company', 'customers.company_id = company.id', 'left')
				 
				 ->join('sites', 'sites.id = allocation.site_id', 'left');
				 
				  $q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
		
	}
	
}
