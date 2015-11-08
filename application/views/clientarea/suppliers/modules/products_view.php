<div class="table-responsive customers">
        
      <table class="table table-striped table-hover">
      	
      	<thead>
      		
      		<tr>
      			
      			<th>Name</th>
      			
      			<th>Cost Per Unit</th>
      			
      			<th>Price Per Unit</th>
      			
			</tr>
			
	  </thead>
	  
	  <tbody>
	  	
	  	<?php 
	  	
	  	foreach($products as $p) 
	  	
	  	{
	  		
			echo "<tr>\n";
	  		
				echo "<td>".$p['name']."</td>\n";
				
				echo "<td>&pound;".$p['cost']."</td>\n";
				
				echo "<td>&pound;".$p['price']."</td>\n";
			
			echo "</tr>\n";
	  	}
	  	
	  	?>
	  	
	  	
	  	
	  </tbody>
	  
</table>

</div>