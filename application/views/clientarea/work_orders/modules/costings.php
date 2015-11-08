
<div class="panel-body">
<?php

	$fields = array('labour_hours', 'labour_cost', 'material_cost', 'machine_cost', 'total_cost', 'invoice_number');
	
	for($i=0;$i<count($fields);$i++)
	
	{
		
		echo "<p>".ucwords(str_replace('_', ' ', $fields[$i]))."&nbsp;&nbsp; <span class=\"lead\">".($i > 0 && $i < 5 ? '&pound;':NULL).$customer_data[0]->$fields[$i]."</span></p>";
		
	}

 ?>
 
 <br>
 
</div>