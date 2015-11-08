<?php

	
   // echo $this->lang->line('menu'); 
								
	
    echo anchor('clientarea/work_orders/create/', 
  			
  							  '<i class="fa fa-plus"> </i> Add New Work Order', 
  							  							  
  							  array('title' => 'Add New Work Order', 'class' => 'btn btn-success btn-sm bottomPadBtn rightPadBtn')
							  
							  ); 
	
	
    echo anchor('clientarea/work_orders/create_purchase_order/', 
  			
  							  '<i class="fa fa-plus"> </i> Add New Purchase Order', 
  							  							  
  							  array('title' => 'Add New Purchase Order', 'class' => 'btn btn-success btn-sm bottomPadBtn rightPadBtn')
							  
							  ); 
	 
	
?>

