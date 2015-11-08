<?php 

		$rows = array('name', 'qty','case_qty', 'core_size', 'type', 'price'); 
		
		$type = array('Product', 'Consumable', 'Both');
	?>

<div class="table-responsive">
	
	<table class="table table-striped table-hover">
		
		<head>
		
		<tr>
			
			<?php for($i=0;$i<count($rows);$i++)
			
			{
				
				echo "<th>".ucwords(str_replace('_', ' ', $rows[$i]))."</th>\n";
				
			}
			
			?>
			
		</tr>
		
		</head>
		
		<tbody>
			
			<?php
			
			if(is_array($orders))
			
			{
			
			  foreach($orders as $order)
			
			   {
				
				  echo "<tr>\n";
				
				   for($i=0;$i<count($rows);$i++)
				
				    {
				    	
					 echo "<td>\n";
						
					  switch($i)
					  
					  {
					  	
					  	case $i > 0 && $i < 4:
							
							echo ($order->$rows[$i] == false ? $na:$order->$rows[$i]);
							
						break;
						
						case $i == 4:
							
							echo $type[$order->$rows[$i]];
							
						break;
						
						case $i > 4:
							
							echo "<span>&pound;".$order->$rows[$i]."</span>\n";
						
						break;
						
						default:
							
							echo $order->$rows[$i];
							
						break;
						
					  }
					   
					 echo "</td>\n";
				   }
				
				  echo "</tr>\n";
				
			    }
			   
			}
			
			?>
			
			
		</tbody>
		
	</table>
	
	
</div>

<?php

if($editable == true)

{
	
	echo anchor('/clientarea/stores/view_order/'.$orders[0]->order_id.'/'.(int)false,
	
				'Edit Order',
				
				array('class' => 'btn btn-default pull-right', 'title' => 'Amend Order')
				
				);
}

	

?>

<div class="clearfix"></div>

<br>
