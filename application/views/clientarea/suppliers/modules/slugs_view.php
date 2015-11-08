<div class="table-responsive customers">
        
      <table class="table table-striped table-hover">
      	
      	<thead>
      		
      		<tr>
      			
      			<th>Name</th>
      			
      			<th>URL</th>
      			
      			
			</tr>
			
	  </thead>
	  
	  <tbody>
	  	
	  	<?php 
	  	
	  	foreach($slugs as $s) 
	  	
	  	{
	  		
			echo "<tr>\n";
	  		
				echo "<td>".$s['name']."</td>\n";
				
				echo "<td><a href=\"".prep_url($s['slug'])."\" target=\"_blank\" title=\"Click to Go To WebPage\">".$s['slug']."</a></td>\n";
			
			echo "</tr>\n";
	  	}
	  	
	  	?>
	  	
	  	
	  	
	  </tbody>
	  
</table>

</div>