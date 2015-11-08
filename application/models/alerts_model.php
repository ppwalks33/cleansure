<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class Alerts_Model extends MY_Model {
   	

   		
		
		function __construct()
		
			{
				
			parent::__construct();
		
			}
			
		
		function get_alerts($master_id, $limit=false)
		
		{
			
			$this->db->select('logs.user_id, events.*')
			
					 ->from('events')
					 
					 ->where(array('master_id' => $master_id, 'status' => true))
					 
					 ->join('logs', 'events.logs_id = logs.id', 'left')
					 
					 ->order_by('events.time ASC');
					 
					if($limit > 0)
					
					{
					 
					  $this->db->limit($limit);
					  
					}
					
			         $q = $this->db->get();
			
			        if($q->num_rows > 0)
			
			            {
				
				          return $q->result_array();
				
			            }
			
			            return false;
		     }
	
        }
   
  ?>