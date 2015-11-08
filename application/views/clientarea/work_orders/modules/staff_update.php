<?php 

	echo "<div class=\"table-responsive\">\n";
  
  		echo "<table class=\"table table-hover\">\n";
  
  		echo "<thead>\n";
  
  		echo "<tr>\n";
  
  					$headers = array('Staff Name', 'Start',  'Finish');
					
					
  
  					for($i=0;$i<count($headers);$i++)
  
  					{
  						
						
  	
								echo "<th>".$headers[$i]."&nbsp;&nbsp;</th>\n";
								
							
	
  					}
					
					
  
  		echo "</tr>\n";
 
        echo "</thead>\n";
		
		echo "<tbody>\n";
		
		if(is_array($staffTimes))
		
		{
		
		foreach($staffTimes as $event)
		
		{
			
			echo "<tr>\n";
			
				echo "<td>".anchor('clientarea/staff/profile/'.$event['staff_id'], $event['first_name']."&nbsp;".$event['last_name'], array('title' => 'Go To '.$event['first_name']."&nbsp;".$event['last_name'].' Profile'))."</td>\n";
			
				echo "<td>".$event['start_time']."</td>\n";
				
				echo "<td>".$event['end_time']."</td>\n";
			
			echo "</tr>\n";
			
		}
		
		}
		
		echo "</tbody>\n";
		
		echo "</table>\n";
		
		echo "</div>\n";
		
	echo "<br>\n";
		
	echo sprintf($this->lang->line('h4'), 'Re-Configure Staff');
	
	$this->load->view($this->data['modules'].'staff_select', array('staff' => $staff));
?>