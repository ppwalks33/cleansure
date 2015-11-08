<?php

$n = $s = 0;
	
	foreach($machines as $m)
	
	{
		
		if(in_array($m->mach_id, $staffMachines[0]))
	
	{
		
		if($n==0)
		
		{
			
			echo sprintf($this->lang->line('h4'), 'Staff Machinery Allocation');
			
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
                  	
                  					Staff Member
                  		
                  				</th>
                  			
                  			</thead>
                  			
                  			<tbody>
                  		\n";
			
		}
		
			echo "<tr>
			
					<td>".$m->type."</td>
				
					<td>".$m->identifier."</td>
				
					<td>".$m->first_name."&nbsp;".$m->last_name."</td>
				
				</tr>\n";
		
		$n++;
		
		echo ($n == $staffCount ? '</tbody></table></div><br>':NULL);
	}
}

foreach($machines as $m)
	
	{
		
		if(is_array($siteMachines[0]) && in_array($m->mach_id, $siteMachines[0]) )

{
	
	if($s==0)
		
		{
			
			echo sprintf($this->lang->line('h4'), 'Site Machinery Allocation');
			
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
                  	
                  					Company Name
                  		
                  				</th>
                  				
                  				<th>
                  	
                  					Site Name
                  		
                  				</th>
                  			
                  			</thead>
                  			
                  			<tbody>
                  		\n";
			
			
		}
		
			echo "<tr>
			
					<td>".$m->type."</td>
				
					<td>".$m->identifier."</td>
				
					<td>".$m->company_name."</td>
				
					<td> ".$m->site_name." </td>
				
				</tr>\n";
		
		$s++;
		
		echo ($s == $siteCount ? '</tbody></table></div><br>':NULL);
      }
  
	
	}
	

?>