 <?php 
		$atts = array(
		
						array('dermatitis', 'health', 'disabilities'),
		
						array('class' => $class, 'rows' => 2, 'name' => 'notes_health', 'value' => (isset($row_data) ? $row_data->notes_health : NULL) , 'disabled' => ''),
						
						array('class' => $class, 'rows' => 2, 'name' => 'notes_dis', 'value' => (isset($row_data) ? $row_data->notes_dis : NULL) , 'disabled' => '')
						
						);
		
		for($i=0;$i<3;$i++)
		
		{
			
			if(isset($row_data) && $i > 0)
			
			{
				
				$atts[$i] = array_slice($atts[$i], 0, -1);
			}
			
			echo form_hidden($atts[0][$i], 0);
			
			echo "<label class=\"checkbox\">\n";
			
			echo form_checkbox($atts[0][$i], 1, (isset($row_data) ? $row_data->$atts[0][$i]:false)).$this->lang->line($atts[0][$i])."\n";
			
			echo "</label>\n";
			
			echo "<br>\n";
			
			echo ($i>0 ? "<div class=\"notes".$i."\">" : NULL);
			
			echo ($i>0 && $i<2 ? form_textarea($atts[1])."\n" : ($i==2 ? form_textarea($atts[2]):NULL));
			
			echo ($i>0 ?"</div>":NULL);
			
			echo "<br>\n";
					
		}
		
		    echo "<br>";
		
 		?>
       
        
        
     