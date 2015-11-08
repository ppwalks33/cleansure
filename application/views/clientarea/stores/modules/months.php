<?php

	$months = array('January','Febuary','March','April','May','June','July','August','September','October','November','December');	 
					
					for($m=0;$m<12;$m++)
					
					{
						
						$mon = strtolower($months[$m]);
					
						echo form_hidden($mon, (int)FALSE);
						
						echo "<label class=\"checkbox-inline padRight\">\n";
						
						echo form_checkbox($mon, TRUE, (isset($row_data) ? $row_data->$mon:NULL)).$months[$m]."\n";
						
						echo "</label>\n";
						
		
						
					}

?>