<?php

	$months = array('First Week','Second Week','Third Week','Last Week','Weekly','Fortnightly');	 
					
					for($m=0;$m<6;$m++)
					
					{
						
						$mon = str_replace(' ', '_',strtolower($months[$m]));
					
						echo form_hidden($mon, (int)FALSE);
						
						echo "<label class=\"checkbox-inline padRight\">\n";
						
						echo form_checkbox($mon, TRUE, (isset($row_data) ? $row_data->$mon:NULL)).$months[$m]."\n";
						
						echo "</label>\n";
						
		
						
					}

?>