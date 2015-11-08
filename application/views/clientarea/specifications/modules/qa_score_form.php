
<div id="alert"></div>

<br>

<strong>Last specification  created <?php //echo format_date($areas->date); ?></strong>

<br> <br>

<p><small>Please not a maximum upload limit of 1MB is allowed per file here..</small></p>

<br> <br>

 <div class="table-responsive">

            <table class="table table-striped table-hover">
            	
              <thead>
              	
                <tr>
                	
                  <th>Area</th>
                  
                  <th>Score</th>
                  
                  <th>Image</th>
                  
                </tr>
                
              </thead>
              
              <tbody>
                
                <?php 
                
                		for($i=0;$i<count($rows[0]);$i++)
						
						{
							
							echo "<tr>\n";
							
								echo "<td>".ucwords($rows[0][$i])."</td>\n";
								
								echo "<td>"
								
											.form_input(array('name' => 'area[]', 'class' => $class.' score', 'placeholder' => '1 - 4', 'maxlength' => '1') ).
											
											 form_hidden('ids[]', $rows[1][$i]);
											
									"</td>\n";
									
							echo "<td>".form_upload(array('class' => 'file', 'data-show-preview' => false, 'name' => 'image_'.$i))."<td>\n";
							
							echo "</tr>\n";
							
							
						}
                
                
                ?>
                
               
               
               
              </tbody>
              
            </table>

          </div>
          
          <br>
          
          <div class="audit-legend"
          
        	<?php $this->load->view($modules.'audit_legend'); ?>		
        			
			</div>

        