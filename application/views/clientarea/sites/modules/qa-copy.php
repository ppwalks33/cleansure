<?php 
    
    		echo sprintf($this->lang->line('panel_heading'), 'Quality Audits'); 
    		
			echo "<div class=\"panel-body\">\n";
      	
      		$c = count($previous_score);  
			
			
      			if(is_array($previous_score)): 
					
				
					echo $c;
					
					if($c > 0)
					
					{
						
						echo "<div class=\"col-xs-12 col-md-".($c == 1 ? '12':'6')." audit-scores\">\n";
						
						echo sprintf($this->lang->line('h4'), 'Last Score');
						
						echo "<ul class=\"profile-qa-scores\">\n";
						
						echo "<li>".$score[0][2]."% <span class=\"glyphicon glyphicon-circle-arrow-".($myScore[0] == true ? 'up up':'down down')."\"></span></li>\n";
            
            			echo "<li>".$score[0][1]." out of ".$score[0][0]."</li>\n";
						
						echo "</ul>\n";
						
						echo "</div>\n";
						
					}
					
					    echo "<div class=\"col-xs-12 col-md-".($c > 1 ? '6':'12')." audit-scores\">\n";
						
						echo sprintf($this->lang->line('h4'), 'Current Score');
						
						echo "<ul class=\"profile-qa-scores\">\n";
						
						if($c > 1)
					
							{
						
							echo "<li>".$score[1][2]."% <span class=\"glyphicon glyphicon-circle-arrow-".($myScore[1] == true ? 'up up':'down down')."\"></span></li>\n";
						
							}
							
						else
							
							{
								
								echo "<li>".$score[1][2]."%</li>\n";
								
							}
            
            			echo "<li>".$score[1][1]." out of ".$score[1][0]."</li>\n";
						
						echo "</ul>\n";						
						
						
						
						echo "</div>\n";
						
						
						echo "<span>Last QA for Specification <strong>".$previous_score[0]['spec_name']." <strong></span><br><br>\n";
						
				else:
					
					echo "<div class=\"col-xs-12 col-md-12 audit-scores\">\n";
					
					echo sprintf($this->lang->line('h4'), 'No Scores Available!');
					
					echo "</div>\n";
					
				endif;
				
				echo "<br>\n";
				
				echo "<div class=\"btn-group  pull-right\">\n";
				
			
					
					if($c > 1) 
					
					{
						
						echo anchor('clientarea/specifications/qa_history/'.$customer_data[0]->site_id, 
						
						 			'<span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View History', 
						 			
						 			array('class' => 'btn btn-default trigger', 'data-title' => 'QA History', 'data-glyph' => 'search')
									
									);
						
					}
					
					
					
					echo "</div>\n";
					
					echo "</div>\n";
        	 ?>