<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Cleansure Clientarea Staff model
 * 
 * Copyright Gofish Web Design
 * 
 * author: Paul Stevenson
 * 
 * date:  08/07/2014
 * 
 */

class Staff_model extends MY_Model

{
	/*
	 * Table declararions to be used in this class 
	 * 
	 */
	 
	Private $table = 'staff';
	 
	Private $user_table = 'users';
	
	Private $contact = 'contact';
	
	Private $adress = 'address';
	 
	Private $medical = 'medical';
	
	Private $holidays = 'holidays';
	
	
	/*
	 * Protect the post array
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
	

	Public function __construct()
	{
		parent::__construct();
		
		//customer Language file
		$this->lang->load('staff');
		
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

	
	function count_staff($type=NULL)	
	
	{
		
		$this->db->where(array('master_id' => $this->data['data']->master_id, 'type' => $type))

				->from($this->table);

				return $this->db->count_all_results();
		
	}
	
	/*
	 * Get all the staff for the main view
	 * 
	 * 
	 * 
	 */
	
	function all_staff($type=false, $deleted=false, $sortable, $direction)
	
	{
		
		
		$this->db->select('staff.id as staff_id, staff.status,
		
						   users.first_name, users.title, users.last_name, users.id as user_id, users.dob_id,
						   
						   contact.*, contact.id as cont_id,
						   
						   address.*, address.id as add_id, counties.region,
						   
						   reference.reference, 
						   
						   company.company_name, company.company_type , company.company_number, company.vat_number,
						   
						   date.date as date_added, holidays.id as hol')
						   
				->select('(select count(allocation.staff_id) from allocation where allocation.staff_id = staff.id) as machinery',FALSE)
				
				->select('(select count(wk_orders_staff.wk_order_id) from wk_orders_staff where wk_orders_staff.staff_id = staff.id) as staffIds',FALSE)
				
				->where('staff.deleted', $deleted)
				
				->where('staff.type', $type)
				
				->from($this->table)
				
				->join('users', 'users.id = staff.user_id', 'left')
				
				->join('allocation', 'staff.id = allocation.staff_id', 'left')
				
				->join('company', 'users.company_id = company.id', 'left')
				
				->join('wk_orders_staff', 'staff.id  = wk_orders_staff.staff_id', 'left')
				
				->join('contact', 'users.contact_id = contact.id', 'left')
				
				->join('address', 'users.address_id = address.id', 'left')
				
				->join('counties', 'address.county = counties.id', 'left')
				 
				->join('reference', 'users.reference_id = reference.id', 'left')
				
				->join('date', 'staff.start_from = date.id', 'left')
				
				->join('holidays', 'staff.id = holidays.staff_id', 'left')
				
				->order_by(($sortable == false ? 'date ASC': $sortable.' '.$direction))
				
				->group_by($this->table.'.id');
							
				$q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
		
	}
	
	/*
	 * Get the staff profile page
	 * 
	 * 
	 * 
	 */
	
	function staff_profile($staff_id)
	
	{
		
		$this->db->select('staff.*, staff.id as staff_id,
		
						   users.*, users.id as user_id,
						   
						   reference.*,
						   
						   date.date, date.id as date_id,
						   
						   contact.*,
						   
						   certifications.*,
						   
						   address.*, address.id as staff_add_id, counties.region,
						   
						   start.date as start_date,
						   
						   end.date as end_date,
						   
						   workwear.*, workwear.id as workwear_id,
						   
						   convictions.*, convictions.id conv_id,
						   
						   finance.*, finance.id fin_id,
						   
						   medical.*, medical.id as med_id,
						   
						   dcontact.daytime_telephone as doc_tel, dcontact.evening_telephone as doc_tel_eve, dcontact.id as doc_cont_id,
						   
						   dadd.id as doc_add_id, dadd.address_line_1 as dadd_1, dadd.address_line_2 as dadd_2, dadd.address_line_3 as dadd_3, 
						   
						   dadd.city as dadd_city, dadd.postcode as dadd_postcode, dadd.id as ddad_id, dadd.county as ddad_county')
						   
				
						   
				 ->where($this->table.'.id', $staff_id)
				 
				 ->from($this->table)
				 
				 ->join('users', 'users.id = staff.user_id', 'left')
				 
				 ->join('certifications', 'certifications.staff_id = staff.id', 'left')
				 
				 ->join('reference', 'users.reference_id = reference.id', 'left')
				 
				 ->join('date', 'date.id = users.dob_id', 'left')
				 
				 ->join('contact', 'contact.id = users.contact_id', 'left')
				 
				 ->join('address', 'users.address_id = address.id', 'left')
				 
				 ->join('counties', 'counties.id = address.county', 'left')
				 
				 ->join('date as start', 'start.id = staff.start_from', 'left')
				 
				 ->join('date as end', 'end.id = staff.end_from', 'left')
				 
				 ->join('workwear', 'workwear.staff_id = staff.id')
				 
				 ->join('convictions', 'convictions.staff_id = staff.id', 'left')
				 
				 ->join('finance', 'finance.staff_id = staff.id', 'left')
				 
				 ->join('medical', 'medical.staff_id = staff.id', 'left')
				 
				 ->join('contact as dcontact', 'medical.contact_id = dcontact.id', 'left')
				 
				 ->join('address as dadd', 'medical.address_id = dadd.id', 'left');
				 
		$q = $this->db->get(); 
		
	        	 if($q->num_rows > 0)
		
						{
							
							return array($q->row());
			
						}
		
		return false;				   
					 

	}

	/*
	 * Get the staff members name
	 *  
	 */ 


	function staff_name($staff_id)
	
	{
		
		$this->db->select('users.first_name, users.last_name, users.id')
		
				 ->from($this->table)
				 
				 ->where($this->table.'.id', $staff_id)
				 
				 ->join('users', $this->table.'.user_id = users.id', 'left');
				 
	   $q = $this->db->get(); 
		
	        	 if($q->num_rows > 0)
		
						{
							
							return $q->row();
			
						}
		
		return false;				   
					 
		
	}

	/*
	 * Get the staff details for individual profile
	 * 
	 * This is for individual editing purposes in the profile section
	 * 
	 */


	function staff_details($id)
	
	{
		
		$this->db->select('users.first_name, users.last_name, users.title, users.gender, date.*')
		
				 ->where('users.id', $id)
		
				 ->from($this->user_table)
				 
				 ->join('date', 'users.dob_id = date.id', 'left');
				 
		$q = $this->db->get(); 
		
	        	 if($q->num_rows > 0)
		
						{
							
							return $q->row();
			
						}
		
		return false;			
	}

	/*
	 * Will retrieve some further staff details
	 * 
	 * This will fetch any data regarding the employment details
	 * 
	 */
	
	
	function staff_employment($id)
	
	{
		
		$this->db->select('staff.*, date.*, workwear.*')
		
				 ->where('staff.id', $id)
				 
				 ->from($this->table)
				 
				 ->join('date', 'date.id = staff.start_from', 'left')
				 
				 ->join('workwear', 'workwear.staff_id = staff.id', 'left');
				 
		$q = $this->db->get(); 
		
	        	 if($q->num_rows > 0)
		
						{
							
							return $q->row();
			
						}
		
		return false;			
		
	}
	
	/*
	 * Get staff medical data for editing purposes
	 * 
	 * 
	 */
	
	function staff_medical($id)
	
	{
		
		$this->db->select('medical.doctors_name, medical.contact_doc, contact.*, address.*, counties.region')
						   
				 ->where('medical.staff_id', $id)
				 
				 ->from($this->medical)
				 
				 ->join('contact', 'medical.contact_id = contact.id', 'left')
				 
				 ->join('address', 'medical.address_id = address.id', 'left')
				 
				 ->join('counties', 'address.county = counties.id', 'left');
				 
				 $q = $this->db->get(); 
		
	        	 if($q->num_rows > 0)
		
						{
							
							return $q->row();
			
						}
		
		return false;			
	}
	
	
	/* ---------------------------------------------------------------------
	 * 
	 * Staff Holday queries below here.....
	 * 
	 * ---------------------------------------------------------------------
	 */
	 
	 function get_holiday_dates($staff_id)
	 
	 {
	 	
		$this->db->select('holidays.*, holidays.id as hol_id, start.date as start_date, start.id as start_id, 
		
						   finish.id as finish_id, finish.date as finish_date, users.first_name, 
						   
						   users.last_name, reference.reference')
		
				 ->where('staff_id', $staff_id)
				 
				 ->where('year', date('Y'))
				 
				 ->from($this->holidays)
				 
				 ->join('date as start', $this->holidays.'.start_id = start.id', 'left')
				 
				 ->join('date as finish', $this->holidays.'.end_id = finish.id', 'left')
				 
				 ->join('staff', $this->holidays.'.staff_id = staff.id', 'left')
				 
				 ->join('users','staff.user_id = users.id', 'left')
				 
				 ->join('reference','users.reference_id = reference.id', 'left');
				 
		$q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
	 }


    /* ---------------------------------------------------------------------
	 * 
	 * Staff sites query below here.....
	 * 
	 * ---------------------------------------------------------------------
	 */
	
	function get_sites($staff_id)
	
	{
		
		$this->db->select('company.company_name, sites.site_name, days.*, start_time, end_time, customers.id as cust_id, sites.id as site_id')
		
				 ->from('wk_orders_staff')
				 
				 ->where('staff_id', $staff_id)
				 
				 ->join('wk_orders', 'wk_orders.id = wk_orders_staff.wk_order_id', 'left')
				 
				 ->join('days', 'wk_orders.days_id = days.id', 'left')
				 
				 ->join('company', 'company.id = wk_orders.comp_id', 'left')
				 
				 ->join('customers','company.id = customers.company_id', 'left')
				 
				 ->join('sites', 'sites.id = wk_orders.site_id', 'left');
				 
				 
		$q = $this->db->get();
		
		if($q->num_rows > 0 )
		
		{
			
			return $q->result_array();	
			
		}
				 
				 
		
	}
	
}
