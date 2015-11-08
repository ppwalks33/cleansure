	<div class="table-responsive customers">
        
      <table class="table table-striped table-hover">
      	
      	<thead>
      		
      		<tr>
      			
      			<th>Name</th>
      			
      			<th>Type</th>
      			
      			<th>Cost Per Unit</th>
      			
      			<th>Price Per Unit</th>
      			
      			<?php 
        	
        				if($data->$prefix < 2 || $data->user_type == 1)
		
					{
			
 				?>
 	
      			
      			<th>Actions</th>
      			
      			
      			<?php } ?>
      			
      		</tr>
      		
      	</thead>
      	
      	<tbody>
      		
      		<?php
      				
      				if(isset($customer_data[0]->product_name))
				
						{
					
							$items = array('prod_id', 'price', 'cost', 'product_name', 'product_type', 'meas_id', 'prod_date'); 
      			
      						for($i=0;$i<7;$i++)
				
								{
					
									${$items[$i]} = array_map('trim',explode(',', $customer_data[0]->$items[$i]));
									
					
							}
							
							
						if(isset($prod_id) && is_array($prod_id))
					
							{
						
						
						for($i=0;$i<count($prod_id);$i++)
						
							{
								
								echo "<tr>\n";
								
								
        	
        				if($data->$prefix < 2 || $data->user_type == 1)
		
								{
			
								
								echo "<td><strong>".anchor('/clientarea/suppliers/products/'.$customer_data[0]->comp_id.'/'.$prod_id[$i].'/'.$meas_id[$i].'/'.$prod_date[$i], $product_name[$i], array('title' => 'Edit '.$product_name[$i], 'class' => 'trigger', 'data-title' => 'Edit Product', 'data-action'  => false)).
																
									"&nbsp;&nbsp;".anchor('/clientarea/suppliers/products/'.$customer_data[0]->comp_id.'/'.$prod_id[$i], '<span class="glyphicon glyphicon-share-alt"></span>', array('title' => 'View '.$product_name[$i], 'class' => 'trigger', 'data-title' => 'View Product', 'data-action' => false))."</strong></td>\n";
								
								
								}
								
					   				else
										
									{
										
										echo "<td>".$product_name[$i]."&nbsp;&nbsp;".anchor('/clientarea/suppliers/products/'.$customer_data[0]->comp_id.'/'.$prod_id[$i], '<span class="glyphicon glyphicon-share-alt"></span>', array('title' => 'View '.$product_name[$i], 'class' => 'trigger', 'data-title' => 'View Product', 'data-action' => false))."</td>\n";
										
									}
									
								echo "<td>".ucwords($types[$product_type[$i]])."</td>\n";
								
								echo "<td>&pound;".$cost[$i]."</td>\n";
								
								echo "<td>&pound;".$price[$i]."</td>\n";
								
								echo "<td></td>\n";
								
								echo "</tr>\n";
							
								}
							
							}
					
				}
      				
      		?>
      		
      	</tbody>
      	
      </table>
      
      </div>
        
        <div class="btn-group pull-right">
        	
        	<?php 
        	
        	if((isset($customer_data)) && ($data->$prefix < 2 || $data->user_type == 1))
		
			{
        	
        	echo anchor('clientarea/suppliers/products/'.$customer_data[0]->comp_id.'/', '<span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Add Product', array('data-title' => 'Add Product', 'data-action' => false, 'class' => 'trigger btn btn-default'));
        	
        	} ?>
        	
          
        </div>