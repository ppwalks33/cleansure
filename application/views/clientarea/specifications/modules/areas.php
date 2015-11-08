<?php /*
<div class="panel panel-default">
  	
   <?php  echo sprintf($this->lang->line('panel_heading'), 'Specification of Work Details'); ?>
   
    <div id="c" class=" ">
    	
      <div class="panel-body">
*/

?>
      	
        <div class="table-responsive customers">
        	
            <table class="table table-striped table-hover" id="spec_table">
            	
              <thead>
              	
                <tr>
                	
                  <th>Tasks</th>
                  
                  <?php 
                  	
                  		if(isset($tasks)) 
                  		
						{
							
							$count = count($tasks);
							
							for($c=0;$c<$count;$c++)
							
							{
								
								echo "<th class=\"".url_title($tasks[$c]['area'])." temp\">".$tasks[$c]['area']."</th>\n";
							}
						}
                  		
                  	?>
                  
                </tr>
                
              </thead>
              
              <tbody>
              	
              		<?php 
              	

						$i=$n=0;
				
				
							foreach ($atts as $label => $name)
				
								{
										
									$i++;
					
											echo "<tr id=\"".$i."\">\n";
					
											if($i == 1 || $i == 7 || $i == 19) 
					
												{
						
													echo "<td  style=\"max-width:10%\"><br><strong>".$headers[$n]."</strong></td>\n";
													
											if(isset($tasks)) 
                  		
												{
													
													for($c=0;$c<$count;$c++)
							
														{
								
															echo "<td class=\"".url_title($tasks[$c]['area'])." temp\"></td>\n";
														
														}
														
												}
						
													$n++;
												
												}
					
													else 
					
												{
														
						
													echo "<td style=\"max-width:10%\">&nbsp;&nbsp;&nbsp;".$label."</td>\n";
													
													if(isset($tasks)) 
                  		
													{
													
													for($c=0;$c<$count;$c++)
							
														{
								
															echo "<td class=\"".url_title($tasks[$c]['area'])." temp\">".($tasks[$c][$name] == false ? "<span class=\"glyphicon glyphicon-remove\"></span> N/A" : "<span class=\"label label-default\">".$tasks[$c][$name]."</span> / Week")."</td>\n";
														
														}
														
														
													}
					
												}
					
										
													echo "</tr>\n";
				 							
												 }
				
				?>
				
              </tbody>
              
            </table>

         </div> 
          
          <hr>
          
         <?php $this->load->view($modules.'author'); ?>
  <?php /*          
      </div>
      
    </div>
	
	*/
	
	?>