<?php

    // echo $this->lang->line('menu'); 

	
    echo anchor('clientarea/schedules/recurring/'.$year.'/'.$month, 
  			
  							  '<i class="fa fa-plus"></i> Add New Recurring Jobs', 
  							  							  
  							  array('title' => 'Recurring Jobs', 'class' => 'btn btn-success btn-sm bottomPadBtn rightPadBtn')
							  
							  ); 
    
  
	
    echo anchor('clientarea/schedules/one_shot/'.$year.'/'.$month, 
  			
  							  '<i class="fa fa-plus"></i> Add New One Shot Jobs', 
  							  							  
  							  array('title' => 'One Shot Jobs', 'class' => 'btn btn-success btn-sm bottomPadBtn rightPadBtn')
							  
							  ); 
    

?>