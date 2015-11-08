 <div class="table-responsive">
 	
            <table class="table table-striped table-hover">
            	
              <thead>
              	
                <tr>
                	
                  <th>Tasks</th>
                  
                  <th>Scores</th>
                  
                </tr>
                
              </thead>
              
              <tbody>
              	
              	
              	<?php $this->load->view($modules.'score_table'); ?>
              
                
              </tbody>
              
            </table>

          </div>
          
<div class="col-xs-12 audit-footer">
            	
            	<div class="col-xs-12 col-md-4 audit-legend">
            	
            	
            			<?php $this->load->view($modules.'audit_legend'); ?>
            	
                </div>
                
                <div class="col-xs-12 col-md-4 audit-footer-boxes audit-scores">
            		
            	 	     <?php 
            	 	     
            	 	       if(isset($previous_score))
 
 							{
            	 	     
            	 	     		$this->load->view($modules.'previous_score'); 
            	 	     	
            	 	     		echo "<br>\n";
								
								$this->load->view($modules.'pre_auth');
							
							}
							
            	 	     	?>
            	 
                </div>
                
                <div class="col-xs-12 col-md-4 audit-scores">
            		
            	          <?php 
  
            	          		$this->load->view($modules.'current_score'); 
								
								echo "<br>\n";
								
								$this->load->view($modules.'author');
								       	          		
            	          	?>  
            	
                </div>
            	
            </div>
          
                     