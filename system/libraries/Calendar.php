<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// ------------------------------------------------------------------------

/**
 * CodeIgniter Calendar Class
 *
 * This class enables the creation of calendars
 *
 * @package		Cleansure
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Paul Stevenson
 */
class CI_Calendar {

	var $CI;
	var $lang;
	var $local_time;
	var $template		= '';
	var $start_day		= 'sunday';
	var $month_type		= 'long';
	var $day_type		= 'abr';
	var $show_next_prev	= FALSE;
	var $next_prev_url	= '';
	var $staff_id  = '';

	/**
	 * Constructor
	 *
	 * Loads the calendar language file and sets the default time reference
	 */
	public function __construct($config = array())
	{
		$this->CI =& get_instance();

		if ( ! in_array('calendar_lang.php', $this->CI->lang->is_loaded, TRUE))
		{
			$this->CI->lang->load('calendar');
		}

		$this->local_time = time();

		if (count($config) > 0)
		{
			$this->initialize($config);
		}

		log_message('debug', "Calendar Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize the user preferences
	 *
	 * Accepts an associative array as input, containing display preferences
	 *
	 * @access	public
	 * @param	array	config preferences
	 * @return	void
	 */
	function initialize($config = array())
	{
		
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Generate the calendar
	 *
	 * @access	public
	 * @param	integer	the year
	 * @param	integer	the month
	 * @param	array	the data to be shown in the calendar cells
	 * @return	string
	 */
	function generate($year = '', $month = '', $data = array())
	{
		
		// Set and validate the supplied month/year
		if ($year == '')
			$year  = date("Y", $this->local_time);

		if ($month == '')
			$month = date("m", $this->local_time);

		if (strlen($year) == 1)
			$year = '200'.$year;

		if (strlen($year) == 2)
			$year = '20'.$year;

		if (strlen($month) == 1)
			$month = '0'.$month;

		$adjusted_date = $this->adjust_date($month, $year);

		$month	= $adjusted_date['month'];
		$year	= $adjusted_date['year'];

		// Determine the total days in the month
		$total_days = $this->get_total_days($month, $year);

		// Set the starting day of the week
		$start_days	= array('sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6);
		$start_day = ( ! isset($start_days[$this->start_day])) ? 0 : $start_days[$this->start_day];

		// Set the starting day number
		$local_date = mktime(12, 0, 0, $month, 1, $year);
		$date = getdate($local_date);
		$day  = $start_day + 1 - $date["wday"];

		while ($day > 1)
		{
			$day -= 7;
		}

		// Set the current month/year/day
		// We use this to determine the "today" date
		$cur_year	= date("Y", $this->local_time);
		$cur_month	= date("m", $this->local_time);
		$cur_day	= date("j", $this->local_time);

		$is_current_month = ($cur_year == $year AND $cur_month == $month) ? TRUE : FALSE;

		// Generate the template data array
		$this->parse_template();

		// Begin building the calendar output
		$out = $this->temp['table_open'];
		$out .= "\n";

		$out .= "\n";
		$out .= $this->temp['heading_row_start'];
		$out .= "\n";

		// "previous" month link
		if ($this->show_next_prev == TRUE)
		{
			// Add a trailing slash to the  URL if needed
			$this->next_prev_url = preg_replace("/(.+?)\/*$/", "\\1/",  $this->next_prev_url);

			$adjusted_date = $this->adjust_date($month - 1, $year);
			$out .= str_replace('{previous_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'].'/'.($this->staff_id != '' ? $this->staff_id:NULL), $this->temp['heading_previous_cell']);
			$out .= "\n";
		}

		// Heading containing the month/year
		$colspan = ($this->show_next_prev == TRUE) ? 5 : 7;

		$this->temp['heading_title_cell'] = str_replace('{colspan}', $colspan, $this->temp['heading_title_cell']);
		$this->temp['heading_title_cell'] = str_replace('{heading}', $this->get_month_name($month)."&nbsp;(".$year.")",$this->temp['heading_title_cell']);

		$out .= $this->temp['heading_title_cell'];
		$out .= "\n";

		// "next" month link
		if ($this->show_next_prev == TRUE)
		{
			$adjusted_date = $this->adjust_date($month + 1, $year);
			$out .= str_replace('{next_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'].'/'.($this->staff_id != '' ? $this->staff_id:NULL), $this->temp['heading_next_cell']);
		}

		$out .= "\n";
		$out .= $this->temp['heading_row_end'];
		$out .= "\n";

		// Write the cells containing the days of the week
		$out .= "\n";
		$out .= $this->temp['week_row_start'];
		$out .= "\n";

		$day_names = $this->get_day_names();

		for ($i = 0; $i < 7; $i ++)
		{
			$out .= str_replace('{week_day}', $day_names[($start_day + $i) %7], $this->temp['week_day_cell']);
		}

		$out .= "\n";
		$out .= $this->temp['week_row_end'];
		$out .= "\n";

		// Build the main body of the calendar
		while ($day <= $total_days)
		{
			$out .= "\n";
			$out .= $this->temp['cal_row_start'];
			$out .= "\n";

			for ($i = 0; $i < 7; $i++)
			{
				$out .= ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_start_today'] : $this->temp['cal_cell_start'];

				if ($day > 0 AND $day <= $total_days)
				{
					
					

					if (isset($data[$day]))
					{
											// Cells with content
						$temp = ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_content_today'] : $this->temp['cal_cell_content'];
						$out .= str_replace('{day}',$this->addOrdinalNumberSuffix($day), str_replace('{content}', $data[$day], $temp));
					}
					else
					{
						// Cells with no content
						$temp = ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_no_content_today'] : $this->temp['cal_cell_no_content'];
						$out .= str_replace('{day}', $this->addOrdinalNumberSuffix($day), $temp);
					}
				}
				else
				{
					// Blank cells
					$out .= $this->temp['cal_cell_blank'];
				}

				$out .= ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_end_today'] : $this->temp['cal_cell_end'];					
				$day++;
			}

			$out .= "\n";
			$out .= $this->temp['cal_row_end'];
			$out .= "\n";
		}

		$out .= "\n";
		$out .= $this->temp['table_close'];

		return $out;
	}

	// --------------------------------------------------------------------

	/**
	 * Get Month Name
	 *
	 * Generates a textual month name based on the numeric
	 * month provided.
	 *
	 * @access	public
	 * @param	integer	the month
	 * @return	string
	 */
	function get_month_name($month)
	{
		if ($this->month_type == 'short')
		{
			$month_names = array('01' => 'cal_jan', '02' => 'cal_feb', '03' => 'cal_mar', '04' => 'cal_apr', '05' => 'cal_may', '06' => 'cal_jun', '07' => 'cal_jul', '08' => 'cal_aug', '09' => 'cal_sep', '10' => 'cal_oct', '11' => 'cal_nov', '12' => 'cal_dec');
		}
		else
		{
			$month_names = array('01' => 'cal_january', '02' => 'cal_february', '03' => 'cal_march', '04' => 'cal_april', '05' => 'cal_mayl', '06' => 'cal_june', '07' => 'cal_july', '08' => 'cal_august', '09' => 'cal_september', '10' => 'cal_october', '11' => 'cal_november', '12' => 'cal_december');
		}

		$month = $month_names[$month];

		if ($this->CI->lang->line($month) === FALSE)
		{
			return ucfirst(str_replace('cal_', '', $month));
		}

		return $this->CI->lang->line($month);
	}

	// --------------------------------------------------------------------

	/**
	 * Get Day Names
	 *
	 * Returns an array of day names (Sunday, Monday, etc.) based
	 * on the type.  Options: long, short, abrev
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */
	function get_day_names($day_type = '')
	{
		if ($day_type != '')
			$this->day_type = $day_type;

		if ($this->day_type == 'long')
		{
			$day_names = array(
			
			'sun<span class="hidden-xs">day</span>',
			
			'mon<span class="hidden-xs">day</span>',
			
			'tue<span class="hidden-xs">sday</span>',
			
			'wed<span class="hidden-xs">nesday</span>',
			
			'thu<span class="hidden-xs">rsday</span>',
			
			'fri<span class="hidden-xs">day</span>',
			
			'sat<span class="hidden-xs">urday</span>');
		}
		elseif ($this->day_type == 'short')
		{
			$day_names = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
		}
		else
		{
			$day_names = array('su', 'mo', 'tu', 'we', 'th', 'fr', 'sa');
		}

		$days = array();
		foreach ($day_names as $val)
		{
			$days[] = ($this->CI->lang->line('cal_'.$val) === FALSE) ? ucfirst($val) : $this->CI->lang->line('cal_'.$val);
		}

		return $days;
	}
	
	
	
	function addOrdinalNumberSuffix($num) 
	 
	 {
    		
  		 	if (!in_array(($num % 100),array(11,12,13))){
      			
    			  switch ($num % 10) {
       		
					 // Handle 1st, 2nd, 3rd
        
        				case 1:  return $num.'<sup>st</sup>';
        
        				case 2:  return $num.'<sup>nd</sup>';
       
	   					case 3:  return $num.'<sup>rd</sup>';
     		 }
    }
    return $num.'<sup>th</sup>';
  }

	// --------------------------------------------------------------------

	/**
	 * Adjust Date
	 *
	 * This function makes sure that we have a valid month/year.
	 * For example, if you submit 13 as the month, the year will
	 * increment and the month will become January.
	 *
	 * @access	public
	 * @param	integer	the month
	 * @param	integer	the year
	 * @return	array
	 */
	function adjust_date($month, $year)
	{
		$date = array();

		$date['month']	= $month;
		$date['year']	= $year;

		while ($date['month'] > 12)
		{
			$date['month'] -= 12;
			$date['year']++;
		}

		while ($date['month'] <= 0)
		{
			$date['month'] += 12;
			$date['year']--;
		}

		if (strlen($date['month']) == 1)
		{
			$date['month'] = '0'.$date['month'];
		}

		return $date;
	}

	// --------------------------------------------------------------------

	/**
	 * Total days in a given month
	 *
	 * @access	public
	 * @param	integer	the month
	 * @param	integer	the year
	 * @return	integer
	 */
	function get_total_days($month, $year)
	{
		$days_in_month	= array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

		if ($month < 1 OR $month > 12)
		{
			return 0;
		}

		// Is the year a leap year?
		if ($month == 2)
		{
			if ($year % 400 == 0 OR ($year % 4 == 0 AND $year % 100 != 0))
			{
				return 29;
			}
		}

		return $days_in_month[$month - 1];
	}

	// --------------------------------------------------------------------

	/**
	 * Set Default Template Data
	 *
	 * This is used in the event that the user has not created their own template
	 *
	 * @access	public
	 * @return array
	 */
	function default_template()
	{
		return  array (
						'table_open'				=> '<div class="table-responsive"><table class="table table-striped">',
						'heading_row_start'			=> '<tr>',
						'heading_previous_cell'		=> '<th class="calendar-controls"><a href="{previous_url}" class="btn calendar-controls"><i class="fa fa-arrow-left"></i></a></th>',
						'heading_title_cell'		=> '<th class="calendar-main-date" colspan="{colspan}"><h3 class="month-title">{heading}</h3></th>',
						'heading_next_cell'			=> '<th class="calendar-controls"><a href="{next_url}" class="btn pull-right calendar-controls"><i class="fa fa-arrow-right"></i></a></th>',
						'heading_row_end'			=> '</tr>',
						'week_row_start'			=> '<tr>',
						'week_day_cell'				=> '<td class="td weekdays">{week_day}</td>',
						'week_row_end'				=> '</tr>',
						'cal_row_start'				=> '<tr>',
						'cal_cell_start'			=> '<td class="td days">',
						'cal_cell_start_today'		=> '<td class="td days">',
						'cal_cell_content'			=> '<span class="badge calendar"><p>{day} {content}</p></span>',
						'cal_cell_content_today'	=> '<p><strong>{day}</strong> {content}</p>',
						'cal_cell_no_content'		=> '<p>{day}</p>',
						'cal_cell_no_content_today'	=> '<span class="badge calendar today"><p><strong>{day}</p></strong>',
						'cal_cell_blank'			=> '&nbsp;',
						'cal_cell_end'				=> '</td>',
						'cal_cell_end_today'		=> '</td>',
						'cal_row_end'				=> '</tr>',
						'table_close'				=> '</table></div>'
					);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse Template
	 *
	 * Harvests the data within the template {pseudo-variables}
	 * used to display the calendar
	 *
	 * @access	public
	 * @return	void
	 */
	function parse_template()
	{
		$this->temp = $this->default_template();

		if ($this->template == '')
		{
			return;
		}

		$today = array('cal_cell_start_today', 'cal_cell_content_today', 'cal_cell_no_content_today', 'cal_cell_end_today');

		foreach (array('table_open', 'table_close', 'heading_row_start', 'heading_previous_cell', 'heading_title_cell', 'heading_next_cell', 'heading_row_end', 'week_row_start', 'week_day_cell', 'week_row_end', 'cal_row_start', 'cal_cell_start', 'cal_cell_content', 'cal_cell_no_content',  'cal_cell_blank', 'cal_cell_end', 'cal_row_end', 'cal_cell_start_today', 'cal_cell_content_today', 'cal_cell_no_content_today', 'cal_cell_end_today') as $val)
		{
			if (preg_match("/\{".$val."\}(.*?)\{\/".$val."\}/si", $this->template, $match))
			{
				$this->temp[$val] = $match['1'];
			}
			else
			{
				if (in_array($val, $today, TRUE))
				{
					$this->temp[$val] = $this->temp[str_replace('_today', '', $val)];
				}
			}
		}
	}
	
	
	 

}

// END CI_Calendar class

/* End of file Calendar.php */
/* Location: ./system/libraries/Calendar.php */