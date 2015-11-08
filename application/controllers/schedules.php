<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
/*
 * Cleansure Schedules controller
 * 
 * Schedules controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Schedules
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2014 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Schedules extends Clientarea_Controller {
	
	/**
	 *
	 * @param array 
	 *
	 * Private varaible fields
	 * Store the  fields that need validating
	 * 
	 */ 
	
	Private $fields = array();
	
	/**
	 * 
	 *@param array()
	 * 
	 * Private varaible errors
	 * Store the errors that coorespond to fields array
	 * 
	 */ 
	
	Private $errors = array();
	
	/**
	 * 
	 * @param int
	 * 
	 * Private varaible month
	 * 
	 */ 
	
	
	Private $month;
	
	/**
	 * 
	 * @param int
	 * 
	 * Private varaible year
	 * 
	 */ 
	
	
	
	Private $year;
	
	/**
	 * 
	 * @param int
	 * 
	 * Private varaible days
	 * 
	 */ 
	
	
	
	Private $days;
	
	
	
	
	
	Protected $staff;
	
	 
	 
	
	//Class constructor
	Public function __construct()
	
	{
		
        parent::__construct();	
		
		$this->load->model('schedules_model');
		
		$js=array_push($this->js, 'bootstrap-select.min','bootstrap-datepicker', 'main', 'live');
		
		$this->data['js'] = javaScript($this->js); 	
		
		/*
		 * Modules Folder
		 * 
		 */
		
		$this->data['modules'] = 'clientarea/schedules/modules/';
		
		/*
		 * Get the month from url
		 * 
		 */
		
		$this->month = $this->uri->segment(5);
		
		/*
		 * Get the year from url
		 * 
		 */
		
		$this->year = $this->uri->segment(4);
		
		/*
		 * Get the staff id from url
		 * 
		 */
		
		$this->staff = $this->uri->segment(6);
		
		/*
		 * Set the preferences for the calender
		 * 
		 */
		
		$this->prefs = array (
                               'show_next_prev'  => TRUE,
                           
                               'next_prev_url'   => base_url().'clientarea/schedules/'.$this->uri->segment(3).'/',
                               
							   'staff_id'        => $this->staff,
							   
							   'day_type'        => 'long'
             );
			 
		/*
		 * Initialize the library and send the prefs
		 * 
		 */
		
		$this->load->library('calendar', $this->prefs);
		
		/*
		 * Create an array of days 
		 * 
		 */
		
		$this->days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
		
		/*
		 * Get the number of in the month provided by the url
		 * 
		 */
		
		$this->last = days_in_month($this->month, $this->year);
		
		/*
		 * Create a usable date from the last day var
		 * 
		 */
		
	    $this->last_day =  new DateTime($this->last.'-'.$this->month.'-'.$this->year.'');
		
		/*
		 * Create a usable date from the first day var
		 * 
		 */
		
		$this->first_day =  new DateTime('01-'.$this->month.'-'.$this->year.'');
		
		
	}
	
	/*
	 * Main view - index function
	 * 
	 * No params sent so we want all the data out
	 * 
	 */
	
	Public function index()
	
	{	
		
	 return $this->markers(NULL);
			
	}
	
	/*
	 * Load all the one shot jobs
	 * 
	 */


	Public function one_shot()
	
	{
		
		return $this->markers(1);
		
	}
	
	/*
	 * Load all the recurring jobs
	 * 
	 */
	
	
	Public function recurring()
	
	{
		
		return $this->markers(2);
	}
	
	
	/*
	 * Load a calender view based upon subcontractors
	 * 
	 */ 
	
	
	Public function subcontractors()
	
	
	{
		
		
		return $this->markers(NULL, true, true);
		
	}
	
	
	/*
	 * Load a calender view based upon staff member
	 * 
	 */ 
	
	Public function staff()
	
	{
		
		return $this->markers(NULL, true);
		
	}

	
	/*
	 * Model view of the jobs for that day
	 * 
	 */

	Public function jobview($y,$m,$d, $type=NULL)
	
	{
	
	/*
	 * Create a date from url params
	 */ 	
		
	$date =  new DateTime($d.'-'.$m.'-'.$y.'');
	
	/*
	 * Format the date to be usable
	 */ 
		
		
	$d = $date->format('Y-m-d');
	
	/*
	 * Find what day of the week it is we are looking at...
	 */ 	
		
	$day = date('l', strtotime($d));
	
	/*
	 * Run the query to find all jobs for that day...
	 * 
	 */ 
		
		
	$this->data['jobs'] = $this->schedules_model->daily_jobs($d, $day, $this->data['data']->master_id, $type);
		
	/*
	 * Send the days of the week params to the view...
	 * 
	 */
	  	
	$this->data['days'] = $this->days; 
	
	/*
	 * Load the view and pass the data
	 * 
	 */ 
		
		
	$this->load->view($this->data['modules'].'jobview', $this->data);
		
		
		
	}
	
	/*
	 * Use url data to toggle between types (ie one- shot -- recurring)
	 * 
	 */
	
	Private function menu_dates()
	
	{
		
		$this->data['month'] = $this->month;
		
		$this->data['year'] = $this->year;
	}
	
	
	/**
	 * @param type (int)
	 * 
	 * Get all the jobs out of the database and create the events for
	 * 
	 * calender markers
	 * 
	 */
	
	Private function markers($type, $staff=false, $subc = NULL)
	
	{
		/*
		 * Get the dates for the menu to load the appropriate data
		 * 
		 */
		
		$this->menu_dates();
		
		/*
		 * Get the data from db based upon date vars
		 * 
		 */
		 
		$markers = array();
		
		
		
		if($staff == true)
		
		{
			
			$markers = $this->schedules_model->staff_schedule(
			
								$this->first_day->format('y-m-d'), 
								
								$this->last_day->format('y-m-d'), 
								
								$this->data['data']->master_id, 
								
								$this->staff
								
								);
			
		}
		
		else 
		
		{
			
			$markers = $this->schedules_model->scheduled_jobs(
			
								$this->first_day->format('y-m-d'), 
								
								$this->last_day->format('y-m-d'), 
								
								$this->data['data']->master_id, 
								
								$type
								
								);
			
		}
		
		
		
		/*
		 * Have we got an array returned
		 * 
		 */
		
		if(is_array($markers) && count($markers) > 0)
		
		{
			
			/*
			 * Slice the array to get the dates back
			 * 
			 */
			
			
			
			$dates = $this->extract_keys($markers, 0, 2);
			
			/*
			 * Slice the array to get the days back
			 * 
			 */
			
		
			$markers = $this->extract_keys($markers, 3);
		
			
			/*
			 * Send params to marker function to create calender markers
			 * 
			 */
		
			$days = $this->create_markers($markers, $dates);
			
			/*
			 * Run the function to generate the markers
			 * 
			 */
			
			
			$this->generate($days, $type);
		
			
		}
		
		/*
		 * Load the calender template;
		 * 
		 */
		
		$this->view($this->master, $this->prefix);	
	}


	/**
	 * Generate function
	 * 
	 * @param days = array
	 * 
	 * @param type = int
	 * 
	 */
	
	Private function generate($days, $type = NULL)
	
	{
		
		/*
		 * Have we got an array of days?
		 * 
		 */
		
		if(is_array($days) )
			
				{
					/*
					 * Initialize an events array
					 * 
					 */
					 
					$this->data['events'] = array();
					
					/*
					 * Loop the days
					 * 
					 */
				
					foreach($days as $event)
					
					{
						
						/*
						 * Create a date from event and url params
						 * 
						 */
						
					   $date = new DateTime(trim((int)$event.'-'.$this->month.'-'.$this->year.''));
					   
					   /*
					    * Count the occurances of the same date to identify how many jobs are available
					    * 
					    * on that day...
					    * 
					    */
						
					   $c = array_count_values($days);
					   
					   /*
					    * Create the array of links for the view...
					    * 
					    */
						
					  $this->data['events'][(int)$event] =  anchor('clientarea/schedules/jobview/'.$this->year.'/'.$this->month.'/'.$event.'/'.$type, 
					  
					  											//   $c[$event], 
					  											   
					  											   "&nbsp;",
					  											   
					  											   array('title' => 'Look Up Events', 'class' => 'trigger calendar-overlay', 'data-title' => $date->format('d/m/Y').' Jobs'));
					  
										
					}


				
			}
		
	}
	
	/**
	 * Function to create the markers
	 * 
	 * @param markers = array
	 * 
	 * @param dates = array
	 * 
	 */
	
	Private function create_markers($markers, $dates)
	
	{
		
		/*
		 * Create an array of keys, minimises code output...
		 * 
		 */
		
		$keys = array('start', 'finish');
		
		
		/*
		 * Loop the markers
		 * 
		 */

		for($i=0;$i<count($markers);$i++)
		
		{
			
			/*
			 * Initiate another counter
			 * 
			 */
			 
			$c=0;
			
			/*
			 * Loop keys array
			 * 
			 */
			
			while ($c < 2) {
				
				/**
				 * Create another set of arrays using the keys as var tags
				 * 
				 * @param [0] day of the week, [1] = what month, [2] = what year...
				 * 
				 * 
				 */
				
				${$keys[$c]} = array(
				
									date("d",strtotime($dates[$i][$keys[$c].'Date'])), 
		
									date("m",strtotime($dates[$i][$keys[$c].'Date'])), 
						
									date("Y",strtotime($dates[$i][$keys[$c].'Date'])),
							
							);
				
				//Increment the counter
				
				$c++;
			}
			
			/*
			 * Does the start date match any of the current conditions
			 * 
			 */
			
			$s = (($start[1]  == $this->month) && ($start[2] == $this->year) ? $start[0]:NULL);
			
			/*
			 * Does the end date match any of the current conditions
			 * 
			 */
			
						
			$f = ($finish[1]  == $this->month && $finish[2] == $this->year ? $finish[0]:NULL); 
			
			
		/*
		 * Loop the inner marker array, we are dealing with a multidimensional array
		 * 
		 */
						
		
		foreach($markers[$i] as $wday => $val)
		
		
		{
			
			/*
			 * Each day has boolean true - false, we only want true to identify what days are concurrent
			 * 
			 */
			 
			if($val == true)
			
			{
				
				/*
				 * use get_dates func for date range and output as a day..
				 * 
				 */
				
				foreach ($this->get_dates($wday) as $day) 
		
					{
						
						//Format the day var to be usable date again
						
						$d = $day->format("d\n");
						
						/*
						 * We need to run multiple conditions dependant on the type of data we are handling to ensure
						 * 
						 * we output the correct markers and recieve no invalid loops
						 * 
						 * 
						 */
						
						
						if(($d >= $s && $d <= $f ) || ($s == NULL && $f == NULL))
						
						{
							
						
    				
   							$this->days[] =  $d; 
							
							
						} 
						
						elseif($d >= $s && $f == NULL)
						
						{
							
						
    				
   							$this->days[] =  $d; 
							
							
						}
						
				
					}
			
				}
		
			}
		
		}
		
		/*
		 * Return the day markers
		 * 
		 */
		
		return $this->days;
		
	}	
	
	
	/*
	 * Simple function to extract the keys using a slice method
	 * 
	 */
	
	Private function  extract_keys($arr, $start, $offset=NULL)
	
	{
		$ar = array();
		
		foreach($arr as $a)
		
		{
			
			$ar[] = array_slice($a,$start,$offset);
			
		}
		
		return $ar;
		
	}
	
	
	Private function get_dates($day)
	
	{
		
		/**
		 * 
		 *@param day = weekday
		 * 
		 * Function to get the date period from a day, i.e first and last mondays in any given month
		 * 
		 */
		
		return new DatePeriod(
		
        new DateTime("first ".$day." of ".$this->year."-".$this->month.""),
        
        DateInterval::createFromDateString('next '.$day),
        
        new DateTime("last day of ".$this->year."-".$this->month."")
		
    );
	
	}


}