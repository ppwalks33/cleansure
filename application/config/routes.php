<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
*/

$route['404_override'] = '';

$route['default_controller'] = 'authentication/index'; 

//Login routes

$route['clientarea/login'] = 'authentication/index';

$route['clientarea/logout'] = 'authentication/logout';

//Dropbox Routes

$route['clientarea/drop_box/(:any)'] = "drop_box/$1";

//Suppliers Routes

$route['clientarea/suppliers/profile/(:any)'] = "customers/profile/$1";

$route['clientarea/suppliers'] = 'suppliers/index/';

$route['clientarea/suppliers/(:any)'] = "suppliers/$1";

//Customer Routes

$route['clientarea/customers'] = 'customers/index';

$route['clientarea/customers/(:num)'] = 'customers/index/$1';

$route['clientarea/customers/(:any)'] = "customers/$1";

//Staff Routes

$route['clientarea/staff'] = 'staff/index';

$route['clientarea/staff/(:num)'] = 'staff/index/$1';

$route['clientarea/staff/(:any)'] = "staff/$1";

//Sites Routes

$route['clientarea/sites/(:num)'] = 'sites/index/$1';

$route['clientarea/sites/(:any)'] = "sites/$1";

//Machinery Routes

$route['clientarea/machinery'] = 'machinery/index/';

$route['clientarea/machinery/(:any)'] = "machinery/$1";

//Specifications Routes

$route['clientarea/specifications'] = 'specifications/index/';

$route['clientarea/specifications/qa'] = 'specifications/qa/';

$route['clientarea/specifications/qa/(:num)'] = 'specifications/qa/$1';

$route['clientarea/specifications/(:num)'] = 'specifications/index/$1';

$route['clientarea/specifications/(:num)/(:any)'] = 'specifications/index/$1/$2';

$route['clientarea/specifications/(:any)'] = "specifications/$1";

//Contact Book Routes

$route['clientarea/contact_book'] = 'contact_book/index/';

$route['clientarea/contact_book/(:num)'] = 'contact_book/index/$1';

$route['clientarea/contact_book/(:any)'] = "contact_book/$1";

//Accounts Routes

$route['clientarea/accounts'] = 'accounts/index/';

$route['clientarea/accounts/(:num)'] = 'accounts/index/$1';

$route['clientarea/accounts/(:any)'] = "accounts/$1";

//Messages Routes

$route['clientarea/messages/(:num)'] = 'messages/index/$1';

$route['clientarea/messages/(:any)'] = "messages/$1";

//Work Orders Routes

$route['clientarea/work_orders'] = 'work_orders/index';

$route['clientarea/work_orders/(:any)'] = "work_orders/$1";

//Work Orders Routes

$route['clientarea/schedules/all'] = 'schedules/index';

$route['clientarea/schedules/all/(:num)/(:num)'] = 'schedules/index/$1/$2';

$route['clientarea/schedules/(:any)'] = "schedules/$1";

//Sub Contractors Routes

$route['clientarea/subcontractors'] = 'subcontractors/index';

$route['clientarea/subcontractors/(:any)'] = "subcontractors/$1";

//Folders Routes

$route['clientarea/folders/(:any)'] = "folders/$1";

//Stores Routes

$route['clientarea/stores'] = 'stores/index';

$route['clientarea/stores/(:any)'] = "stores/$1";








/* End of file routes.php */