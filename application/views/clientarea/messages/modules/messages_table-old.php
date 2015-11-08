
<?php

if(is_array($messages))

{
	
	echo "<div class=\"table-responsive\">\n";
  
  		echo "<table class=\"table\">\n";
  
  		echo "<thead>\n";
  
  		echo "<tr>\n";
  
  					$headers = array('Title', 'Date');
					
					if(isset($messages[0]['status']))
					
					{
						
					
						
						$hdrs = array_push($headers, 'From', 'Status','Actions');
						
								
					}
					
					else
						
					 {
					 	
						$hdrs = array_push($headers, 'To', 'Actions');		
						
					}
  
  					for($i=0;$i<count($headers);$i++)
  
  					{
  						
						
  	
								echo "<th>".$headers[$i]."&nbsp;&nbsp;</th>\n";
								
							
	
  					}
					
					
  
  		echo "</tr>\n";
 
        echo "</thead>\n";
		
		echo "<tbody>\n";
		
			foreach ($messages as $key => $m)
			
			{
				
				echo "<tr id=\"".$m['mess_id']."\" ".(isset($m['status']) && $m['status'] == 1 ? 'class="warning"':NULL).">\n";
				
				echo "<td>\n";
				
					echo "<p>".anchor('clientarea/messages/read/'.$m['mess_id'].'/'.(isset($messages[0]['status']) ? false:true),$m['message_title'], array('title' => 'Read Message', 'data-title' => 'Message', 'data-action' => false, 'data-glyph' => 'envelope'))."</p>";
				
				echo "</td>\n";
				
				echo "<td>\n";
				
				echo format_date($m['date']);
				
				echo "</td>\n";
				
							echo "<td>\n";
				
							echo ucwords($m['title'].'&nbsp;'.$m['first_name'].'&nbsp;'.$m['last_name']);
				
							echo "</td>\n";
							
							if(isset($messages[0]['status']))
					
								{
						
				
							echo "<td>\n";
				
							if($m['status'] == 1)
					
								{
						
									echo "<p>Unread</p>\n";
						
								}
					
									else 
					
								{
						
									echo "<p>Read</p>\n";
								
								}
				
									
									echo "</td>\n";
				
								}
				
									echo "<td>\n";
									
				
											echo anchor('clientarea/messages/delete/'.$m['mess_id'].'/'.(isset($m['inbox']) ? 1:(isset($m['sent']) ? 2:NULL)), 'Delete', array('title' => 'Delete Message', 'class' => 'delete btn btn-danger', 'data-id' => $m['mess_id']));
											
				
									echo "</td>\n";
									
				
									echo "</tr>\n";
				
					}
		
		echo "</tbody>\n";
		
		echo "</table>\n";
		
		 echo "</div>\n";
		 
		 }

		else
			
			{
				
				echo sprintf($this->lang->line('h4'), 'No Messages!');
			}

?>