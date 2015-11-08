<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class MY_Model extends CI_Model {
   	
	/*
 	 * Cleansure Central Model
 	 * 
     * MY_Model is not to be edited or used by unauthorised personel and Gofish Web Desisgn
     * hold full copyright to the code and mainainance of the cleansure system.
     * 
     *  @category   Models
     *  @package    Models
     *  @author     Original Author contact@gofishwebdesign.com
     *  @copyright  2014 Gofish Web Design
     *  @version    Release: Code Version 1.1
     * 
 */
 
 
 /*
  * Class Constructor
  * 
  */
		
		
		function __construct()
			
			{
					
				parent::__construct();
		
				$this->load->database();
				
			}
	
	/*
	 * 
	 * Core Getter Functions Are Below Here
	 * 
	 * Get All = Gets all rows, disticnt clause paremeter added
	 * 			 Sort Key Paremter Added for sorting into multidimensional array
	 *           Return array as objects
	 * 			 ArraySort Function is from My_helper.php
	 * 
	 */
	 
	  
	function get_all($table, $distinct=NULL ,$sortkey=NULL)
	
	{
	
		$this->db->select('*');
		
		if($distinct != NULL) 
		
		{
		
			$this->db->group_by($distinct)
					
					 ->distinct()
			
					 ->select($distinct)
					 
					 ->order_by($sortkey.' ASC')
					 
					 ->order_by($distinct.' ASC');
		
		}		
		
		$q = $this->db->get($table); 
		
	        if ($q->num_rows() > 0) {
				
	            foreach ($q->result() as $row) {
					
	                $data[] = $row;
					
	            }
				
	            return ($sortkey==NULL ? $data : arraySort($q->result_array(), $sortkey));
				
	        }
			
	        return FALSE;	
		
	}
	
	/*
	 * Function get_where, to get the results from single table based
	 * 
	 * upon one id provided...
	 * 
	 */ 
	
		function get_where($table, $where, $id, $dropdown=false)
		
		{
			
			$this->db->select('*');
			
			$this->db->from($table);
			
			if(is_array($where))
			
			{
				
				 $this->db->where($where);
			}
			
			else 
			
			{
				
				
				 $this->db->where($where, $id);
				 
				
			}
					 
					
					 
			$q = $this->db->get(); 
			
			  if ($q->num_rows() > 0) {
			  	
				
				  
				return 	($dropdown == true ? array($q->result_array()) :  $q->result_array() );
					
			  }
			  
			  else 
			  
			  {
				  
				  return false;
			  }
		}
	
	/*
	 * Get Row = gets selected row from the database upon conditions
	 * 
	 */
	
	
	function get_row($table, $where, $id)
	
	{
		
		$this->db->select('*')->where($where, $id)->from($table);
		
		$q = $this->db->get();
		
		if($q->num_rows > 0)
		
		{
			return $q->row();
			
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

	
	function count_tasks($from, $array)	
	
	{
		$this->db->select('*')
		
				 ->from($from)
         
                 ->where($array);
				 
				 return $this->db->count_all_results();
		
	}
	
	
	/*
	 * Insert Return = Insert into the database and return the corresponding id to that row
	 * 
	 */
	
	function insert_return($data="", $table, $skip=false)
	
	{
		//First we check for an array
		if(is_array($data)) 
		
			{
			
			//Have we got a multidimensional Array	
			 if($this->is_multi($data) && $skip == false)
				
				{
					//if so remove outer array, and return the first array keys from the inner array	
					$data = $this->first_keys($data);	
				}
				
				
				    //Now trim any whitespace before db insertion
				    $this->trim($data);
					
					//Insert the record accordingly
					$this->db->insert($table, $data);
					
					//Has the database been updated
					if($this->db->affected_rows() > 0 ) 
		
						{
							//return the id from the record
							return $this->db->insert_id();
						}
		
			}
		
	}
	
	// Just insert the record

	function insert($data, $table)
	
	{
		
		$this->trim($data);
		
		$this->db->insert($table, $data);
		
		
	}
	
	//Delete function
	
	function delete($id, $where, $table)
	
	{
		
		$this->db->delete($table, array($where => $id)); 
	}
	
	
	function delete_row($id, $table)
	
	{
		
		$this->update_row($id, 'id', $table, array('deleted' => (int)true));
		
		return true;
		
	}
	
	/*
	 * Function to insert batch data,
	 * 
	 * We use the array_batch function to create 
	 * 
	 * the array for inserting batch data from 
	 * 
	 * multidimensional post vars
	 * 
	 * Using innodb engine will support table locking with autoincrement on primary key
	 * 
	 * this will ensure that we get the correct array of keys returned.
	 * 
	 * ////////////always check servers for table locking//////////////////////////////
	 */ 
	 
	 function batch_insert($data, $table, $count=NULL)
	 
	 {
	 	//Lets check we have a multidimensional array
		if($this->is_multi($data))
		
		{
			//Get the formatted array back 
			$array = $this->batch_array($data, $count);
			
			//Insert the data through cl batch insert process
			$this->db->insert_batch($table, $array); 
			
			//Have we updated?
			if($this->db->affected_rows() > 0 ) 
		
				{
					//Get id of the first inserted record within the batch
					$last_id = $this->db->insert_id();
					
					//Add how many rows affected onto the last id to generate the array of keys to return
					$records = $last_id + $this->db->affected_rows();
				   
				    //create the keys array
					$keys = array();
					
					//run the loop to generate the right number of keys
					for($i=$last_id; $i<$records;$i++)
					
					{
						//Build the keys array
						$keys[] = $i;
			
					}
					
					//Return the array for later usage
					return $keys;
						
				}
				
			//Failed so return the status of false, nothing updated
			return false;
		}
	 }
	
	//Update Row
	
	function update_row($id, $where, $table, $data) 
	
	{
		
		$this->trim($data);

			
		$this->db->where($where, $id);
		
				
		$this->db->update($table, $data); 
				
			if($this->db->affected_rows() > 0 ) 
		
				{
			
					return TRUE;
						
				}
		
	}
	
	
	/**
	 * @param data = update array
	 * 
	 * @param table = table we are updating
	 * 
	 * @param $key = which array key is the update identifier..
	 * 
	 * Update batch for a single table
	 */
	
	Public function batch_update($data, $table, $key)
	
	{
		
		$this->db->update_batch($table, $data, $key); 
		
		if($this->db->affected_rows() > 0 ) 
		
				{
			
					return TRUE;
						
				}
				
				return FALSE;
	}
	
	
	
	/*
     * Protected function Here
     * 
     */	
     
     
     /*
      * Function to walk over the post array and trim each value
      * 
      */	
 
 
 
 	Protected function trim($data)
	
		{
		
		 //walk through the array and trim each var	
		 return array_map('trim',$data);
		
		}
		
	
	 /*
      * Are we dealing with a multidimensional array
	  * 
	  * The is_multi function will walk over the array and look for 
      * 
	  * arrays within its own keys
	  * 
      */	
 
 	
   

	Public function is_multi($a) 
	
	{
   		//Use array filter to determin if we have an inner array
   		 $rv = array_filter($a,'is_array');
    			
				//if the count is greater than 0, then we have...
    			if(count($rv)>0) return true;
				
    			//nope rturn false
    			return false;
	}
	
	/*
	 * If we just need to use insert functions for 
	 * 
	 * first keys from array => array[]
	 * 
	 * to insert records correctly
	 */
	
	Private function first_keys($array)
	
	{
		//Assign new array
		$newArray = array();
		
		//Loop it and break it down to its compnenets
		foreach ($array as $key => $val)
		
		{
			//Create the new array with only the first keys
			$newArray[$key] = $val[0];
			
		}
		
		//Return the formatted array...
		return $newArray;	
		
	}
	
	/*
	 * Function to add additional data to be appended 
	 * 
	 * to the current post array, we need to ajust accordingly 
	 * 
	 * within the controller
	 * 
	 */
	
	function my_array($array, $table, $myCount, $newKeys)
	
	{				//Master function to count the inner array
		$count =  $this->inner_num($array);
		
		//Are we passing an array, if not we just send the form data
		if(is_array($newKeys))
		
		{
		
		$c=0;
		//We have got an array so we need to loop, then build the inner arrray
		foreach ($newKeys as $key => $val) {
			
			$c++;
			//for loop for inner args
			for($i=0;$i<$count;$i++)
		
				{
					
					//Build the array
					$array[$key][$i] = (is_array($val) ? $val[$i] : $val);
						
			
				}
				
				
			
			}
		
		}
		
		return $this->batch_insert($array,$table, $count);
		
		
		
	}
	
	/*
	 * Create a the correct batch array
	 * 
	 * for inserting into the database
	 *
	 * Use the length for outer loop, we could count array vars instead
	 * 
	 */
	
     Private function batch_array($array, $myCount) 
	
	  {
		//assign new array
		$newArray = array();
		
		//Get the value of the inner array		    
		$count = ($myCount != NULL ? $myCount : $this->inner_num($array));
	
		//Check we have an array and that it has vars
		if(is_array($array) &&  $count > 0)
		
		{
		
		//Run the outer loop to create the correct number of itterations
		for($i=0;$i<$count;$i++)
		
			{
				//Create the inner array
				foreach ($array as $key => $val)
		
					{
						//Make array items
						$newArray[$i][$key] = ($val[$i] == '' ? NULL:$val[$i]);
			
					}
		
			}
		//Return the array formatted for insertion
		return $newArray;
		
		}
		
		//No good return false;
		return false;
	
	}
	  
	  /*
	   * counts the number of array items within the 
	   * 
	   * inner post array
	   * 
	   */
	  
	  Protected function inner_num($array)
	
	{
		//Set the counter to avoid errors
		$count = 0;
		
			//Loop the outer array to get the count from the inner array
			foreach ($array as $type) {
    			
				//Count the inner array
    			$count = count($type);
				
				//We only need the first count so break from first iteration
				break;
			}
			
			//Return the value to function
			return $count;
		
	}
	
	  
   }   	