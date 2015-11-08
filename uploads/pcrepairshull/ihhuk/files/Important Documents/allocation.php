<?php if(is_array($machines) && count($machines) > 0)

{
	
	$n = $i = $s = 0;
	
	foreach($machines as $m)
	
	{
		
	if(!empty($m->staff_id))
	
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
		
	
	
	elseif($m->site_id != $s_id )
	
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
	
	if(empty($m->staff_id) && (empty($m->customer_id) || $m->customer_id == $c_id && $m->site_id == $s_id))
	
	{
		
		
		
		if($i==0)
		
		{
				
			
				
			
		//	echo sprintf($this->lang->line('h4'), 'Available Machinery');
			
		}
		
	     echo "<div class=\"checkbox padLeft\">\n<label>\n";
	
	     echo form_checkbox('machine_id[]', $m->mach_id, ($m->customer_id == $c_id && $m->site_id == $s_id ? TRUE:NULL)).$m->type."&nbsp;(".$m->identifier.")";
  
         echo "</label>\n</div>\n";
		 
		 $i++;

	 }
	
	}
	
}

else {
	
	
	echo 'Please Add Machinery '.anchor('clientarea/machinery/add', 'here', array('title' => 'Add Machinery to the system'));
}

?>