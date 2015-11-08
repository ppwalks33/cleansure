<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Cleansure Clientarea Customer model
 * 
 * Copyright Gofish Web Design
 * 
 * author: Paul Stevenson
 * 
 * date:  08/07/2014
 * 
 */

class Customer_model extends MY_Model

{
	/*
	 * Customer Table 
	 * 
	 */
	 
	Private $table = 'customers';
	
	/*
	 * Customer Table 
	 * 
	 */
	 
	Private $sites = 'sites';
	/*
	 * User table to insert and update customer personal data
	 * 
	 */
	 
	Private $user_table = 'users';
	
	/*
	 * Table for storing the contact data
	 * 
	 */
	
	Private $contact = 'contact';
	
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
	

	public function __construct()
	{
		parent::__construct();
		
		//customer Language file
		$this->lang->load('customer');
		
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

	
	function count_customers()	
	
	{
		
		$this->db->where('master_id', $this->data['data']->master_id)

				->from($this->table);

				return $this->db->count_all_results();
		
	}
	
	/*
	 * Get all customers data
	 * 
	 * We need to create several joins to extract data
	 * 
	 * Rename _params@
	 */
	 
	 
	 function get_customers($master_id)
	 
	 {
	 	
		$this->db->select('customers.*, customers.id as cus_id, 
		
						   company.*, company.id as comp_id,  
						   
						   users.*, users.id as u_id,
						   
						   userContact.email_address as user_email, userContact.daytime_telephone as user_d_tel, userContact.evening_telephone  as user_e_tel, userContact.fax_number as u_fax, userContact.mobile_telephone as user_m,
						 
						   compContact.email_address as comp_email, compContact.daytime_telephone as comp_d_tel, compContact.evening_telephone  as comp_e_tel, compContact.fax_number as comp_fax, compContact.mobile_telephone as comp_m,
						 
						   joinDate.date as join_date')
						   
				  ->select('(select count(wk_orders.id) from wk_orders where wk_orders.comp_id = company.id AND wk_orders.type = "2") as contracts',FALSE)
				  
				  ->select('(select count(wk_orders.id) from wk_orders where wk_orders.comp_id = company.id AND wk_orders.type = "1") as oneshots',FALSE)
						 
				  ->select('(select count(wk_orders_staff.wk_order_id) from wk_orders_staff where wk_orders_staff.wk_order_id = wk_orders.id) as staffCount',FALSE)
				 
				  ->select('(select count(sites.site_name) from sites where customers.company_id = sites.company_id) as cusSites',FALSE)
				 
				  ->where('customers.master_id', $master_id)		 
						 
				  ->from($this->table)
				 
				 ->join('sites', 'customers.company_id = sites.company_id', 'left')
				 
				 ->join('company', 'company.id = customers.company_id', 'left')
				 
				 ->join('wk_orders', 'wk_orders.comp_id = company.id', 'left')
				 
				 ->join('wk_orders_staff', 'wk_orders_staff.wk_order_id = wk_orders.id', 'left')
				 
				 ->join('users', 'users.company_id = company.id', 'left')
				 
				 ->join('contact as userContact', 'users.contact_id = userContact.id AND userContact.site_id = "0"', 'left')
				 
				 ->join('contact as compContact', 'company.id = compContact.company_id AND compContact.invoice = "1"', 'left')
				 
				 ->join('date as joinDate', 'customers.date_id = joinDate.id', 'left')
				 
				 ->group_by('customers.id');
				 
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
	 * Get all customers profile data
	 * 
	 * We need to create several joins to extract data
	 * 
	 * Rename _params@
	 */
	
	
	 function get_customer_profile($id)
	 
	 {
	 	
		$this->db->select('customers.*, customers.id as cus_id,
		
						   company.*,  company.id as comp_id,
						   
						   comp_date.id as join_id, comp_date.date as join_date,
						   
						   users.*, users.id as u_id,
						   
						   user_contact.*, user_contact.id as uc_id,
						   
						   comp_add.id as comp_add_id, comp_add.*, add_county.region as add_county,
						   
						   comp_cont.email_address as comp_email, comp_cont.daytime_telephone as comp_tel, comp_cont.id as comp_cont_id,
						   
						   comp_cont.evening_telephone as comp_eve_tel, comp_cont.mobile_telephone as comp_mob, comp_cont.fax_number as comp_fax,
						   
						   user_add.id as user_add_id, user_add.address_line_1 as user_add_1, user_add.address_line_2 as user_add_2,
						   
						   user_add.address_line_3 as user_add_3, user_add.city as user_city, user_add.postcode as user_postcode, user_add.county as user_county_id,
						   
						   counties.region,
						   
						   ')
						   
				->select('GROUP_CONCAT(DISTINCT folders.file SEPARATOR "," ) AS path', FALSE)
				
				->select('GROUP_CONCAT(DISTINCT folders.title SEPARATOR "," ) AS folder_name', FALSE)
				
				//->select('GROUP_CONCAT( folders.md5_id SEPARATOR "," ) AS locked', FALSE)
				
				->select('(SELECT GROUP_CONCAT(files.md5_id SEPARATOR ",") FROM files WHERE files.type = 1 AND customers.company_id = files.root  ) AS locked',FALSE)
				
				->select('GROUP_CONCAT(DISTINCT folders.id SEPARATOR "," ) AS folder_id', FALSE)
				
				->select('GROUP_CONCAT(DISTINCT files.file SEPARATOR "," ) AS files', FALSE)
				
				->select('GROUP_CONCAT(files.parent_id SEPARATOR "," ) AS parent_id', FALSE)
				
				->select('GROUP_CONCAT(DISTINCT files.id SEPARATOR "," ) AS file_id', FALSE)
						   
				->where('customers.id', $id)
						   
				->from($this->table)
				
				->join('company', 'customers.company_id = company.id', 'left')
				
				->join('files', 'files.root = customers.company_id AND files.type = 0', 'left')
				
				->join('customer_folders', 'customer_folders.company_id = customers.company_id', 'left')
				
				->join('files as folders', 'customer_folders.folder_id = folders.id AND folders.type = 1', 'left')
				
				->join('date as comp_date', 'customers.date_id = comp_date.id', 'left')
				
				->join('users', 'customers.company_id = users.company_id', 'left')
				
				->join('contact as user_contact', 'users.contact_id = user_contact.id', 'left')
				
				->join('address as comp_add', 'comp_add.company_id  =  company.id AND comp_add.invoice = 1', 'left')
				
				->join('counties as add_county', 'comp_add.county = add_county.id' , 'left')
				
				->join('contact as comp_cont', 'comp_cont.company_id  =  company.id AND comp_cont.site_id = 0 AND comp_cont.invoice = 1', 'left')
				
				->join('address as user_add',  'users.address_id = user_add.id ', 'left')
				
				->join('counties', 'user_add.county = counties.id', 'left'); 	
				
				$q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
		
		
	 }





	function get_sites($company_id, $sortKey=NULL, $sortOrder=NULL)
	
	{
		
		$this->db->select('sites.*')
		
				 ->where('company_id', $company_id)
				 
				 ->from($this->sites)
				 
				 ->order_by('domain DESC');
				 
		$q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
		
	}
	
	function get_modal_site_edit($siteId)
	
	{
		
		$this->db->select('sites.site_name, address.*')
		
				 ->where('sites.id', $siteId)
				 
				 ->from($this->sites)
				 
				 ->join('address', 'sites.address_id = address.id', 'left');
				 
		$q = $this->db->get(); 
		
	        if($q->num_rows > 0)
		
				{
							
					return $q->row();
			
				}
		
		return false;
		
	}
	
	
	function get_contracts($type, $company_id, $site_id)
	
	{
		
		
		$args = array('wk_orders.comp_id' => $company_id, 'type' => $type);
		
		if($site_id != NULL)
		
		{
			
			$args['wk_orders.site_id'] = $site_id;
		}
		
		
		
		$this->db->select('wk_orders.*, days.*, startDate.date as startDate, finishDate.date as finishDate, 
		
						   sites.site_name')
						   
				 ->select('(select spec.unique from spec where spec.site_id = wk_orders.site_id ORDER BY spec.date_id DESC LIMIT 1 ) as lastSCI',FALSE)
		
				 ->from('wk_orders')
				 
				 ->where($args)
				 
				 ->join('sites', 'wk_orders.site_id = sites.id', 'left')
				 
				 ->join('spec', 'wk_orders.site_id  = spec.site_id ', 'left')
				 
				 ->join('days', 'wk_orders.days_id = days.id', 'left')
				 
				 ->join('date as startDate', 'startDate.id = wk_orders.com_id', 'left')
				 
				 ->join('date as finishDate', 'finishDate.id = wk_orders.fin_id', 'left')
				 
				 ->group_by('wk_orders.id');
				 
				  $q = $this->db->get(); 
		
	        	  if($q->num_rows > 0)
		
					{
							
						return $q->result_array();
			
					}
		
						
						return false;
		
		}
	
	
	function get_staff($comp_id, $site_id=NULL)
	
	{
		
		$args = array('wk_orders.comp_id' => $comp_id);
		
		if($site_id != NULL)
		
		{
			
			$args['wk_orders.site_id'] = $site_id;
		}
		
		$this->db->select('sites.site_name, users.first_name, users.last_name')
		
				 ->from('wk_orders')
				 
				 ->where($args)
				 
				 ->join('wk_orders_staff', 'wk_orders.id = wk_orders_staff.wk_order_id', 'left')
				 
				 ->join('staff', 'staff.id = wk_orders_staff.staff_id', 'left')
				 
				 ->join('sites', 'sites.id = wk_orders.site_id', 'left')
				 
				 ->join('users', 'staff.user_id = users.id', 'left');
				 
				  $q = $this->db->get(); 
		
	        	  if($q->num_rows > 0)
		
					{
							
						return $q->result_array();
			
					}
		
						
						return false;
	}
	
}
