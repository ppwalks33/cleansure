	<?php 
              	
              	$fields = array('serial', 'log_num'); 
              	
              	foreach ($machinery as $key => $value) 
              	
              	{  
              		
				echo "<tr>\n";
					
				for($i=0;$i<2;$i++)	
				
				{	
					echo "<td>\n".anchor('clientarea/machinery/profile/'.$value->mach_id, $value->$fields[$i], array('title' => 'View Machinery Profile')).
					
									"\n &nbsp;&nbsp;\n"
									
								 .anchor('clientarea/machinery/profile/'.$value->mach_id, '<span class="glyphicon glyphicon-share-alt"></span>', array('title' => 'View Machinery Profile'))."\n</td>\n";
						
					
				}
				
					echo "<td>\n ".$value->type."&nbsp;(".$value->identifier.") </td>\n";
					
					echo "<td style='font-weight:bold;'>".(!empty($value->staff_id) ? '<span class="allocated">Staff Allocated</span>':(!empty($value->customer_id) ? '<span class="allocatedCustomer">Customer Allocated</span>':'<span class="available">Available</span>') )."</td>\n";
					
					echo "<td>\n".($value->desc != '' ? 
					
								anchor('#', '<span class="fa fa-eye"></span> View Description', array('class' => 'popup', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-content' => '<p>'.$value->desc.'</p>'))
								
								:
								
								'<span class="glyphicon glyphicon-remove cross"></span>&nbsp;N/A')."</td>\n";
								 
					echo "<td><span class=\"glyphicon glyphicon-time\"></span>&nbsp;&nbsp;".format_date($value->aquire_date)."</td>\n";
					
					echo "<td>".($value->second_hand == false ? '<span class="glyphicon glyphicon-ok positive tick"></span> Yes':'<span class="glyphicon glyphicon-remove cross"></span> N/A')."</td>";
					
					echo "<td>".($value->appearance == false ? '<span class="glyphicon glyphicon-ok positive tick"></span> Yes':'<span class="glyphicon glyphicon-remove cross"></span> N/A')."</td>";
					
					echo "<td>".($value->age != '' ? $value->age :$this->lang->line('spanNeg'))."</td>";
					
					echo "<td>".($value->appearance == false ? '<span class="glyphicon glyphicon-ok positive tick"></span> Yes':'<span class="glyphicon glyphicon-remove cross"></span> N/A')."</td>";
					
					echo "<td>".($value->p_date == false ? '<span class="glyphicon glyphicon-remove cross"></span> N/A' : '<span class="glyphicon glyphicon-time"></span> '.format_date($value->p_date))."</td>";
					
					echo "<td>".anchor('clientarea/machinery/profile/'.$value->mach_id, '<span class="glyphicon glyphicon-user"></span> Edit Machinery Profile', array('title' => 'View Machinery Profile', 'class' => 'btn btn-success btn-xs blockBtn actionBtn'))."\n</td>\n";
					
					echo "</tr>\n";
              		
					
				}

             ?>