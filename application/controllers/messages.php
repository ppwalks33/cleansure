<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
/*
 * Cleansure Messages controller
 * 
 * Messages controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Messages
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Messages extends Clientarea_Controller {
	
	/*
	 * Private varaible fields
	 * Store the  fields that need validating
	 * 
	 */ 
	
	Private $fields = array();
	
	/*
	 * Private varaible errors
	 * Store the errors that coorespond to fields array
	 * 
	 */ 
	
	Private $errors = array();
	
	 
	 
	
	//Class constructor
	Public function __construct()
	
	{
		
        parent::__construct();	
		
		
		$this->load->model(array('messages_model', 'auth_model'));
		
		
		$this->file_ext = '_'.$this->uri->segment(3);
		
		
		$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker','main','live', 'messages');
		
		
		$this->data['js'] = javaScript($this->js); 
		
		
		$this->data['modules'] = 'clientarea/messages/modules/';
		
	}
	
	
	
	Public function index($user_id)
	
	{
		
		$this->data['messages'] = $this->messages_model->get_messages(array('recipitent.recipitent_id' => $this->data['data']->user_id, 'recipitent.status > ' => false, 'inbox' => true),
																		
																			     'recipitent',
																		
																				 'messages'
																				 
																				 
		
																	);
		if($this->input->is_ajax_request())
		
		{
			$arr = array();
			
			foreach($this->data['messages'] as $data) {
				
				if($data['status'] == 1) {
					
					$arr['message_id'][] =  $data['mess_id'];
					
					$arr['message_title'][] =  $data['message_title'];
					
					$arr['from'][] =  ucwords($data['first_name'].' '.$data['last_name']);
				 }
					
				}
			
			
			echo json_encode($arr);
			
			return false;
		}															
			
		$this->view($this->master, $this->prefix);
		
	}
	
	
	Public function write($user_id)
	
	{
		if(!empty($this->posts))
		
		{
			
			
			$this->fields = array('title');
			
			$this->errors =array('required');
			
			$this->runValidator($this->fields, $this->errors);
			
			//Check for errors
			if ($this->form_validation->run() == FALSE)
				
				  {
				  	
					
					
					  //show the form and send the parameters of the failed fields
				  	  echo json_encode($this->form_validation->error_array());	
					  
					  
					
						
					return false;
					 
					
				  }
				  
				  else 
		
		{
			
			//Add the time and date when the user registers with cleansure
			$date_id = $this->Registration_Model->insert_return(array('date' => insert_date($this->time)), 'date');
			
			
			
			
			$message_id = $this->messages_model->insert_return(array_merge(
			
																			array_slice($this->posts,1,2), 
																			
																			array('sent' => true, 'inbox' => true, 'status' => true, 'note' => false, 'user_id' => $this->data['data']->user_id, 'date_id' => $date_id))
																			
																			,'messages');
			
			
			
			
			$recipitent = array('recipitent_id' => $this->posts['reciptent_id'], 'message_id' => $message_id, 'status' => true);
			
			
			
			$this->messages_model->insert($recipitent, 'recipitent');
			
			echo json_encode(array('message' => 'Message Sent'));
			
			return false;
			
		}
			
			
		}
		
         else {
			
		
		
		$levels = array(1,2,3,5);
		
		
		$args = array('users.master_id' => $this->data['data']->master_id, 'users.company_id' => $this->data['data']->company_id);
		
		
		$accounts = $this->auth_model->get_accounts($args, $levels);
		
		
		$this->data['members'] = array();
		
		foreach($accounts as $user)
		
		{
			if($user['u_id'] != $this->data['data']->user_id)
			
			{
			
				$this->data['members'][$user['u_id']] = $user['title'].' '.$user['first_name'].' '.$user['last_name'];
				
			}
			
		}
		
		
		$this->load->view($this->data['modules'].'clientarea_messages_write', $this->data);
		
		}
		
		
	}


	Public function reply()
	
	{
		
		$this->write($this->data['data']->user_id);
		
		return false;
		
	}

	Public function read($message_id, $sent=false)
	
	{
		
		if($sent == false)
		
		{
		
			$this->messages_model->update_row($message_id, 'message_id', 'recipitent',array('status' => 2)); 
			
		}
		
		
		$this->data['messageBox'][0] = $this->messages_model->get_messages(array('recipitent.recipitent_id' => $this->data['data']->user_id, 'recipitent.status > ' => false, 'inbox' => true),
																		
																			     'recipitent',
																		
																				 'messages',
																				 
																				  15
		
																	);
																	
																	
		$this->data['messageBox'][1] = $this->messages_model->get_sent($this->data['data']->user_id, 15);
		
		
		$this->data['mess'] = $this->messages_model->get_message($message_id, $sent);
		
		
		$this->view($this->master, $this->prefix);
		
	}


	Public function delete($message_id, $option)
	
	{
		
		
		
		if($option == 1)
		
		{
			
			$update = 'inbox';
			
		}

		elseif($option == 2)
		
		{
			
			$update = 'sent';
			
		}
		
		
		$this->messages_model->update_row($message_id, 'id', 'messages', array($update => false));
		
		
		$check = $this->messages_model->get_row('messages', 'id', $message_id);
		
		
		if($check->sent == false && $check->inbox == false)
		
		{
			
			$args = array('recipitent' => 'message_id', 'messages' => 'id');
			
			foreach ($args as $table => $key)
			
			{
				
				$this->messages_model->delete($message_id, $key, $table);
				
			}
			
		}
		
		echo json_encode(array('message' => 'Message Deleted'));
		
		return false;

	}
	

	

}