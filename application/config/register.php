<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Permission list for user definitaion upon registration and throughout the system

$config['root'] = 1; //Root user, this is Julian, Kieran & Paul

$config['signee_admin'] = 2; //Level for user to be signee and admin upon registration

$config['admin'] = 3; //Account Admin

$config['signee'] = 4; //Just add this profile as the company signee

$config['user'] = 5;

$config['staff'] = 6;

$config['customers'] = 7; //Customer Profile

$config['suppliers'] = 8; //Supplier Profile

$config['personal'] = 9; //Personal Profile

$config['subcontractor'] = 10; //Personal Profile


//Certifications and checks

$config['dbs'] = 1;

$config['certification'] = 2;

$config['licence'] = 3;


//Type field for checks

$config['dbsCheck'] = array('Standard',  'Enhanced', 'Enhanced With List checks');


/* End of file register.php */
/* Location: ./application/config/register.php */
