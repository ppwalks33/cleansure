<?php 

	if(count($available) > 0)
	
	{
	
        echo sprintf($this->lang->line('h4'), 'Available Machinery');
		
		echo "<div class=\"table-responsive\">\n
        	
            		<table class=\"table table-striped table-hover\">
            	
              			<thead>
              	
                			<tr>
                	
                  				<th>
                  	
                  					Type &nbsp;&nbsp;
                  		
                  				</th>
                  
                  				<th>
                  	
                  					Identifier
                  		
                  				</th>
                  
                  				<th>
                  	
                  					Status
                  		
                  				</th>
                  			
                  			</thead>
                  			
                  			<tbody>
                  		\n";
			
        
       }

	
	foreach($machines as $m)
	
	{
		
		
			if(in_array($m->mach_id, $available))
			
			{		
				echo "<tr>";
	
	            echo "<td>".$m->type."</td><td>".$m->identifier."</td><td>Available</td>";
  
                echo "</tr>\n";	
				
			}
		
	}
	
	echo "</tbody>\n</table>\n</div>\n<br>";

?>