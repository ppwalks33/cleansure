<?php 

/*
 * 
 * Array Helpers
 * 
 * 
 */ 

// Function to sort table data into multi-demnsional array to sort data for looping
	
	function arraySort($input,$sortkey)
	
	{
		$output = "";
		
  		foreach ($input as $key=>$val)  $output[$val[$sortkey]][]=$val;
		
  			return   $output;   
	}
	
/**
 * @param array      $array
 * @param int|string $position
 * @param mixed      $insert
 */
function array_insert(&$array, $position, $insert)

{
	
    if (is_int($position)) {
    	
        array_splice($array, $position, 0, $insert);
		
    } else {
    	
        $pos   = array_search($position, array_keys($array));
		
        $array = array_merge(
        
            array_slice($array, 0, $pos),
            
            $insert,
            
            array_slice($array, $pos)
        );
    }
}

/*
 * Javascript helpers
 * 
 */ 
	
	function javaScript($script=array())
	
	{
		
		$r="";
		
		foreach($script as $s)
		
		{
			
			$r .= "<script src=\"/js/".$s.".js\" type=\"text/javascript\"></script>\n";
		}
		
		return $r;
	}
	
	//Form error name sanitiation for loop
	
	function error_name($string)
	
	{
		
		$string = str_replace('_', ' ', $string);
		
		$string = str_replace('[]', ' ', $string);
		
		return ucwords($string);
		
	}
	
	//Function to create unique refernece throughout the system
	function createReference($ref, $id)
	
	{
		
		if(!empty($ref)) 
		
		{
		//Explode the name	
		$name = explode(' ', $ref);
		
		//Count the array to see how long the name is;
		$count = count ($name)-1;	
		
		
		
			//Declare the variiable
	 		$t = ''; 	
	  		 //loop through and get each letter..
				for ($i = 0; $i < $count; $i++) 	
				{
					//Build the first part
				 $t .= $name[$i][0];
				}	
			//Create the reference from returned ids and first letters, then add to array
			return  '#'.strtoupper($t).'#0'.$id;
			
		}
	}
	
	/*
	 * Use this helper to format date in view where
	 * 
	 * ever needed...
	 */
	
	function format_date($date) 
	
	{
		
		 $Newdate = new DateTime($date);
          
         return $Newdate->format('d/m/Y');
		
	}
	
	function insert_date($date)
	
	{
		
		$Newdate = new DateTime($date);
          
         return $Newdate->format('Y/m/d');
	}
	
	function remove_time($date) 
	
	{
		
		$Newdate = new DateTime($date);
          
         return $Newdate->format('m/d/Y');
	}
	
	function decVal($val)
	
	{
		
		if(is_numeric($val))
		
		{
			
			return floatval($val);
			
		}
		
		else 
		
		{
			
			return true;
			
		}
	}
	
	
	/*
	 * Private function to remove punctuation
	 * 
	 */
	
	function remove_punctuation($string)
	
	{
		
		 return preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($string));
	}
	
	/*
	 * Create an auto span function
	 * 
	 */
	
	function span($glyph)
	
	{
		//return the str for the glyph..
		return '<span class="glyphicon glyphicon-'.$glyph.'"></span>';
	}
	
	
	?>