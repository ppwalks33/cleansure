<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Cleansure Clientarea Sites model
 * 
 * Copyright Gofish Web Design
 * 
 * author: Paul Stevenson
 * 
 * date:  08/07/2014
 * 
 */

class Sites_model extends MY_Model

{
	/*
	 * Customer Table 
	 * 
	 */
	 
	Private $table = 'sites';
	
	/*
	 * Customer Table 
	 * 
	 */
	 
	Private $customers = 'customers';
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

	
	function count_sites($company_id)	
	
	{
		
		$this->db->where('company_id', $customer_id)

				->from($this->table);

				return $this->db->count_all_results();
		
	}

	function get_sites($company_id, $sortKey=NULL, $sortOrder=NULL)
	
	{
		
		$keys = array('oneshots','contracts' );
		
		$this->db->select('sites.*, customers.id as cus_id, address.*, counties.region, sites.id as site_id');
		
		for($i=0;$i<2;$i++)
		
		{
		
		$n = $i+1;
			  
		$this->db->select('(select count(wk_orders.id) from wk_orders 
				 
				 					where wk_orders.comp_id = customers.company_id  
				 					
									AND wk_orders.site_id = sites.id
				 					
				 					AND wk_orders.type = "'.$n.'"
									
									
									) as '.$keys[$i].'  ',FALSE);
									
		}
		
				  
		$this->db->select('(select count(wk_orders_staff.wk_order_id) from wk_orders_staff where wk_orders_staff.wk_order_id = wk_orders.id) as staffCount',FALSE)
		
		         ->select('(select count(allocation.id) from allocation where allocation.site_id = sites.id) as machineCount',FALSE)
				 
				 ->select('(select spec.unique from spec where spec.site_id = wk_orders.site_id ORDER BY spec.date_id DESC LIMIT 1 ) as lastSCI',FALSE)
		
				 ->where($this->table.'.company_id', $company_id)
				 
				 ->from($this->table)
				 
				 ->join('customers', $this->table.'.company_id = customers.company_id', 'left')
				 
				 ->join('allocation', $this->table.'.id = allocation.site_id', 'left')
				 
				 ->join('address', $this->table.'.address_id = address.id', 'left')
				 
				 ->join('counties', 'address.county = counties.id', 'left')
				 
				 ->join('wk_orders', 'wk_orders.comp_id = customers.company_id AND wk_orders.site_id = sites.id', 'left')
				 
				 ->join('wk_orders_staff', 'wk_orders_staff.wk_order_id = wk_orders.id', 'left')
				 
				 ->order_by('sites.id ASC')
				
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
	
	
	function site_profile($site_id)
	
	{
		
		$this->db->select('sites.site_name, sites.site_reference, sites.id as site_id, 
		
						   address.*, address_id as comp_add_id,
						   
						   company.*, company.id as comp_id,
						   
						   customers.*, customers.id as cus_id
						   
						   ')
						   
						->where($this->table.'.id', $site_id)
						
						->from($this->table)
				 
				 		->join('address', 'sites.address_id = address.id', 'left')
						
						->join('company', 'sites.company_id = company.id', 'left')
						
						->join('customers', 'sites.company_id = customers.company_id', 'left');
				 
							$q = $this->db->get(); 
		
	        					if($q->num_rows > 0)
		
										{
							
										return array($q->row());
			
										}
		
		return false;				   
			
	}
	
	function site_contacts($site_id)
	
	{
		
		$this->db->select('sites.site_name, sites.id as s_id,
		
						   contact.*, contact.id as c_id,
		
						   contacts.first_name as f_name, contacts.last_name as l_name, contacts.id as u_id,
							
						   messages.*, messages.id as message_id, messages.date_id as message_date, messages.user_id as m_u_id, messages.title as message_title,
						   
						   date.*, date.id as date_id,
						   
						   recipitent.*,
						   
						   author.first_name as auth_first_name, author.last_name as auth_last_name,
						    
						   reference.*
							
						   ')
						  
							
				->where($this->contact.'.site_id', $site_id)
							
				->from($this->contact)
				
				->join('users as contacts', 'contacts.contact_id = contact.id', 'left')
				
				->join('sites', 'contact.site_id = sites.id', 'left')
				
				->join('messages', 'messages.user_id = contacts.id and messages.note = 1', 'left')
				
				->join('date', 'date.id = messages.date_id', 'left')
				
				->join('recipitent', 'messages.id  = recipitent.message_id', 'left')
				
				->join('users as author', 'recipitent.recipitent_id  = author.id', 'left')
				
				->join('reference', 'reference.id = author.reference_id', 'left');
				
				$q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
			
	        return FALSE;	
	}
	
	
	function get_contact($user_id, $site_id, $contact_id)
	
	{
		
		if( $user_id > 0)
		
		{
			return $this->get_user($user_id);
			
		}
		else 
		
		{
			
			return $this->get_row($this->contact, 'id', $contact_id);
		
		}
	}
	
	
 Private function get_user($user_id)
 
 {
 	

 	
	$this->db->select('users.*, contact.*')
	
			 ->where($this->user_table.'.id', $user_id)
			 
			 ->from($this->user_table)
			 
			 ->join('contact', 'users.contact_id = contact.id', 'left');
			 
	$q = $this->db->get(); 
		
	        		if ($q->num_rows() > 0) {
				
	            	return $q->row();
				
	        			}
			
	        return FALSE;	
	
 }
				   
	
	
	
}
