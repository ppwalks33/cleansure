<div class="table-responsive">
 	
            			<table class="table table-striped table-hover taskstable">
            	
              				<thead>
              	
                				<tr>
                	
                  				<th>Tasks</th>
                  
                  				<th>Frequency</th>
                  
                			</tr>
                
              			</thead>
              
              <tbody>
              	
              	<?php 
				
				$i=$n=0;
				
				foreach ($atts as $label => $name)
				
				{
					
					$i++;
					
					echo "<tr ".($i>18?'class="bathroom bthrm"':NULL).">\n";
					
					if($i == 1 || $i == 7 || $i == 19) 
					
					{
						
						
						echo "<td><br><strong>".$headers[$n]."</strong></td>\n";
						
						echo "<td></td>\n";
						
						$n++;
						
					}
					
					else 
					
					{
						
						echo "<td>&nbsp;&nbsp;&nbsp;".$label."</td>\n";
						
						echo "<td><span class=\"frequency\">".form_input( array('class' => 'frequency form-control', 'name' => $name) )."&nbsp;/ Week</span></td>\n";
					}
					
					echo "</tr>\n";
				  }
				
				 ?>
              </tbody>
            </table>

          </div>