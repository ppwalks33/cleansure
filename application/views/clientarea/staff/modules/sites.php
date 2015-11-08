<?php

echo "<div class=\"table-responsive\">\n";
  
  		echo "<table class=\"table table-hover\">\n";
  
  		echo "<thead>\n";
  
  		echo "<tr>\n";
  
  					$headers = array('Customer','Site','<span class="glyphicon glyphicon-time"></span> Start','<span class="glyphicon glyphicon-time"></span> Finished','<span class="fa fa-calendar"></span> Days','Actions');
					
					
  
  					for($i=0;$i<count($headers);$i++)
  
  					{
  						
						
  	
								echo "<th>".$headers[$i]."&nbsp;&nbsp;</th>\n";
								
							
	
  					}
					
					
  
  		echo "</tr>\n";
 
        echo "</thead>\n";
		
		echo "<tbody>\n";
		
		$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
		
		foreach($sites as $wo)
		
		{
			
			echo "<tr>\n";
				
		//	echo "<td>".anchor('clientarea/customers/profile/'.$wo['cust_id'],$wo['company_name'])."</td>\n";

		    echo "<td>".$wo['company_name']."</td>\n";
			
		//	echo "<td>".anchor('clientarea/sites/profile/'.$wo['site_id'],$wo['site_name'])."</td>\n";
			
			echo "<td>".$wo['site_name']."</td>\n";
			
			echo "<td width=\"100\">".$wo['start_time']."</td>\n";
			
			echo "<td width=\"100\">".$wo['end_time']."</td>\n";
			
			echo "<td width=\"100\">\n";
			
			echo "<ul class='list-unstyled'>\n";
			
			foreach ($days as $d)
			
			{
				
				if($wo[$d] == true)
				
				{
					
				
				  echo "<li>".ucwords($d)."</li>\n";
				  
				}
				
			}
			
			echo "</ul>\n";
			
			echo "</td>\n";
				
			//echo "<td>".anchor('clientarea/customers/profile/'.$wo['cust_id'], '<span class="glyphicon glyphicon-user"></span> Edit User Profile','class' => 'btn btn-success btn-xs blockBtn actionBtn'))."</td>\n";
				
			echo "<td width=\"200\">".anchor('clientarea/customers/profile/'.$wo['cust_id'],'<span class="glyphicon glyphicon-user"></span> View Customer Details',array('class' => 'btn btn-primary btn-xs blockBtn actionBtn')).anchor('clientarea/sites/profile/'.$wo['site_id'],'<span class="glyphicon glyphicon-user"></span> View Site Details',array('class' => 'btn btn-primary btn-xs blockBtn actionBtn'))."</td>\n";
			
			
			echo "</tr>\n";
			
		}
			
		
		
		echo "</tbody>\n";
		
		echo "</table>\n";
		
		echo "</div>\n";
?>