<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Cleansure Clientarea Specifications model
 * 
 * Copyright Gofish Web Design
 * 
 * author: Paul Stevenson
 * 
 * date:  02/10/2014
 * 
 */

class Specifications_model extends MY_Model

{
	/*
	 * Specifications Table 
	 * 
	 */
	 
	Private $table = 'spec';
	
	/*
	 * Customer Table 
	 * 
	 */
	 
	Private $customers = 'customers';
	
	/*
	 * Company Table 
	 * 
	 */
	 
	Private $qa = 'qa';
	
	/*
	 * Post array
	 * 
	 */
	
	
	Private $posts = array();

	/*
	 * Class Constructor
	 * 
	 */
	

	public function __construct()
	{
		parent::__construct();
		
	}
	
	
	function count_spec($site_id)	
	
	{
		
		$this->db->where('site_id', $site_id)

				 ->from($this->table);

				return $this->db->count_all_results();
		
	}
	
	
	/*
	 * Function to get the last specifications created, this will be extracted
	 * 
	 * from the database using session vars..
	 */ 
	
	function get_recent($array)
	
	{
		
		/*
		 *Have we got an array? 
		 */
		  
		if(is_array($array))
		
		{
			/*
			 * Loop it and split the keys from the vals
			 */ 
				
			foreach($array as $key => $u)
		
				{
					
				//Create an array of site keys
				
				$site_ids[] = $key;
				
				//Get the unique refs from the array
			
				$unique[]   = $u;
				
				}
				
				/*
				 * The above keys ensure we get the correct data back from the db
				 * 
				 * Run the QUERY!!!!!!
				 */ 
				
			$this->db->distinct('spec.unique')
			
					 ->select('spec.unique, spec.site_id, sites.site_name, company.company_name')
			
					 ->where_in('unique', $unique)
					 
					 ->where_in('site_id', $site_ids)
					 
					 ->limit('3')
					 
					 ->order_by($this->table.'.id DESC')
					 
					 ->from($this->table)
					 
					 ->join('sites', 'spec.site_id = sites.id', 'left')
					 
					 ->join('company', 'sites.company_id = company.id', 'left');
					 
			$q = $this->db->get(); 
			
			  if ($q->num_rows() > 0) {
			  	
				
					return $q->result_array();
			  }
			  	
			
		}
		
	}

	/*
	 * Get Recent Spec's
	 * 
	 */ 


	function recent($site_id, $unique)
	
	{
		
	   $this->db->select('spec.area, spec.id as spec_id, spec.site_id, spec.unique, tasks.*')
	   
	   			->where('site_id', $site_id)
				
				->where('unique', $unique)
				
				->from($this->table)
				
				->join('tasks', 'spec.id = tasks.spec_id', 'left');
				
				$q = $this->db->get(); 
			
			  if ($q->num_rows() > 0) {
			  	
				
					return $q->result_array();
			  }
		
	}
	
	/*
	 * Get recent SCI's
	 * 
	 * 
	 */ 
	 
	 function recent_sci($site_id, $unique)
	 
	 {
	 	
		$this->db->select('spec.area, spec.id as spec_id, spec.site_id, spec.unique, sci.*, measurments.*, messages.message')
	   
	   			->where($this->table.'.site_id', $site_id)
				
				->where($this->table.'.unique', $unique)
				
				->from($this->table)
		
				->join('sci', $this->table.'.id = sci.spec_id', 'left')
				
				->join('measurments', 'measurments.id = sci.dim_id', 'left')
				
				->join('messages', 'messages.id = sci.message_id', 'left');
				
				$q = $this->db->get(); 
			
			    if ($q->num_rows() > 0) {
			  	
				
					return $q->result_array();
			  }
	 }
	 
	 
	 Public function last_qa($master_id)
	 
	 {
	 	
		$this->db->select('qa.unique')
		
				 ->from($this->qa)
				 
				 ->where('master_id', $master_id) 
				 
				 ->order_by('id DESC')
				 
				 ->limit(1);
				 
			$q = $this->db->get(); 
				 
			if ($q->num_rows() > 0) {
				
				return $q->row();
				
			}
			
			return false;
	 }


	/**
	 * Function last site spec
	 * 
	 * @param last inserted specification to get the areas.
	 * 
	 */ 
	 
	 function last_site_spec($site_id, $unique = false)
	 
	 {
	 	
		$this->db->select('spec.unique, spec.site_id, date.date, spec.user_id,spec.sci, users.first_name, users.last_name, spec.spec_name')
		
				 ->select('GROUP_CONCAT( spec.area SEPARATOR "," ) AS areas', FALSE)
				 
				 ->select('GROUP_CONCAT( spec.id SEPARATOR "," ) AS spec_id', FALSE)
				 
				 ->select('GROUP_CONCAT( sci.id SEPARATOR "," ) AS sci_id', FALSE)
				 
				 ->select('GROUP_CONCAT( spec.sci SEPARATOR "," ) AS sci', FALSE)
		
				 ->where($this->table.'.site_id', $site_id);
				 
		if($unique != false)
		
		{
			
			$this->db->where($this->table.'.unique', $unique);
		}
				 
		$this->db->from($this->table)
				 
				 ->join('date', $this->table.'.date_id = date.id')
				 
				 ->join('users', $this->table.'.user_id = users.id', 'left')
				 
				 ->join('sci', $this->table.'.id = sci.spec_id', 'left')
				 
				 ->order_by('date.date DESC')
				 
				 ->order_by('spec.area ASC')
				 
				 ->group_by('unique')
				 
				 ->group_by('date.date');
				 
				 $q = $this->db->get(); 
			
				
					if ($q->num_rows() > 0) {
				
	            		foreach ($q->result() as $row) {
					
	                			$data[] = $row;
					
	            							}
				
	            				return $data;
				
	        			}
					
					return false;
	 }
	 
