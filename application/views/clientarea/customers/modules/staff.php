<?php

echo "<div class=\"table-responsive\">\n";
  
  		echo "<table class=\"table table-hover\">\n";
  
  		echo "<thead>\n";
  
  		echo "<tr>\n";
  
  					$headers = array('Site Name','Name');
					
					
  
  					for($i=0;$i<count($headers);$i++)
  
  					{
  						
						
  	
								echo "<th>".$headers[$i]."&nbsp;&nbsp;</th>\n";
								
							
	
  					}
					
					
  
  		echo "</tr>\n";
 
        echo "</thead>\n";
		
		echo "<tbody>\n";
		
		$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
		
		foreach($jobs as $wo)
		
		{
			
			echo "<tr>\n";
				
			echo "<td>".$wo['site_name']."</td>\n";
			
			echo "<td>".$wo['first_name']."&nbsp;".$wo['last_name']."</td>\n";
			
			echo "</tr>\n";
			
		}
			
		
		
		echo "</tbody>\n";
		
		echo "</table>\n";
		
		echo "</div>\n";
?>
