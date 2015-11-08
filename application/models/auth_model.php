<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Cleansure Auth system model
 * 
 * Copyright Gofish Web Design
 * 
 * author: Paul Stevenson
 * 
 * date:  13/06/2014
 * 
 */

class Auth_model extends MY_Model

{
	/*
	 * Company table to get the company_details from
	 * 
	 */
	 
	Private $company_table = 'company';
	/*
	 * User table to get the username from
	 * 
	 */
	 
	Private $user_table = 'login';
	
	/*
	 * Users table to get the user data from
	 * 
	 */
	 
	Private $users = 'users';
	
	/*
	 * Table for storing the hash values ie password hash
	 * 
	 */
	
	Private $password_table = 'md5';
	
	/*
	 * Protect the username var
	 * 
	 */
	
	Protected $username;
	
	/*
	 * Private Posts array
	 * 
	 */
	
	Private $posts = array();

	
	

	public function __construct()
	{
		parent::__construct();
		
		//Load the auth config file
		
		$this->load->config('auth', TRUE);
		
		//Load the cookie and date helper
		
		$this->load->helper(array('cookie', 'date'));	
		
		//Load Auth Lang File

		$this->lang->load('auth');

		/*
		 *Config Args below: 
		 * 
		 * 
		 */
		
		
		$this->hash_method = $this->config->item('hash_method', 'auth');
		
		$this->default_rounds = $this->config->item('default_rounds', 'auth');
		
		$this->random_rounds = $this->config->item('random_rounds', 'auth');
		
		$this->min_rounds = $this->config->item('min_rounds', 'auth');
		
		$this->max_rounds = $this->config->item('max_rounds', 'auth');
		
		$this->salt_length = $this->config->item('salt_length', 'auth');

		//load the bcrypt class if needed
		if ($this->hash_method == 'bcrypt') {
			
			if ($this->random_rounds)
			
			{
				$rand = rand($this->min_rounds,$this->max_rounds);
				
				$rounds = array('rounds' => $rand);
				
			}
			
			else
				
			{
				
				$rounds = array('rounds' => $this->default_rounds);
			}

			$this->load->library('bcrypt',$rounds);
		}
		
		$this->posts = $this->input->post(NULL, TRUE);
	}


	/*
	 * Login Rules Below ########################################
	 * 
	 */ 


	/*
	 * Function to hash the password
	 * 
	 */

	
Public function hash_password($password)
	
	{
		
		if (empty($password))
		
		{
			
			return FALSE;
			
		}

		//bcrypt
		if ($this->hash_method == 'bcrypt')
		{
			
			return $this->bcrypt->hash($password);
		}


		
	}

public function salt()

	{
		
		return substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
		
	}

 function user_name_exists($username) 
 
 {
 	
	$this->db->select('login.username, md5.hash')
	
			 ->from($this->user_table)
			 
			 ->where('login.username', $username)
			 
			 ->join($this->password_table, $this->user_table.'.md5_id = '.$this->password_table.'.id', 'left');
			 
				$q = $this->db->get();
		
					if($q->num_rows > 0)
		
							{
								
							
								if( $this->bcrypt->verify($this->posts['password'], $q->row()->hash) )
								
								{
									return true;
									
								}
								
								else
									
								{
										
									return $this->lang->line('password_exists');
									
								}
			
								}
							
								else
									
								{
									
									return $this->lang->line('username_exists');
									
								}
	
	}
 
 function get_user_vars($user_id)
 
 {
 	
	$this->db->select('users.title, users.type as user_type, users.first_name, users.last_name, users.gender, users.contact_id,users.master_id,users.company_id,users.reference_id, 
	
					  company.company_name,company.company_type as company_type, company.company_number,
					  
					  login.username, 
					  
					  restrictions.*,
					  
					  users.master_id')
					  
			->from('users')
			
			->where('users.id', $user_id)
			
			->join('company', 'company.id  = users.company_id', 'left')
			
			->join('login', 'login.user_id = users.id', 'left')
			
			->join('restrictions', 'restrictions.user_id = users.id', 'left');
			
			$q = $this->db->get();
			
			if($q->num_rows > 0)
			
			{
				
			   return 	$q->result_array();
				
			}
			
			else 
			
			{
				
				return false;
				
			}
 }
 
 	
	
 /*
  * User Accounts functions below
  * 
  */
  
  function get_user($user_id)
	
	{
		
		$this->db->select('users.*, users.id as user_id, company.*, users.company_id as c_id, login.*, login.id as login_id, md5.hash, md5.id as pass_id, contact.*')
		
				 ->from('users')
				 
				 ->where('users.id', $user_id)
				 
				 ->join('company', 'users.company_id = company.id', 'left')
				 
				 ->join('login', 'login.user_id = users.id', 'left')
				 
				 ->join('contact', 'contact.id = users.contact_id', 'left')
				 
				 ->join('md5', 'md5.id = login.md5_id', 'left');
				 
				$q =  $this->db->get();
				
				if($q->num_rows > 0)
				
				{
					
					return $q->row();
				}
		
	}
	
  
  Public function get_accounts($args, $keys=false)
  
  {
  	
	$this->db->select('users.*, users.id as u_id, date.date, company.company_name, contact.email_address, login.username')
	
			 ->where($args)
			 
			 ->where_in('type', $keys)
			 
			 ->from($this->users)
			 
			 ->join('date', $this->users.'.date_id = date.id', 'left')
			 
			 ->join('company', $this->users.'.company_id = company.id', 'left')
			 
			 ->join('contact', $this->users.'.contact_id = contact.id', 'left')
			 
			 ->join('login', $this->users.'.id = login.user_id', 'left')
			 
			 ->order_by('users.last_name')
			 
			 ->order_by('type ASC');
			 
			 $q = $this->db->get();
			 
			 	if($q->num_rows > 0)
				
				{
					
					return $q->result_array();
					
				}
	
	
  }
  
  
  /*
   * Folder Passwords function below here
   * 
   */ 
	
	Public function get_folder_password($id)
	
	{
		
		$this->db->select('md5.hash')
		
				 ->from('files')
				 
				 ->where('files.id', $id)
				 
				 ->join('md5', 'files.md5_id = md5.id');
				 
		$q =  $this->db->get();
				
				if($q->num_rows > 0)
				
				{
					
					return $q->row()->hash;
				}
		
		
	}
	
}
