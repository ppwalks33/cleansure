<?php /* echo $this->lang->line('menu'); */  ?>
<?php /* echo anchor('/clientarea/customers/add/', '<i class="glyphicon glyphicon-plus"></i> New Customer</a>', array('class' => 'btn btn-success btn-sm bottomPadBtn'); */ ?>

	<?php 
	
	/* Add New Customer */
                  		
     echo anchor('/clientarea/customers/add/',
							
	'<span class="glyphicon glyphicon-plus"></span> Add New Customer',
										
	array('title' => 'Add New Customer', 'class' => 'btn btn-success btn-sm bottomPadBtn rightPadBtn'));
                  			
	
	/* Add New Site */
                  		
     echo anchor('/clientarea/customers/new_site/',
							
	'<span class="glyphicon glyphicon-plus"></span> Add New Site',
										
	array('title' => 'Add New Site', 'class' => 'btn btn-success btn-sm bottomPadBtn rightPadBtn'));
	
	/* Create New WO's */
                  		
     echo anchor('/clientarea/work_orders',
							
	'<span class="glyphicon glyphicon-plus"></span> Create New WO\'s',
										
	array('title' => 'Create New WO', 'class' => 'btn btn-success btn-sm bottomPadBtn rightPadBtn'));
	
	/* Create New WO's */
                  		
     echo anchor('/clientarea/specifications/',
							
	'<span class="glyphicon glyphicon-plus"></span> Add New Specification',
										
	array('title' => 'Add Specifications or SCI\'s', 'class' => 'btn btn-success btn-sm bottomPadBtn rightPadBtn'));
                  			
    ?>