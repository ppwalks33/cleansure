<?php

$th  = array('Name&nbsp;&nbsp;'.anchor(current_url().'/'.$ref, '<span class="glyphicon glyphicon-sort"></span>', array('title'  => 'Sort By')), 'Details', 'Address', 'controls');

echo "<table class=\"table table-striped table-hover\" id=\"".$ref."\">\n";
		
		$this->load->view($modules.'table_head', array('th' => $th));
		 
		echo "<tbody>\n";
		
		$i = 0;
					
			foreach($pageData as $arr)
			
			{
				
				$i++;
				
			if($i < 3)
			
			{
				echo "<tr>\n";
				
				echo "<td>\n";
				
				echo $arr['first_name']." ".$arr['last_name'];
				
				echo "</td>\n";
				
				echo "<td>\n";
				
					foreach($contactfields as $cf)
				
				{
                		 
					 echo ($arr[$cf] != false ? ucwords(strstr($cf, '_', true)).":  ".$arr[$cf]."<br>":NULL);
                		  
				
				}
                
				
				
				echo "</td>\n";
				
				echo "<td>\n";
				
				foreach($addressfields as $af)
				
				{
                
                		 
					 echo ($arr[$af] != false ? $arr[$af]."<br>":NULL);
                		  	  
				
				}
				
				echo "</td>\n";
				
				echo "<td>\n";
				
				echo anchor('clientarea/sites/maps/'.trim(str_replace(' ', '',$arr['postcode'])).'', 
            
            				  '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Google Maps', 
            				  
            				  array('class' => 'btn btn-default map', 
            				  
            				  'data-title' => '', 
							  
							  'title'      =>  'Company Address',
							  
							  'data-glyph' =>  'map-marker'));
							  
				echo "</td>\n";
								
				echo "</tr>\n";
				
				}
				
		}

	  echo "</tbody>\n</table>\n</div>\n";