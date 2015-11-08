<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 
 * Bootstrap Error Deliminators
 * 
 */
/*


/*
 * Adding different message alert boxes to help give better visual feed back/user experience
 * 
 * 
 */
 
$errorMessageBox =  "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
$warningMessageBox =  "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
$logoutMessageBox =  "<div class=\"alert alert-success alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";	 			
$CloseMessage = "</div>";			

/*
 * 
 * Login Error Codes and Messages
 * 
 * 
 */

$lang['username_exists'] = $errorMessageBox . '<strong class="blockTxt">Wrong Username!</strong> <span class="MessagePadRight">Your Username is incorrect. Please try again.</span>' . $CloseMessage;

$lang['password_exists'] = $errorMessageBox . '<strong class="blockTxt">Wrong Password!</strong> <span class="MessagePadRight">Your Password is incorrect. Please try again.</span>' . $CloseMessage;

$lang['blocked_ip'] = $warningMessageBox . '<strong class="blockTxt">Temporarily Blocked!</strong> <span class="MessagePadRight">Your IP Has Been Temporarily Blocked! For %s Minutes.</span>' . $CloseMessage;

/*
 * Logout statements
 * 
 * 
 */

$lang['logged_out'] = $logoutMessageBox . '<strong class="blockTxt">Logout Complete!</strong> <span class="MessagePadRight">You have successfully logged out!</span>' . $CloseMessage;

/*
 * Messages for Logs go below here
 * 
 * 
 */
 
$lang['logged_in_log'] = '%s logged in!';