	 /**
	  * Gets the last qa score for comparison with the
	  * 
	  * current qa...
	  * 
	  * @param site id = (int)
	  * 
	  * @param limit = (int) Default False
	  * 
	  */ 
	 
	 function previous_score($site_id, $limit=false, $unique=false)
	 
	 {
	 
	 $this->db->select('qa.id, date.date, users.first_name, users.last_name, spec.spec_name, qa.score, qa.overall')
			  
			  ->where($this->qa.'.site_id', $site_id);
			  
		if($unique > 0)
		
		{ 
			  
	       $this->db->where('qa.unique', $unique);
		   
		 }
			  
	  $this->db->from($this->qa)
			  
			  ->join('date', $this->qa.'.date_id = date.id')
			  
			  ->join('areas', $this->qa.'.id = areas.qa_id', 'left')
			  
			  ->join('spec', $this->qa.'.unique = spec.unique', 'left')
			  
			  ->join('users', $this->qa.'.user_id = users.id', 'left')
			  
			  ->order_by('date.date DESC')
			  
			  ->group_by('date');
			  
			  if($limit > 0)
			  
			  {
			  	
				$this->db->limit($limit);
				
			  }
			  
			   $q = $this->db->get(); 
			   
			   if($limit > 0)
			  
			  {
			  	
					return ($q->num_rows() > 0 ? $q->result_array():false);
			  	
			  }
			   else
			   	
				{
					
					return ($q->num_rows() > 0 ? $q->row():false);
					
				}
			
				
				
	}
	 
	 /*
	  * Get Customer Row, get relavant customer and
	  * 
	  * site data...
	  */ 
	  
	  function get_company_row($customer_data=array())
	  
	  {
	  	
		if(count($customer_data) > 0 )
		
		{
			
			$this->db->select('company.*, sites.site_name')
			
			         ->where('sites.id', $customer_data[1])
					 
					 ->from('sites')
					 
					 ->join('company', 'sites.company_id = company.id');
					 
			$q = $this->db->get();
			
			if($q->num_rows > 0)
			
			{
				
				return $q->row();
			}
			
			
		        return false;
				
		   }
	  }

	/*
	 * Count the customers for the account
	 * 
	 * if 0, we redirect the user to add 
	 * 
	 * the first instance...
	 * 
	 */

	
	function get_customers($id)	
	
	{
		
		$this->db->select('customers.company_id as id, company.company_name')
		
				 ->from($this->customers)
				 
				 ->join('company', $this->customers.'.company_id = company.id', 'left')
				 
				 ->where($this->customers.'.master_id', $id);
				 
				 
				 
	    $q = $this->db->get();
		
		if($q->num_rows() > 0)
		{
			
			return array($q->result_array());
			
		}
		
		return false;
	

	}


	/*
	 * Shared functions go here
	 * 
	 * These functions will be shared with the sites controller
	 * 
	 */
	 
	 /*
	 * ##### Private functions go here 
	 * 
	 * 
	 * 
	 * function to calculate the percentages
	 * 
	 */ 

	 function calculate_score($count, $total, $marker)
	
	{
		
		/**
		 * @param (a) count = int - how many areas we have...
		 * 
		 * @param (b) = maxScore x 4 to get the total maximum score
		 * 
		 * @param (c) total - add up the array to get the score...
		 * 
		 */ 
		
		$maxScore = $count * 4; 
		
		
		/*
		 * Sum up the array
		 * 
		 */ 
										
										
		$totalCount = (is_array($total) ? array_sum($total):$total); 
		
		
		/*
		 * Calculate difference between the values
		 * 
		 */ 
		 
		 $deduction = $maxScore - $totalCount;
		 
		 /*
		  * We get the score
		  * 
		  */ 
		 
		 
		 $percentage = number_format($totalCount / ($maxScore / 100), 2);
		 
		 
		 /*
		  * return an array
		  * 
		  */ 
		 
		 
		 return $data[$marker] = array($maxScore, $totalCount, $percentage);
		
	}
	
	/**
	 * Get the previous score and then run it through the calculator
	 * 
	 * @param prev_score = array
	 * 
	 */
	  
	 function prev_score($prev_score)
	
	{

				
		if (is_object($prev_score))  {
			
			return $this->calculate_score($prev_score->overall, $prev_score->score, 'previous_score');										
			
		}
		
	}
	
	/**
	 * Function to calculate the difference between the 2 scores and find which is the greatest
	 * 
	 * @param lastScore & score = (int)
	 * 
	 */ 
	
	 function difference($lastScore, $score)
	
	{
		
		$data['myScore'][0] = ($lastScore > $score ? true:false);
		
		
		$data['myScore'][1] = ($score > $lastScore ? true:false);
		
		
		$scores = array($lastScore, $score);
		
		
		$data['myScore'][2] = max($scores) - min($scores);
		
		
		return $data['myScore'];
		
	}
	 
	 /*
	  * Private function to check whether a spec has been created
	  * 
	  */ 
	 
	  function has_spec($site_id)
	 
	 {
	 	
		return $this->count_spec($site_id);
		
	 }
	
}
