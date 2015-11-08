<?php	

       if(isset($row_data) && is_object($row_data)) 
	   
	   {
	   	
		$d_b = explode('/', format_date($row_data->date));
		
	   }
	   

	$fields = array('day', 'month', 'year');
	
	$i=0;
				
		foreach($fields as $f) 
				
				{
					
				echo "<div class=\"col-lg-4\">\n";
					
				echo form_label(ucwords($f), 'dob');
					
				echo form_dropdown('dob[]', ${$f} ,(isset($d_b) && is_array($d_b) ? $d_b[$i]-1:NULL), "class='".$class."'", ($f == 'year' ? TRUE:FALSE))."\n"; 
					
				echo "</div>\n";
				
			$i++;
					
				}
				
			  
			  echo form_error('dob[]');
			  
			  ?>