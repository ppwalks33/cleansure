<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Cleansure Class for Cleansure
 * 
 * Author: Paul Stevenson
 * 
 * Copyright: GoFishwebdesign
 * 
 * Version 1.0
 * 
 */


class Cleansure
{
	 
	public function __construct()
	
	{
		
		$this->lang->load('customer');
		
		$this->lang->load('cleansure');

		$this->load->model('customer_model');

		

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
	
	function get_cords($postcode) 
	
	{
		
		//Connect to Google Maps 
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($postcode) . '&sensor=false';
		
        //Get the Geo Encoding Data back from Google
		$json = json_decode(file_get_contents($url));
		
		
		/*
		 * Check for google status based upon results
		 * 
		 * If we have no results show message to user..
		 * 
		 */
		 
		if($json->status != "ZERO_RESULTS")
		
		{
		
		    return array($json->results[0]->geometry->location->lat, $json->results[0]->geometry->location->lng);
			
		}
		
		else 
		
		{
			
			return 'Invalid Postcode !';
			
		}
		
		
	}
	
	
	 function postcode_lookup($postcode) 

		{
		
		$co_ords = $this->get_cords($postcode);
		
        //Address url to get postal address from Google
		$address_url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $co_ords[0] . ',' . $co_ords[1] . '&sensor=false';
		
        //Decode the json data
		$address_json = json_decode(file_get_contents($address_url));
		
		//Get the address components
		$data = $address_json->results[0]->address_components;
		
		$array = array('street' => $data[1]->long_name, 'town' => $data[2]->long_name, 'county' => $data[3]->long_name);

		return $array;	
			
}
	

		function lang_header($string, $key, $id=NULL)
	
		{
		
			if($id == NULL)
			
			{
			
					return sprintf($this->lang->line($key), $string);
					
			}
			
			else 
			
			{
				
				
				if(is_array($string))
				
				{
					
										
					return $this->sprintf_assoc( $this->lang->line($key) ,$string);
					
				}
				
				else 
				
				{
					
					return sprintf($this->lang->line($key), $id, $string);
					
				}
				
				
				
			}
			
		}
		
	/**
	 * If we need to send many params to the lang line func
	 * 
	 * @param string = str
	 * 
	 * @param replacement_vars = array
	 * 
	 * @param prefix = wrapper chars
	 * 
	 */	
	 
	Private	function sprintf_assoc( $string = '', $replacement_vars = array(), $prefix_character = '%' ) 
	
	{
					
			if ( ! $string ) return '';
			
				if ( is_array( $replacement_vars ) && count( $replacement_vars ) > 0 ) {
							
					foreach ( $replacement_vars as $key => $value ) {
								
							$string = str_replace( $prefix_character.$key.$prefix_character , $value, $string );
				
						}
				}

		return $string;
}
		
}
