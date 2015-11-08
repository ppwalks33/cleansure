<?php

	$atts = array(
	
				array('class' => $class, 'name' => 'doctors_name', 'placeholder' => 'Doctors Name...', 'value' => (isset($row_data) ? $row_data->doctors_name:NULL), 'disabled' => ''),
						
				array('class' => $class, 'name' => 'daytime_telephone', 'placeholder' => 'Surgery Number...', 'value' => (isset($row_data) ? $row_data->daytime_telephone:NULL), 'disabled' => ''),
						
				array('class' => $class, 'name' => 'evening_telephone', 'placeholder' => 'Emergency Number...', 'value' => (isset($row_data) ? $row_data->evening_telephone:NULL), 'disabled' => ''),
				
				);
				
	

	echo "<label class=\"checkbox\">\n";
		
		echo form_checkbox('contact_doc', 1, (isset($row_data) ? $row_data->contact_doc:false)).$this->lang->line('contact_doc')."\n";
		
		echo "</label>\n";
		
		echo "<br>\n";
		
		echo "<div class=\"medical-data\">\n";
		
		for($i=0;$i<3;$i++)
		
		{
			
			if(isset($row_data)) {
		
					$atts[$i] = array_slice($atts[$i],0,-1);
		
				}
			
		   			echo form_input($atts[$i])."\n<br>\n";
		
		}
		
		echo "</div>\n";
		

 ?>