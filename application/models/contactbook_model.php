<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class Contactbook_Model extends MY_Model {
   	
   		/*
		 *Private Vars 
		 */
		  
		Private $users = 'users';
		
		
		function __construct()
	{
		parent::__construct();
		
		//Load the config file for this class
		$this->config->load('register');
		
	}
	
	/**
	 * Function to get the contacts through the master id & user id
	 * 
	 * @param session vars
	 * 
	 * @param user_id (int)
	 * 
	 */
	
	function contacts($credentials, $user_id)
	
	{
		
		$this->db->select('users.id as u_id, users.first_name, users.last_name, users.title, users.type, contact.*, address.*, counties.region')
		
				 ->from($this->users)
				 
				 ->where($credentials)
				 
				 ->where('type > ', 0)
				 
				 ->where_not_in($this->users.'.id', $user_id)
				 
				 ->join('contact', 'contact.id = users.contact_id', 'left')
				 
				 ->join('address', 'address.id = users.address_id', 'left')
				 
				 ->join('counties', 'address.county = counties.id', 'left')
				 
				 ->order_by('users.type ASC, users.first_name ASC');
				 
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		
		{
			if(array_key_exists('type', $credentials))
			
			{
				
				return $q->result_array();
			}
			else 
			
			{
				
				return arraySort($q->result_array(), 'type');
				
			}
			
		}
		
		else {
			
			return false;
		}
		
	}
	
   }
   
  ?>