

<?php

echo "<div class=\"table-responsive\">\n";
  
  		echo "<table class=\"table table-hover\">\n";
  
  		echo "<thead>\n";
  
  		echo "<tr>\n";
  
  					$headers = array('Type','site','Specification', 'Start','Finish','Days', 'Labour Hours', 'Labour Costs', 'Material Costs', 'Machine Costs', 'Total Costs');
					
					
  
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
			
				echo "<td>".($wo['type'] == 1 ? 'One Shot':'Recurring')."</td>\n";	
				
				echo "<td>".$wo['site_name']."&nbsp;&nbsp;".
				
							anchor('/clientarea/sites/profile/'.$wo['site_id'], '<span class="glyphicon glyphicon-share-alt"></span>')."<br>
							
							<span>REF: ".$wo['order_num']."</span>
					
							</td>";	
				
				if(!empty($wo['lastSCI']))
				
				{
				
				 echo "<td>".anchor('/clientarea/specifications/last_spec/'.$wo['site_id'].'/'.$wo['lastSCI'], 'Last Specification')."</td>\n";
				 
				 }

				else 
				
				{
					
					
					echo "<td>".anchor('/clientarea/specifications/', 'Create Specification')."</td>\n";
				}		
				
				echo "<td>".format_date($wo['startDate']);
				
				echo "<td>".format_date($wo['finishDate']);
				
				echo "<td>\n<ul class='table-list'>\n";
				
				foreach ($days as $d)
				
				{
					
					if($wo[$d] == true)
					
					{
						
						echo "<li>".ucwords($d)."</li>\n";
						
					}
					
				}
				
				echo "</ul>\n</td>\n";
				
				echo "<td>".$wo['labour_hours']."</td>\n";		
				
				echo "<td>&pound;".$wo['labour_cost']."</td>\n";
				
				echo "<td>&pound;".$wo['material_cost']."</td>\n";	
				
				echo "<td>&pound;".$wo['machine_cost']."</td>\n";	
				
				echo "<td>&pound;".$wo['total_cost']."</td>\n";	
			
			echo "<tr>\n";
			
		}
		
		echo "</tbody>\n";
		
		echo "<table>\n";
		
		echo "<div>\n";
		
		?>
