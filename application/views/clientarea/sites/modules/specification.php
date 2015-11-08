	
	<?php 
	
	echo sprintf($this->lang->line('panel_heading'), 'All Specifications'); 
	
	echo "<div class=\"panel-body\">\n";
      	
      	if(is_array($last_spec)): 
			
			for($i=0;$i<count($last_spec);$i++)
			
			{
				
				$sci[$i] =  explode(',' , $last_spec[$i]->sci);
				
			}
			
			
			
			echo "<div class=\"table-responsive\">\n";
			
			echo "<table class=\"table table-striped table-hover\">\n";
			
			echo "<thead>\n";
        
        		$headers = array('Quality Audit', 'Specifications', 'Dates', 'Author' , 'View SCI'); 
		
					echo "<tr>\n";
		
						foreach ($headers as $head)
		
						{
			
							echo "<td>".$head."</td>\n";
						}
        
				
						echo "</tr>\n";
						
						echo "</thead>\n";
						
						echo "<tbody>\n";
						
						for($i=0;$i<count($last_spec);$i++)
						
						{
							
						
						
						echo "<tr>\n";
						
						       echo "<td>".anchor('/clientarea/specifications/spec_qa/'.$last_spec[$i]->site_id.'/'.$customer_data[0]->company_id.'/'.$last_spec[$i]->unique, 
				               				
				               						'Add QA >>', 
				               						
				               			    array('title' => 'View SCI', 'class' => '')).
				               			    
							"</td>";
						
						
				               echo "<td><span class=\"glyphicon glyphicon-list-alt\"></span>&nbsp;&nbsp;".
				               
				               				anchor('/clientarea/specifications/last_spec/'.$last_spec[$i]->site_id.'/'.$last_spec[$i]->unique, 
				               				
				               						$last_spec[$i]->spec_name, 
				               						
				               			    array('title' => 'View SCI', 'class' => ''))
				               			    
				               ."</td>\n";
							   
							   echo "<td>".format_date($last_spec[$i]->date)."</td>\n";
							   
							   echo "<td>".$last_spec[$i]->first_name."&nbsp;".$last_spec[$i]->last_name."</td>\n";
							   
							   
							   if($sci[0][0] > 0)
							   
							   {
							   	
								 echo "<td><span class=\"glyphicon glyphicon-list-alt\"></span>&nbsp;&nbsp;".
				               
				               				anchor('/clientarea/specifications/last_sci/'.$last_spec[$i]->site_id.'/'.$last_spec[$i]->unique, 
				               				
				               						'View Last SCI', 
				               						
				               			    array('title' => 'View SCI', 'class' => ''))
				               			    
				               ."</td>\n";
							   	
							   }
							   else 
							   
							   {
								  
								  echo "<td>No SCI Added!</td>"; 
							   }
							   

						
						echo "</tr>\n";
						
						}
						
					
						echo "</tbody>\n";
						
						echo "</table>\n";
						
						echo "</div>\n";
        
        else: 
		
			echo sprintf($this->lang->line('h4'), 'Please Enter A Specification/ SCI to Begin!');
		
		 endif; 
		 
		 echo "<br>\n";
		 
		 echo "<div class=\"btn-group  pull-right\">\n";
		 
		 if($data->$prefix < 2 || $data->user_type == 1)
		
		   {
 	
        	
        		echo anchor('/clientarea/specifications/', '<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New SCI / Spec', array('class' => 'btn btn-default')); 
				
		   }
				
			//	if(isset($sci) && count($sci) > 1)
				
			//	{
        		
        	//	  echo anchor('/clientarea/specifications/history/'.$customer_data[0]->site_id, '<span class="glyphicon glyphicon-eye"></span>&nbsp;&nbsp;View History', array('class' => 'btn btn-default'));
				  
			//	}
				
				echo "</div>\n</div>\n";
        		
        		?>
            
        