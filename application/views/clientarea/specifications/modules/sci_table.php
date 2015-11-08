<?php 
		$spiForm = array(
	
						array('class' => $class, 'name' => 'floor_type', 'placeholder' => 'Floor Type...'),
						
						array('class' => $class, 'name' => 'length', 'placeholder' => 'Length...'),
						
						array('class' => $class, 'name' => 'width', 'placeholder' => 'Width...'),
						
						array('class' => $class, 'name' => 'sqr_metre', 'placeholder' => 'Manual Area (Metre Squared)...'),
						
						array('class' => $class, 'name' => 'height', 'placeholder' => 'Height (Metre\'s)...'),
						
						array('class' => $class, 'name' => 'shape', 'placeholder' => 'Shape...'),
						
						array('class' => $class, 'name' => 'stairway_name', 'placeholder' => 'Enter Stairway Name...'),
						
						array('class' => $class, 'name' => 'no_stair_treds', 'placeholder' => 'Number of Stair Treds...'),
						
						array('class' => $class, 'name' => 'no_cubicals', 'placeholder' => 'Number of Cubicles...'),
						
						array('class' => $class, 'name' => 'no_urinals', 'placeholder' => 'Number of Urinals..'),
						
						array('class' => $class, 'name' => 'no_sinks', 'placeholder' => 'Number of Sinks...'),
						
						array('class' => $class, 'name' => 'mirror_area', 'placeholder' => 'Mirror Area (Metre Squared)...'),
						
						array('class' => $class, 'name' => 'message', 'placeholder' => 'Additional Information...'),
						
	
	);
	
	$headers = array('Floor Information', 'Room Information', 'Room Density', 'Stairway Information', 'Toilet Details?', 'Additonal Requirements');
	
	$count = count($spiForm) - 1;
	
	
	for($i=$n=0;$i<$count;$i++)
	
	{
		
		
		echo ($i==8 ? '<div id="toilets">':NULL);
		
				
		if($i==0 || $i==4 || $i==6 || $i==8)
		
		{
			
			echo sprintf($this->lang->line('h4'), $headers[$n]);
			
			$n++;
			
		}
		
		   if($i==6) 
		
		           {
			
		             echo form_dropdown('density', $density, '' , "class='".$class." density'")."\n";
					 
					 echo "<br>\n<br>\n";
					 
					 echo sprintf($this->lang->line('h4'), $headers[$n]);
		
		             echo "<br>\n";
					 
					 $n++;
			
		          }
		
		echo form_input($spiForm[$i])."\n";
		
		echo "<br>\n";
		
		
		echo ($i==11 ? '</div>':NULL);
		
	}

		
		echo sprintf($this->lang->line('h4'), $headers[5]);
		
		echo form_textarea($spiForm[12]);
    
 
 ?>
 
 