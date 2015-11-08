<?php

echo "<div class=\"table-responsive\">\n";
  
  		echo "<table class=\"table table-hover\">\n";
  
  		echo "<thead>\n";
  
  		echo "<tr>\n";
  
  					$headers = array('Type','Customer','Site','Commence Date','Finish Date','Staff', 'Times', 'Days');
					
					
  
  					for($i=0;$i<count($headers);$i++)
  
  					{
  						
						
  	
								echo "<th>".$headers[$i]."&nbsp;&nbsp;</th>\n";
								
							
	
  					}
					
					
  
  		echo "</tr>\n";
 
        echo "</thead>\n";
		
		echo "<tbody>\n";
		
		foreach($jobs as $wo)
		
		{
			
			echo "<tr>\n";
			
			echo "<td>".($wo['type'] == 1 ? 'One Shot':'Recurring')."</td>\n";
				
			echo "<td>".anchor('clientarea/customers/profile/'.$wo['cust_id'],$wo['company_name'])."</td>\n";
			
			echo "<td>".anchor('clientarea/sites/profile/'.$wo['sites_id'],$wo['site_name'])."</td>\n";
			
			echo "<td>".format_date($wo['startDate'])."</td>\n";
			
			echo "<td>".format_date($wo['finishDate'])."</td>\n";
			
			$names = array('first_name', 'last_name', 'start_time', 'end_time');
			
			for($i=0;$i<4;$i++)
			
			{
				
				${$names[$i]} = explode(',', $wo[$names[$i]]);
				
			}
			
			echo "<td>\n";
				
						echo "<ul class=\"table-list\">\n";
						
						$i=0;
						
								foreach($first_name as $name)
								
								{
									
									echo "<li>".$name."&nbsp;".$last_name[$i]."</li>\n";
									
									$i++;
								}
						
						echo "</ul>\n";
				
				
				echo "</td>\n";
				
				echo "<td>\n";
				
						echo "<ul class=\"table-list\">\n";
						
						$i=0;
						
								foreach($start_time as $time)
								
								{
									
									echo "<li>".$time." - ".$end_time[$i]."</li>\n";
									
									$i++;
								}
						
						echo "</ul>\n";
				
				
				echo "</td>\n";
				
				echo "<td>\n";
				
				foreach($days as $d)
				
				{
					
					if($wo[$d]  == true)
					
					{
						
						echo "<ul class=\"table-list\">\n";
						
						
							echo "<li>".ucwords($d)."</li>\n";
						
						
						echo "</ul>\n";
						
					}
					
				}
				
				
				echo "</td>\n";
			
			echo "</tr>\n";
			
		}
			
		
		
		echo "</tbody>\n";
		
		echo "</table>\n";
		
		echo "</div>\n";
?>