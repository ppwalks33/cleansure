<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    function __construct()
	
    {
    	
        parent::__construct();
		
		$this->load->library('auth');
		
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
	
	
	/*
	 * Return array of errors back to the function 
     * for validation purposes
     *
     * @access public
     *
     * @param String $str
     * @param String $format
     *
     * @return int
     */

    function error_array()
    
    {
        return $this->_error_array; 
    }
	
	/**
     * Verify that a string contains a specified number of
     * uppercase, lowercase, and numbers.
     *
     * @access public
     *
     * @param String $str
     * @param String $format
     *
     * @return int
     */
    public function password_check($str, $format)
	
    {
    	
        $ret = TRUE;

        list($uppercase, $lowercase, $number) = explode(',', $format);
		

        $str_uc = $this->count_uppercase($str);
		
        $str_lc = $this->count_lowercase($str);
		
        $str_num = $this->count_numbers($str);

        if ($str_uc < $uppercase) // lacking uppercase characters
        
        {
        	
            $ret = FALSE;
			
            $this->set_message('password_check', 'Password must contain at least ' . $uppercase . ' uppercase characters.');
			
        }
		
        elseif ($str_lc < $lowercase) // lacking lowercase characters
        
        {
        	
            $ret = FALSE;
			
            $this->set_message('password_check', 'Password must contain at least ' . $lowercase . ' lowercase characters.');
        }
		
        elseif ($str_num < $number) //  lacking numbers
        
        {
        	
            $ret = FALSE;
			
            $this->set_message('password_check', 'Password must contain at least ' . $number . ' numbers characters.');
			
        }

        return $ret;
    }


	Public function folder_password_check($str, $id)
	
	{
		
		if($this->auth->check_folder_password($str, $id) == false)
		
		{
			
		    $this->set_message('folder_password_check', 'Incorrect Password, Please Try Again!');
			
			return false;
		}
		
		return true;
	}

	/*
	 * Check that we have a valid uk postal code
	 * 
	 * Run it through the custom regex
	 * 
	 * May need addressing later if any errors found
	 * 
	 */ 


	Public function postcode_check($string) 
	
	{
		
		$string = trim(str_replace(' ', '', strtoupper($string)));
		
		if (!preg_match('#^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$#', $string) ) 

			{ 
			
                 $this->set_message('postcode_check', 'Please Enter A Valid UK Postcode!..');
				 
				 return false;
	  
			}	
		
		return true;
	}


	/*
	 * Check that we have a valid uk phone number
	 * 
	 * Run it through the custom regex
	 * 
	 * May need addressing later if any errors found, phone numbers in the uik can unpredictable....hmmmmmm!!!!!
	 * 
	 */ 
	
	Public function validate_uk_phone($number) 
	
	{
		
		 $number = str_replace(array('(', ')', ' '), '', $number);
    
    		if(! preg_match('^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$^', $number) )
			
			{
				
				 $this->set_message('validate_uk_phone', 'Please Enter A Valid UK Telephone Number!..');
				 
				 return false;
				
			}
			
			return true;
		
		}
	
	/*
	 * check the email address is not used elsewhere for login
	 * 
	 * It has to check if the email address is currently active 
	 * 
	 */ 
	
	
	Public function email_exists($string) 
	
	{
		

		
		$this->db->select('contact.email_address')
		
				 ->where('user', 1)
				 
				 ->where('email_address', $string)
				 
				 ->from('contact');
				 
		     $q = $this->db->get();
			 
	        if ($q->num_rows() > 0) 
	        
	        {
	        	
				$this->set_message('email_exists','This Email Currently Exists!');
				
				return false;
				
			} else {
				
				return true;
				
			}
				 
				 
	}
	
	
	Public function user_exists($string) 
	
	{
		
		$this->db->select('login.username')
		
				 ->where('username', $string)
				 
				 ->from('login');
			
			 $q = $this->db->get();	 
		
	        if ($q->num_rows() > 0) 
	        
	        {
	        	
				$this->set_message('user_exists', 'This Username Currently Exists!');
				
				return false;
				
			} else {
				
				return true;
				
			}
				 
				 
	}
	


	/*
	 * Private functions below here
	 * 
	 * 
	 */ 

    /**
     * count the number of times an expression appears in a string
     *
     * @access private
     *
     * @param String $str
     * @param String $exp
     *
     * @return int
     */
    private function count_occurrences($str, $exp)
    {
        	
        $match = array();
		
        preg_match_all($exp, $str, $match);

        return count($match[0]);
		
    }

    /**
     * count the number of lowercase characters in a string
     *
     * @access private
     *
     * @param String $str
     *
     * @return int
     */
    private function count_lowercase($str)
	
    {
    	
        return $this->count_occurrences($str, '/[a-z]/');
		
    }

    /**
     * count the number of uppercase characters in a string
     *
     * @access private
     *
     * @param String $str
     *
     * @return int
     */
    private function count_uppercase($str)
	
    {
    	
        return $this->count_occurrences($str, '/[A-Z]/');
		
    }

    /**
     * count the number of numbers characters in a string
     *
     * @access private
     *
     * @param String $str
     *
     * @return int
     */
     
    private function count_numbers($str)
	
    {
    	
        return $this->count_occurrences($str, '/[0-9]/');
		
    }

}
?>