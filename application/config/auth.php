<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['hash_method']    				= 'bcrypt';	

$config['default_rounds'] 				= 8;		

$config['random_rounds']  				= FALSE;

$config['min_rounds']     				= 5;

$config['max_rounds']     				= 9;      

$config['admin_email']      			= "gofishwebdesign@gmail.com"; 

$config['remember_users']             	= TRUE;              

$config['user_expire']                	= 86500;             

$config['user_extend_on_login']       	= FALSE;            

$config['maximum_login_attempts']     	= 3;  

$config['timeout'] 						= 15;                

$config['lockout_time']               	= 600;                 

$config['salt_length'] = 15;

$config['store_salt']  = FALSE;

/*
 * Permissions Array...
 * 
 */ 
 
 //$config['permissions'] = 'erkh';

$config['permissions'] = array( '1' => 'r/w/d', '2' => 'r', '3' => 'x');

/* End of file auth.php */

/* Location: ./application/config/auth.php */
