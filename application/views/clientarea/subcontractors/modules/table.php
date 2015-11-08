<?php

if(is_array($sc))

{

 echo "<div class=\"table-responsive\">\n";
  
  		echo "<table class=\"table table-hover\">\n";
  
  		echo "<thead>\n";
  
  		echo "<tr>\n";
  
  					$headers = array('Company Name',  'Company Type', 'Name', 'Address', 'Scheduals', 'Sites', 'Actions');
					
					
  
  					for($i=0;$i<count($headers);$i++)
  
  					{
  						
						
  	
								echo "<th>".$headers[$i]."&nbsp;&nbsp;</th>\n";
								
							
	
  					}
					
					
  
  		echo "</tr>\n";
 
        echo "</thead>\n";
		
		echo "<tbody>\n";
		
		foreach($sc as $c)
		
		{
			
			echo "<tr>\n";
			
				echo "<td><span class=\"glyphicon glyphicon-user popup\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"&raquo;&nbsp;&nbsp;Contact Information\" 
                  		
                  			data-content=\"
                  		
                  						<p>"; 
                  							
                  							
                  			?>
                  							
                  			<?php
                  						
                  						$atts = array('daytime_telephone', 'evening_telephone', 'mobile_telephone', 'fax_number', 'email_address');
								
										
										foreach ($atts as $a)
										
										{
											$label = explode('_', $a);
											
											echo (!empty($c->$a) && $c->$a != false ? ucwords($label[0]).': '.$c->$a.'<br>':NULL); 
											
											if($a == 'fax_number') echo "<br>\n";
											
										}
                  					
                  					 ?>
                  					</p>">
                  					
                  	</span>
                  	
                  <?php
                  	
                echo "&nbsp;&nbsp;".$c->company_name."</td>\n";
				
				echo "<td>".$c->company_type."</td>\n";	
				
				echo "<td>".$c->first_name."&nbsp;".$c->last_name."</td>\n";
				
				echo "<td>\n";
				
				foreach($addressfields as $af)
				
				{
                
                		 
					 echo ($c->$af != false ? $c->$af."<br>":NULL);
                		  	  
				
				}
				
				echo "</td>\n";
				
				?>
				
				<td>
                  	
                  		<?php 
                  		
                  				echo anchor('clientarea/schedules/subcontractors/'.date('Y').'/'.date('m').'/'.$c->staff_id, 
                  		
                  						    '<span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;View Schedules',										   
										   
										     array('title' => 'View '.$c->first_name.'&nbsp;'.$c->last_name.' Schedule')
											 
											 );
										   
						?>
                  	
                  	</td>
				
				  <td> 
                  	
                  	<?php if($c->staffIds > 0): ?>
                  	
                  	<span class="label label-default"><?php echo ($c->staffIds > 0 ? $c->staffIds:'0'); ?></span>
                  	
                  	<?php echo anchor('clientarea/staff/view_sites/'.$c->staff_id, 
                  	
                  					  '<span>&nbsp;&nbsp;View Sites</span>', 
                  					                 					  
                  					  array('title' => 'View Staff Sites', 'data-title' => 'View Staff Sites', 'class' => 'trigger', 'data-action' => false)
                  					  
									  ); 
									  
					else:
						
						
						echo "<span>N/A</span>\n";
					
					
					endif;
					
					?>
                  	
                  	
                  </td>
                  
                  
				
				
				<?php
				
				echo "<td></td>\n";			
			
			echo "<tr>\n";
			
		}
		
		
		echo "</tbody>\n";
		
		echo "</table>\n";
		
		echo "</div>\n";
		
		}

			else
				
		{
			
			// echo sprintf($this->lang->line('h2'), 'You Currently have No Subcontractors In the System');
			
			echo '<div class="clearfix visible-xs-block"></div>';
			echo '<h3 class="tab-body-title">You Currently have No Subcontractors In the System</h3>';
			
			echo "<p>Please click <strong>New Subcontractor</strong> button above to get started.</p>\n";
			
			
		}
		
		?> 