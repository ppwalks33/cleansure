<?php /* echo $this->lang->line('menu'); */ ?>

<?php echo anchor('/clientarea/machinery/add', '<span class="glyphicon glyphicon-plus"></span> Add New Machinery', array('class' => 'btn btn-success btn-sm bottomPadBtn rightPadBtn')); ?>

<?php echo anchor('/clientarea/machinery/allocate/', 
		
		'<span class="fa fa-cogs"></span> Track Machinery', 
		
		array('class' => 'trigger btn btn-success btn-sm bottomPadBtn rightPadBtn', 'data-title' => 'All Machinery', 'data-glyph' => 'glyphicon-compressed')
		
		); 
?>



        		
<?php 
/*
echo anchor('/clientarea/machinery/allocate/',
			  
			  					        '<span class="glyphicon glyphicon-compressed"></span Track Machinery',
								
								          array('class' => 'trigger btn btn-success btn-sm bottomPadBtn rightPadBtn',
								
								          'data-title' => 'All Machinery', 
            				        
            				              'data-glyph' => 'glyphicon-compressed', 
            				        
            				                  'title' => 'All Machinery',
									 
									          'data-action' => false));
 
 */
									 
						 ?>
        		
        