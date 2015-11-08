<?php

	 $atts = array(
	 
	 				array('name' => 'labour_hours', 'class' => 'form-control', 'placeholder' => 'Labour Hours...', 'value' => (isset($row_data) ? $row_data->labour_hours:NULL)),
	 				
	 				
					array('name' => 'labour_cost', 'class' => 'form-control', 'placeholder' => 'Labour Costs...' , 'value' => (isset($row_data) ? $row_data->labour_cost:NULL)),
					
					
					array('name' => 'material_cost', 'class' => 'form-control', 'placeholder' => 'Materials Costs...' , 'value' => (isset($row_data) ? $row_data->material_cost:NULL)),
					
					
					array('name' => 'machine_cost', 'class' => 'form-control', 'placeholder' => 'Machine Costs...' , 'value' => (isset($row_data) ? $row_data->machine_cost:NULL)),
					
					
					array('name' => 'total_cost', 'class' => 'form-control', 'placeholder' => 'Total Costs...' , 'value' => (isset($row_data) ? $row_data->total_cost:NULL)),
					
					
					array('name' => 'invoice_number', 'class' => 'form-control', 'placeholder' => 'Invoice Number...' , 'value' => (isset($row_data) ? $row_data->invoice_number:NULL)),
	 
	 );
	 
	 echo "<div class=\"row\">\n";
	 
	 echo "<div class=\"col-xs-12 col-lg-12\">\n";
	 
	
	 
	 	for($i=0;$i<count($atts);$i++)
		
		{
			$n = $i+1;
			
			echo "<div class=\"col-xs-12 col-lg-6\">\n";
			
			   if(isset($row_data))
			   
			   {
			   	
				echo form_label(str_replace('_', ' ', ucwords($atts[$i]['name'])), $atts[$i]['name']);
				
			   }
			   
			   echo form_input($atts[$i]);
			
			
			echo "</div>\n";
			
			if ($n % 2 === 0)
			
			{
				
				echo "<br style=\"clear:both\"><br>\n";
			}
			
		}
		
		echo "</div>\n";
	 
	   echo "</div>\n";

?>