<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class Folder_Model extends MY_Model {
   	
	/*
	 * Private Variable for the joining table
	 * 
	 * 
	 */
	 
	Private $cus_folders = 'customer_folders';
	
	/*
	 * Private Variable for the folders table
	 * 
	 * 
	 */
	
	Private $folders = 'files';
	
	/*
	 * Private Variable for the company table
	 * 
	 * 
	 */
	
	
	Private $company = 'company';
   		
		
		function __construct()
		
			{
				
			parent::__construct();
		
			}
			
		
		function get_folders($company_id)
		
		{
			
			$this->db->select(
						
								$this->folders.'.title as folder_name,'.
								
								$this->folders.'.id,'.
								
								$this->folders.'.file as path,'.
								
								$this->folders.'.md5_id as locked,'.
								
								$this->company.'.company_name,'.
								
								$this->cus_folders.'.user_id,'

								)
								
					->where($this->cus_folders.'.company_id', $company_id)
								
					->from($this->cus_folders)
					
					->join($this->folders, $this->folders.'.id = '.$this->cus_folders.'.folder_id', 'left')
					
					->join($this->company, $this->company.'.id = '.$this->cus_folders.'.company_id', 'left');
					
			$q = $this->db->get();
			
			if($q->num_rows > 0)
			
			{
				
				return $q->result_array();
				
			}
			
			return false;
		}
	
        }
   
  ?>