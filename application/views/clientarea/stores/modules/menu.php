<?php

echo "<nav class=\"navbar navbar-default site-control-navbar\" role=\"navigation\">\n";
	
    echo $this->lang->line('menu'); 
								
	echo "<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\n";
	
	echo "<ul class=\"nav navbar-nav navbar-right\">\n";
	
	
     echo "<li>\n";
	
	 echo anchor('/clientarea/stores/stock', '<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Create New Order', array('class' => ''))."\n";
    
     echo "</li>\n";
	 
	 echo "<li>\n";
	
	 echo anchor('/clientarea/stores/view_saved_orders/', 
	 	
	 			'<span class="glyphicon glyphicon-hdd"></span>&nbsp;&nbsp;View Saved Orders', 
	 			
	 			 array('class' => 'trigger', 'data-title' => 'Saved Orders', 'data-dismiss' => true, 'data-action' => false) 
				
				)."\n";
    
     echo "</li>\n";
	
	
	echo "</ul>\n";
	
	echo "</div>\n";
	
	echo "</div>\n";
	
    echo "</nav>\n";
	
	
	
?>