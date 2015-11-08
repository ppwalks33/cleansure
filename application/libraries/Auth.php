<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Auth Class for Cleansure
 * 
 * Author: Paul Stevenson
 * 
 * Copyright: GoFishwebdesign
 * 
 * Version 1.0
 * 
 */


class Auth
{
	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	protected $status;


	/*
	 * Class Constructor
	 * 
	 * Load codeigniter Dependancies
	 * 
	 */ 
	 
	public function __construct()
	
	{
		
		
		$this->load->config('auth', TRUE);
		
		$this->load->library(array('email', 'session'));
		
		$this->lang->load('auth');
		
		$this->load->helper(array('date', 'cookie'));

		$this->load->model('auth_model');
		
		$this->load->library('bcrypt',8);

	}
	
	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 *
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}
	
	/*
	 * To protect against brute force
	 * 
	 * We shall track the IP Address and run a counter to it
	 * 
	 */
	
	Public function login_attempts()
	
	{
		//Check to see if we have added the counter yet
		if(array_key_exists('counter', $this->session->all_userdata()))
			
			{
				//Get the current value of the counter
				$counter = $this->session->userdata('counter');
				
				//How many times has the user tried to log in, if less than, move on
				if($counter < 3) 
				
				{
					//Add one to the counter
					$counter = $counter + 1;
					
					//Re-Set the session var
					$this->session->set_userdata('counter', $counter);
					
					
					
				}
				
				else 
				
				{
					//Run the Block IP
					$this->block_ip($this->session->userdata('counter'));				
					
				}
			}
			
		   else
		   	
			{
				//first attempt, lets start the login
				$this->session->set_userdata('counter', 0);
				
				
			}
		
	}
	
	Public function is_blocked()
	
	{
		//Have a look for the session var blocked
		if(array_key_exists('blocked', $this->session->all_userdata()))
		
		{
			//Get the time it was blocked, and deduct from now
			 $timeLeft =  abs($this->session->userdata('blocktime') - now());
			 
			//Calculate the difference in minutes
			 $minutes   = round($timeLeft / 60);
			 
			 //Check if the time has passed
			 if($this->session->userdata('blocktime') < now()) 
			 
			 {
			 	 //If so destroy the session
				 $this->session->sess_destroy();
				 
				 //Redirect the user back to login form to start the session again
				 header('Location: /clientarea/login/');
				
				
			 }
			 
			 echo 'here';
			
			 //show the error with the number of minutes in the error message
			 return sprintf($this->lang->line('blocked_ip'), $minutes);
			
			
		}
		
		else 
		
		{
			//Not blocked so return false, the user can carry on...
			return false;
		}
		
		
	}
	
	/*
	 * Log The User In
	 * 
	 * Creates the necassary cookies and stores some data
	 * 
	 * Insert in the logs table a starting event
	 * 
	 */  
	
	Public function log_in( $user_id, $user_name )
	
	{
			
		//Create array to build cookie data for later verification
		$cookies = array('identity' => 'cleansure#'.$user_id, 'loggedin' => true);
		//Create a cookie for remember me!
		$this->auth_cookie($cookies, time()+60*60*4);
		//Isert the date into the date table to reference the date the user logs in 
		$date_id = $this->auth_model->insert_return(array('date' => date("Y-m-d H:i:s")), 'date');	
		/* 
		 * Create a log of the user logging in,
		 * 
		 * use iptolong to store the ip address as a integer,
		 * 
		 * Insert the user id for the log so we can later track it
		 */ 		
		$log_id = $this->auth_model->insert_return(array('ip'      => ip2long($this->session->userdata('ip_address')),
		
					 								     'date_id' => $date_id,
					 
					 								     'user_id' => $user_id), 'logs');
														 
		
														 
														 
		$this->auth_model->insert(array('logs_id' => $log_id,
		
										'event'   => sprintf($this->lang->line('logged_in_log'), $user_name)
										
										),'events');
				
			return true;
		
	}
	
	Public function logout() 
		
	{
		$cookies = array('identity' => NuLL, 'loggedin' => NULL);
		
		$this->auth_cookie($cookies, time()-3600);
					
		return $this->lang->line('logged_out');
		
	}
	
	/*
	 * Checks users status
	 * 
	 * 
	 * 
	 * Insert in the logs table a starting event
	 * 
	 */  
	
	Public Function is_logged_in()
	
	{
		//Has the user got a valid cookie and check they are logged in
		
		if((get_cookie('clean_identity')) && (get_cookie('clean_loggedin') == true))
		
		{
			
			//Has the user been previously logged in if bot, build the session vars
			if(!array_key_exists('master_id', $this->session->all_userdata()))
			
			{
				//Get the user id for the end of the token
				$user =  explode('#', get_cookie('clean_identity') );
				
				//Set all the session data with return array
				$this->session->set_userdata($this->auth_model->get_user($user[1]));
				
				//Return true!!!!
				return true;
			}
			
			else 
			
			{
				//Session already available, just return true
				return true;
				
				
			}
			
		}
		
		else
			
		{
			//No cookie or session vars available, return status as false;	
			return false;	
		}
		
	}
	
	Public function success()
	
	{
		
	return	header("Location:".base_url()."clientarea/");
		
    }
	
	
	//Fail url, we shall add this as config at later date
	
	Public function fail_url()
	
	{
		
	return	header("Location:".base_url()."clientarea/login");
		
    }
	
	/**
	 * @param string = password string
	 * 
	 * 
	 */
	
	Public function check_folder_password($string, $id)
	
	{
				
		$password = $this->auth_model->get_folder_password($id);
		
		if( $this->bcrypt->verify( $string , $password ) )
								
			{
					
				return true;
									
			}
			
		return false;
		
	}
	
	/*
	 * Private function below here
	 * 
	 */
	 
	 
	/*
	 * Function to create, delete cookie data for auth system
	 * 
	 * Params = Each cookie name and value 
	 * 
	 * $expire = Time tpo expire, remove cookie set the time to the past 
	 * 
	 * 
	 * 
	 */
	 
	Private function auth_cookie($cookies, $expire) 
	
	{
		
		foreach ($cookies as $key => $val)
		
		{
		
			$cookie = array(
    
    				'name'   => $key,
    
    				'value'  => $val,
    
					'host' => base_url(),
	
					'path'   => '/',
    
    				'expire' => $expire,
  
    				'prefix' => 'clean_',
    
    				'secure' => FALSE
            );
			
			 $this->input->set_cookie($cookie);
			
		}
		
	}
	
	/*
	 * Function to block the ip by adding it to session data
	 * 
	 * The time is added so we can track what time they where 
	 * 
	 * Blocked...
	 * 
	 */
	 
	Private function block_ip($ip)
	
	{
				
		return $this->session->set_userdata(array('blocked' => 1, 'blocktime' => strtotime("+".$this->config->item('timeout', 'auth')." minutes")));
	}

}
