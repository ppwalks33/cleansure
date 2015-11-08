<?php

	echo "<nav class=\"navbar navbar-default site-control-navbar\" role=\"navigation\">\n";
	
    echo $this->lang->line('menu'); 
								
	echo "<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\n";
	
	echo "<ul class=\"nav navbar-nav navbar-right\">\n";
	
    echo "<li>\n";
	
    echo anchor('clientarea/messages/write/'.$this->data['data']->user_id, 
  			
  							  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Write Message', 
  							  							  
  							  array('title' => 'My Messages', 'data-title' => 'Write Message', 'class' => 'trigger', 'data-action' => false, 'data-wisy' => true)
							  
							  ); 
    
    echo "</li>\n";
	
	echo "</ul>\n";
	
	echo "</div>\n";
	
	echo "</div>\n";
	
    echo "</nav>\n";
	
?>