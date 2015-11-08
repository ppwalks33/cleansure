<?php

			
	$th  = array('Name&nbsp;&nbsp;'.anchor(current_url().'/'.$ref, '<span class="glyphicon glyphicon-sort"></span>', array('title'  => 'Sort By')), 'Details', 'Address', 'Actions');
		
		echo "<div class=\"table-responsive\" >\n";
		
		echo "<table class=\"table table-striped table-hover\" id=\"".$ref."\">\n";
		
		$this->load->view($modules.'table_head', array('th' => $th));
		 
		echo "<tbody>\n";
		
		$i = 0;
		
		$p_code = array();
		
					
			foreach($contacts[$this->config->item($ref)] as $key => $arr)
			
			{
				
				$i++;
				
			if($i < 4)
			
			{
				echo "<tr>\n";
				
				echo "<td>\n";
				
				echo "<i class=\"glyphicon glyphicon-user hideIcon\"></i> ".$arr['first_name']." ".$arr['last_name'];
				
				echo "</td>\n";
				
				echo "<td>\n";
				
					foreach($contactfields as $cf)
				
				{
                		 
					
                	// Add if else statement to add hyper link to email in table
                	$EmailTest = ucwords(strstr($cf, '_', true));
					
                	if ($EmailTest  == 'Email') 
                	{
                		 echo ($arr[$cf] != false ? ucwords(strstr($cf, '_', true)).":  <a href=\"mailto:".$arr[$cf]."\"><strong>".$arr[$cf]."</strong></a><br>":NULL);
					}
					else
                	{
                	 echo ($arr[$cf] != false ? ucwords(strstr($cf, '_', true)).":  <strong>".$arr[$cf]."</strong><br>":NULL);
						
                	}
               
				
				}
                
				
				
				echo "</td>\n";
				
				echo "<td>\n";
				
				foreach($addressfields as $af)
				
				{
                
                		 
					 echo ($arr[$af] != false ? $arr[$af]."<br>":NULL);
                		  	  
					 $p_code[] = $arr['postcode'];
				}
				
				echo "</td>\n";
				
				echo "<td width=\"160\">\n";
				
				echo anchor('clientarea/sites/maps/'.trim(str_replace(' ', '',$arr['postcode'])).'', 
            
            				  '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Google Maps', 
            				  
            				  array('class' => 'btn btn-primary btn-xs blockBtn actionBtn map', 
            				  
            				  'data-title' => 'Location: '.$p_code[$i - 1], 
							  
							  'title'      =>  'Company Address',
							  
							  'data-glyph' =>  'map-marker'));
							  
				echo "</td>\n";
								
				echo "</tr>\n";
				
				}
				
		}
                
			
	?>