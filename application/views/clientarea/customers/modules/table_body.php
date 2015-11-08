
 
 <div class="table-responsive customers">
        	
        <?php $headers = array('Company Name', 'Customer Name', 'Date Added', 'Sites', 'Contract Work', 'One Shot Jobs', 'Staff','Actions') ;?>
        	
            <table class="table table-striped table-hover">
            	
              <thead>
              	
              	<?php 
              	
              	echo "<tr>\n";
              	
              	for($i=0;$i<count($headers);$i++) 
              	
                 {
                 	
					
										
					echo "<th>".$headers[$i].($i < 6 ? "&nbsp;&nbsp;":NULL);
					
					if($i < 6)
					
					{
					
						echo anchor('#', '<span class="glyphicon glyphicon-sort"></span>', array('title' => 'sort '.$headers[$i]));
						
					}
					
					echo "</th>\n";					
					
					
					
                 }
				 
				 echo "</tr>\n";
              	
              	?>
              	
                
             </thead>
             
              <tbody>
              	
              	<?php foreach($pageData as $c) {  ?>
              	
                <tr>
                	
                  
                  <td>
                  	
                  	<?php 
                  	
                  		if($c->individual == true) {   
                  			
                  		
							
                  	?>
                  		
                  		
                  			
                  			<?php  foreach($compContacts as $key => $val) { echo ($val != ''? $key.': '.$val.'<br>':NULL);} ?>
                  			
                  	
                  		
                  				<?php echo (!empty($c->company_name) ? $c->company_name: 'Not Entered'); ?>
                  				
                  				
                  				
                   <?php 
					
					} 
					
					else 
					
					{
                   	
						echo " N/A\n";
				
                   }
                   
                   ?>
                  				
                  </td>
                  
                  <td>
                  	
                  	<?php $contacts = array('Daytime' => $c->user_d_tel, 'Evening' => $c->user_e_tel, 'Mobile' => $c->user_m, 'Fax' => $c->u_fax, 'Email' => $c->user_email); ?>
                  	
                  	<span class="glyphicon glyphicon-user hideIcon"></span>

                  	
         
                  					
                  				<?php echo '&nbsp;'.$c->first_name.'&nbsp;'.$c->last_name; ?>
                  						
                  							
                  						
                  		
                  		
                  				
                  </td>
                  
                  
                  <td>
                  	
                  	<span class="glyphicon glyphicon-time hideIcon"></span> <?php echo format_date($c->join_date); ?>
                  	
                  </td>
                  
                  <td>
                  	
                  	<?php if(($c->cusSites) > 0): ?>
                  	<span class="label label-success blockBtn"><?php echo $c->cusSites; ?></span>
                  	<?php else: ?>
                  		<span class="label label-danger blockBtn">0</span>
                  	<?php endif; ?>
                  	<?php
                  	
                  	
                  	echo anchor('/clientarea/sites/view_sites/'.$c->comp_id.'/1', 
                  	
                  				'<span class="fa fa-eye rightPadIcon"></span> View Sites', 
                  	
                  				array('class' => 'trigger btn btn-primary btn-xs blockBtn',
                  				
                  					  'data-title' => 'Customer Sites', 
            				        
            				          'data-glyph' => 'user',
            				          
            				          'data-action' => false));
					
					
                  	?>
                  		
                 </td>
                 
                  <td>
                  	
                  	<?php if($c->contracts > 0) {  ?>
                  	
                  		<span class="label label-success blockBtn"><?php echo $c->contracts;?></span> <?php echo anchor('/clientarea/customers/contracts/2/'.$c->comp_id, 
                  		
                  																				'<span class="fa fa-eye rightPadIcon"></span> View Contracts', 
                  		
                  																				array('title' => 'View Contracts', 'class' => 'trigger btn btn-primary btn-xs blockBtn',
                  				
                  					  																  'data-title' => 'View Contracts', 
            				        
            				          																  'data-glyph' => 'user',
            				          																  
																									  'data-dismiss' => true,
            				          
            				          																  'data-action' => true)); 
																									  
																									  
					}
					
                        else
							
						{
							
							echo "<span class=\"label label-danger blockBtn\">0</span>\n";
						}
            				          																  
            				          																  ?>
                  		
                  </td>
                  
                  <td>
                  	
                  		
                  	
                  		<?php if($c->oneshots > 0) {  ?>
                  	
                  		<span class="label label-success blockBtn"><?php echo $c->oneshots;?></span> <?php echo anchor('/clientarea/customers/contracts/1/'.$c->comp_id, 
                  		
                  																				'<span class="fa fa-eye rightPadIcon"></span> View Jobs', 
                  		
                  																				array('title' => 'View Jobs', 
                  																				
                  																					  'class' => 'trigger btn btn-primary btn-xs blockBtn',
                  				
                  					  																  'data-title' => 'View Jobs', 
            				        
            				          																  'data-glyph' => 'user',
            				          
            				          																  'data-action' => true)
																									  
																									  ); 
																									  
																									  
					}
					
                        else
							
						{
							
							echo "<span class=\"label label-danger blockBtn\">0</span>\n";
						}
            				          																  
            				          																  ?>
                  		
                  </td>
                  
                  <td>
                  	
                  	<?php if($c->staffCount > 0): ?>
                  		
                  		<span class="label label-success blockBtn"><?php echo $c->staffCount; ?></span>
                  		
                  		<?php echo anchor('clientarea/customers/view_staff/'.$c->comp_id, 
                  		
                  																	'<span class="fa fa-eye rightPadIcon"></span> View Staff', 
                  																	
                  																	array('title' => 'View Staff', 
                  																				
                  																		  'class' => 'trigger btn btn-primary btn-xs blockBtn',
                  				
                  					  													  'data-title' => 'View staff', 
            				        
            				          													  'data-glyph' => 'user',
            				          
            				          													  'data-action' => true)
																						  
																						  );
																						  
								else:
									
									echo "<span class=\"label label-danger blockBtn\">0</span>\n";
									
								endif;																  
																						 
																						 
					?> 
                  		
                  		
                  </td>
                
                  
                  <td>
                  
                  				
                  		<?php echo anchor('clientarea/customers/profile/'.$c->cus_id, 
                  		
                  		'<span class="glyphicon glyphicon-user"></span> Edit Customer Profile', 
                  		
                  		array('title' => 'Customer Profile','class' => 'btn btn-success btn-xs blockBtn actionBtn')); 
						 
						 
                  		
                  		?>
                  </td>
                  
                </tr>
                
               <?php } ?>
               
              </tbody>
            </table>

          </div>
          
<?php echo $customer_pag; ?>