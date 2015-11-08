<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name:  Cleansure Lang - English
*
* Author: Paul Stevenson
* 		  contact@gofishwebdesign.com
*
* Created:  08.10.2014
*
* Description:  English language file for cleansure messages
*
*/

$lang['h2'] =  "<h2> %s </h2>\n<hr>\n<br>\n";

$lang['h4'] =  "<h4> %s </h4>\n<hr>\n<br>\n";

$lang['h5'] =  "<h5> %s </h5>\n<hr>\n<br>\n";

$lang['h2_heading'] =  "<h2><span class=\"glyphicon glyphicon-%s\"></span>&nbsp;&nbsp; %s </h2>\n<hr>\n<br>\n";

//Stores

$lang['search_stores'] = "<h4>&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-search\"></span>&nbsp;&nbsp;Search Orders<small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Select a filter below...</small></h4>\n";

//No and New  Customer section

$lang['tag_heading'] = "<h2 class=\"sub-header\"><span class=\"glyphicon glyphicon-tag\"></span>&nbsp;&nbsp;&nbsp; %s </h2>\n";

$lang['brief_heading'] = "<h2 class=\"sub-header\"><span class=\"glyphicon glyphicon-briefcase\"></span>&nbsp;&nbsp;&nbsp; %s </h2>\n";

$lang['book_heading'] = "<h2 class=\"sub-header\"><span class=\"glyphicon glyphicon-book\"></span>&nbsp;&nbsp;&nbsp; %s </h2>\n";

$lang['envelope_heading'] = "<h2 class=\"sub-header\"><span class=\"glyphicon glyphicon-envelope\"></span>&nbsp;&nbsp;&nbsp; %s </h2>\n";

$lang['machinery_heading'] = "<h2 class=\"sub-header\"><span class=\"glyphicon glyphicon-compressed\"></span>&nbsp;&nbsp;&nbsp; %s </h2>\n";

$lang['user_heading'] = "<h2 class=\"sub-header\"><span class=\"glyphicon glyphicon-user\"></span>&nbsp;&nbsp;&nbsp; %s </h2>\n";

$lang['panel_heading'] = "<div class=\"panel-heading\">\n<h3 class=\"panel-title\">&raquo;&nbsp;&nbsp; %s </h3>\n</div>\n";


//Table icons

$lang['spanPos'] = '<span class="glyphicon glyphicon-ok positive"></span>&nbsp;&nbsp;Yes';

$lang['spanNeg'] = '<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;N/A';


//Menu

$lang['menu'] = "<div class=\"container-fluid\">\n<div class=\"navbar-header\">\n<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">\n<span class=\"sr-only\">Toggle navigation</span>
                 <span class=\"icon-bar\"></span>\n<span class=\"icon-bar\"></span>\n<span class=\"icon-bar\"></span>\n</button>\n<span class=\"navbar-brand hidden-lg\" href=\"#\">Controls</span>\n</div>\n";

/*
 * Interactive Header
 * 
 */
 
$lang['interactive_header'] = "<div class=\"panel-heading\">\n<h4 class=\"panel-title hide-show\">\n<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse%u\">\n<span class=\"glyphicon glyphicon-eye-close\"></span>&nbsp;&nbsp;%s</a>\n</h4>\n</div>\n";

$lang['i_header'] = "<div class=\"panel-heading\">\n<h4 class=\"panel-title hide-show\">\n<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse%val%\">\n<span class=\"glyphicon glyphicon-%glyph%\"></span>&nbsp;&nbsp;%title%</a>\n</h4>\n</div>\n";

/*
 * Work orders langs
 */ 
 
 $lang['purchase_order_complete'] = '<p>You have succesfully completed a purchase order, Thank You';
/*
 * Folder & Security Paragrahs..
 * 
 */ 
 
 $lang['folder_password'] = "<p>Only Enter Password if <strong><i>THE FOLDER NEEDS PROTECTING!</i></strong></p>";
 
 /*
  * Events
  * 
  * -----------------------------------------------------
  */ 
  
  //Holdiday Events
 
 $lang['holdiday_request_event'] = "%s has sent a Holday Request..";
 
 $lang['holdiday_confirm_event'] = "&nbsp;has confirmed %s's Holday Request..";
 
 $lang['holdiday_deny_event'] = "&nbsp;has denied %s's Holday Request..";
 
 $lang['holdiday_edit_event'] = "&nbsp;has changed %s's Holday Request..";
 
 /*
  * Stores prompts and events;
  * 
  */
  
  $lang['confirm_order'] = "<p>Please click the button below to confirm the order is correct!</p><br><p><strong>Please check you have not got pending items in the <strong>Checkout</strong></p>";
  
  $lang['confirm_delete'] = "<p>Please Choose from the following below...<br><br>1.) <strong>Click the &quot;<i>Empty Basket</i>&quot; button and process the order again</strong>.<br><br>2.) <strong>Click the &quot;<i>Destroy Order</i>&quot; Button To Remove the Order From the system</strong>...</p><br>";
  
  $lang['save_order_form'] = "<p>You are about to save this order for later refernece, if you would like to name the order, please fill in the box below, otherwise we will create a unique reference.</p>";
 
 $lang['order_saved'] = "<p>Your Order has been saved!</p>";
 
  /*
   * Name who created order
   * Company order is for
   * Site name in brackets
   * Order ref
   * date-time
   */
   
  $lang['order_alert'] = "<p> %s %s an order for %s (%s), the order ref is %s, created on %s";
  
  $lang['order_fail'] = 'The system failed to store the order';
