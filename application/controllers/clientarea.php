<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',0);
ini_set('display_errors',0);
error_reporting(0);
/*
 * Cleansure ClientArea controller
 * 
 * ClientArea controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   ClientArea
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Clientarea extends Clientarea_Controller {
	
	
	//Class constructor
	public function __construct(){
		
        parent::__construct();	
		
		$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker', 'main', 'live');
		
		$this->data['js'] = javaScript($this->js); 
		
	}
	
	/*
	 * Index page for cleintarea
	 * 
	 */
	
	public function index()
	
	{
		/*
		 * Does this user have a directory created?
		 * 
		 * Create the folder name
		 * 
		 */
		
		$customer_dir = remove_punctuation($this->data['data']->company_name);
		
		/*
		 * Does that folder exist?
		 * 
		 */
		
		if($this->uploader->folder_exists($customer_dir) == false)
		
			{
				
				/*
				 * Nope, so we need to create one!
				 * 
				 */
					
				$this->uploader->create_dir($customer_dir);
			
			}
		
		/*
		 * We need to give the date to the schedual slug to load
		 * 
		 * schedule section from todays date...
		 * 
		 */
		 
		$this->data['schedual_slug'] = date('Y').'/'.date('m');
				
		if(!$this->session->userdata('first_login'))
		{
			
			$this->data['welcome_message'] = 'Welcome To Dashboard';
			
		} else {
			
			$this->data['welcome_message'] = 'Dashboard';
		}
		
		$this->session->set_userdata('first_login', true);
		
		/*
		 * Load the template...
		 * 
		 */
			
		$this->view($this->master);
		
	}
	
	/*
	 * Function to delete alerts
	 * 
	 */ 
	
	Public function remove_alert($event_id=NULL, $logs_id=NULL)
	
	{
		
		
		
		if(!empty($this->posts['ids']))
		
		{
			
			
			$tables = array('logs', 'events');
			
			
			for($i=0;$i<count($this->posts['ids']);$i++)
			
			{	
				
				$rows[] = array($this->posts['log_ids'][$i], $this->posts['ids'][$i]);
				
				$n=0;
				
				foreach($tables as $t)
				
				{
					
					$this->Alerts_Model->delete($rows[$i][$n], 'id' , $t);
					
					$n++;
				}
		
				
			}
			
			//Update the alerts events
		
		     $this->updateAlerts();
			
		}
		
		else 
		
		{
			
		/*
		 * Create an array of tables
		 */ 
		
		 $tables = array('logs' => $logs_id, 'events' => $event_id);
		
		/*
		 * Loop the tables and delete the required rows
		 */ 
		
		foreach($tables as $table => $id)
		
		{
			
			$this->Alerts_Model->delete($id, 'id' , $table);
		 }
		
		
		}
		
		
		
		//Update the alerts events
		
		$this->updateAlerts();
		
		//Return true
		
		return true;
		
	}
	
	Public function alerts()
	
	{
		
		$js=array_push($this->js, 'alerts');
		
		$this->data['js'] = javaScript($this->js);
		
		$this->get_alerts(false);
		
		$this->data['extras'] = true;
		
		$this->view($this->master, $this->prefix);
		
	}
	
	/*
	 * Public access to the alerts
	 * 
	 */
	
	Public function private_alerts()
	
	{
			
		 $this->get_alerts(50);
		 
		 $this->data['extras'] = false;
		 
		  /*
		   * Load the View
		   */ 
		   
		 $this->load->view('clientarea/modules/alerts', $this->data);
		
	}
	
	/*
	 * Private function to get
	 * 
	 * alerts...
	 */
	
	Private function get_alerts($limit)
	
	{
		
		return $this->data['alerts'] = $this->Alerts_Model->get_alerts($this->data['data']->master_id, $limit);
	}


}
