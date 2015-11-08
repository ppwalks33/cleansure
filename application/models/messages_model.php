<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Cleansure Clientarea Messages Model
 * 
 * Copyright Gofish Web Design
 * 
 * Author: Paul Stevenson
 * 
 * date:  02/10/2014
 * 
 */

class Messages_model extends MY_Model

{
	/*
	 * Messages Table 
	 * 
	 */
	 
	Private $table = 'messages';
	
	/*
	 * Recipitent Table 
	 * 
	 */
	 
	 
	Private $recipitent;
	
	
	/**
	 * @param array();
	 * 
	 * Post Args...
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

	
	
	function get_messages($args, $from, $join, $offset=NULL)
	
	{
		
		$this->db->select('recipitent.id as id, messages.id as mess_id, messages.title as message_title, 
		
		
						   messages.message, recipitent.status, messages.inbox, date.date, 
						   
						   
						   users.first_name, users.last_name, users.title')
		
				 ->from($from)
				 
				 ->where($args)
				 
				 ->join($join, 'messages.id = recipitent.message_id', 'left')
				 
				 ->join('date', 'messages.date_id = date.id', 'left')
				 
				 ->join('users', 'users.id = messages.user_id', 'left')
				 
				 ->order_by('recipitent.status ASC');
				 
		if($offset != NULL)
		
		{
				 
			$this->db->limit($offset);
				
		}
				 
		$q = $this->db->get();
		
		if($q->num_rows > 0)
		
		{
			
			return $q->result_array();
			
		}
		
	}
	
	function get_sent($user_id, $offset)
	
	{
		
		$this->db->select('messages.id as mess_id, messages.title as message_title, 
		
						   messages.message, messages.sent, date.date, 
						   
						   users.first_name, users.last_name, users.title')
		
				 ->from('messages')
				 
				 ->where(array('messages.user_id' => $user_id , 'sent' => true))
				 
				 ->join('date', 'date.id = messages.date_id', 'left')
				 
				 ->join('recipitent', 'messages.id = recipitent.message_id', 'left')
				 
				 ->join('users', 'users.id = recipitent.recipitent_id', 'left')
				 
				 ->limit($offset);
				 
				 
		$q = $this->db->get();
		
		if($q->num_rows > 0)
		
		{
			
			return $q->result_array();
			
		}
		
	}
	
	
	function get_message($message_id, $sent=false)
	
	{
		
		$this->db->select('users.id as id, messages.title as message_title, messages.message, 
		
						  messages.status, '.($sent != true ? 'messages.inbox,':NULL).'date.date, messages.user_id as sender,
						  
						  users.first_name, users.last_name, users.title,
						  
						  recipitent.recipitent_id')
		
				 ->from('messages')
		
				 ->where('messages.id', $message_id)
				 
				 ->join('date', 'messages.date_id = date.id', 'left')
				 
				 ->join('users', 'users.id = messages.user_id', 'left')
				 
				 ->join('recipitent', 'recipitent.message_id = messages.id', 'left');
				 
				 $q = $this->db->get();
		
		if($q->num_rows > 0)
		
		{
			
			return $q->row();
			
		}
		
				 
				 
		
	}
	
	
	
}
