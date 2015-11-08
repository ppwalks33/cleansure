<?php

	$days = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');	 
					
					for($i=0;$i<7;$i++)
					
					{
						
						$day = strtolower($days[$i]);
					
						echo form_hidden($days[$i], (int)FALSE);
						
						echo "<label class=\"checkbox-inline padRight\">\n";
						
						echo form_checkbox($days[$i], TRUE, (isset($row_data) ? $row_data->$day:NULL)).$days[$i]."\n";
						
						echo "</label>\n";
						
		
						
					}

?>