 
 <?php if(!isset($error) && is_array($areas))
 
  {
  	
	?>
 
 <div class="table-responsive">
 	
            <table class="table table-striped table-hover delete">
            	
              <thead>
              	
                <tr>
                	
                  <th>Areas</th>
                  
                  <th>Controls</th>
                  
                </tr>
                
              </thead>
              
              <tbody>
              	
              	<?php 
              	
              	$n=0;
				
              	for($i=0;$i<count($areas);$i++)
              	
              	{
              		
              		$n++;
					
					echo "<tr id=\"".$areas[$i]['id']."\">\n";
					
					echo "<td>".ucwords($areas[$i]['area'])."</td>\n";
					
					echo "<td>".anchor('/clientarea/specifications/delete/'.$areas[$i]['site_id'].'/'.$areas[$i]['id'], '<span class="label label-default google-maps"><span class="glyphicon glyphicon-remove"></span>Delete</span>', 
					
										array('class' => 'delete_row', 'data-target' => url_title($areas[$i]['area'], '-', TRUE), 'data-row' => $n )
										
									  )."</td>\n";
					
					echo "</tr>\n";
					
              	}
				
				?>
              	
                
              </tbody>
              
            </table>

          </div>
          
<?php } ?>