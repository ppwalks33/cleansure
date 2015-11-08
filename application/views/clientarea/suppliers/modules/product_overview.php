

<?php $rows = array('name', 'type', 'case_qty', 'qty', 'cost', 'price', 'core_size', 'roll_size', 'length', 'width', 'weight', 'litres', 'date_quoted'); ?>

<div class="table-responsive customers">
        
      <table class="table table-striped table-hover">
      	
      	<thead>
      		
      		<tr>
      			
      			<th>Attribute</th>
      			
      			<th>Value</th>
      			
      		</tr>
      		
      	</thead>
      	
      	<tbody>
      		
      		<?php 
      		
      		$i=0;
      				foreach($rows as $r)
					
					{
						
						echo "<tr>\n";
						
						$i++;
						
						echo "<td>".ucwords(str_replace('_',' ', $r))."</td>\n";
						
						
						switch($i)
						
						{
							
							case 13:
								
							echo "<td>".format_date($row_data->date)."</td>\n";
								
							break;
							
							case 2:
								
							echo "<td>".$types[$row_data->$r]."</td>\n";
								
							break;
							
							default:
								 
						    echo "<td>".($row_data->$r == false ||  decVal($row_data->$r) == false ? 'N/A':$row_data->$r)."</td>\n";
								
						}
						
						
						echo "</tr>\n";
						
					}
      		
      		 ?>


		</tbody>
		
</table>

</div>