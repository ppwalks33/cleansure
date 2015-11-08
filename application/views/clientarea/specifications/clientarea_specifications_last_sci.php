
<?php 

		echo sprintf($this->lang->line('brief_heading'), 'Last SCI'); 
		
		$sci = array('Floor Type', 'Length', 'Width', 'Manual Area (Metre Squared)', 'Height (Metre\'s)', 'Shape', 'Enter Stairway Name', 
		
					 'Number of Stair Treds', 'Number of Cubicles', 'Number of Urinals', 'Number of Sinks', 'Mirror Area (Metre Squared)',
					 
					 'Additional Information');
					 
					 
		$headers = array('Floor Information', 'Room Information', 'Room Density', 'Stairway Information', 'Toilet Details?', 'Additonal Requirements');
		
		$rows = array('floor_type', 'length', 'width', 'sqr_metre','height', 'shape', 'stairway_name', 'no_stair_treds', 'no_cubicals', 'no_urinals', 'no_sinks', 'mirror_area', 'message');
		
		$count = (isset($recentSci) ? count($recentSci) : NULL);

?>

<div class="panel panel-default">
  	
   <?php echo sprintf($this->lang->line('panel_heading'), 'Latest SCI Details'); ?>
   
    <div id="c" class=" ">
    	
      <div class="panel-body">
      	
        <div class="table-responsive customers">
        	
            <table class="table table-striped table-hover">
            	
              <thead>
              	
                <tr>
                	
                  <th>Area</th>
                  
                  <?php 
                  
                  if(isset($recentSci))
				  
				  {
				  	
					for($c=0;$c<$count;$c++)
					
					{
						
						echo "<th>".$recentSci[$c]['area']."</th>\n";
						
					}
					
				  }
                  
				  ?>
                  
                </tr>
                
              </thead>
              
              <tbody>
              	
              	<?php 
              	
              	$i=$n=0;
              	
              	foreach($sci as $s) 
              	
              	{
              		
					
					
					if($i == 0 || $i == 4 || $i == 5 || $i == 6 || $i == 8 || $i == 12)
					
					{
						
						
						
						
						echo "<tr>\n";
						
						
						echo "<td><br><strong>".$headers[$n]."</strong></td>\n";
						
                  
						
						
                  
                  		if(isset($recentSci))
				  
				  			{
				  	
								for($c=0;$c<$count;$c++)
					
									{
										
						
									   echo "<td></td>\n";
									
									}
					
				  				}
                  
						
						echo "</tr>\n";
						
						$n++;
						
					}
              		
					echo "<tr>\n";
					
					
						echo "<td>".$s."</td>\n";
						
						for($c=0;$c<$count;$c++)
					
									{
										$area = $recentSci[$c][$rows[$i]];
										
										if($i == 12)
										
										{
											
											echo "<td style=\"max-width:100px;\">".($area  == false ? 'N/A':anchor('#', 'View Notes', array('class' => 'popup', 'data-content' => '<p>'.$area.'</p>', 'data-placement' => 'top', 'data-toggle' => 'tooltip', 'data-original-title' => '>> Your Notes', 'onClick' => 'return false;')))."</td>\n";
											
										}
										
										else {
											
											echo "<td style=\"max-width:100px;\">".($area  == false ? 'N/A':$area)."</td>\n";
											
										}
						
										
						
									
									}
					
					echo "</tr>\n";
					
					$i++;
					
				}
				
				?>
              	
              	<tr>
              		
              		
              	</tr>
              		
              </tbody>
              
            </table>

          </div>
          
          <br>
            
      </div>
      
    </div>