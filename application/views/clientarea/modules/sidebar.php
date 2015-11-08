<div class="col-sm-3 col-md-2 col-lg-2 sidebar">
  
  <ul class="nav nav-sidebar">
  	
  	<li><span class="sidebar-heading">Notification Centre</span></li>
  	
  	
  	<li>
  		
  				<?php 
    	  					if($data->user_type <= 5)
							
							{
    	  				
    	  					echo anchor('clientarea/private_alerts/', 
    	  
    	  					'<span class="glyphicon glyphicon-minus-sign"></span>
    	  						
    	  								&nbsp;&nbsp;New Alerts &nbsp;
    	  								
    	  									<span class="label label-default alertCounter">'.($data->alertCount != false ? $data->alertCount:NULL)."</span>",   	  					
    	  					
    	  					array('title' => 'My Alerts', 'data-title' => 'Alerts!', 'class' => 'trigger', 'data-action' => false, 'data-dismiss' => true)
							
							); 
							
							}
							
						    echo "</li>\n<li>\n";
							

  							echo anchor('clientarea/messages/write/'.$this->data['data']->user_id, 
  			
  							'<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;New Message', 
  							  							  
  							array('title' => 'My Messages', 'data-title' => 'Write Message', 'class' => 'trigger', 'data-action' => false, 'data-wisy' => true)
							  
							); 
							  
				            echo "</li>\n<li>\n";
				            
    	  					echo anchor('clientarea/messages/'.$this->data['data']->user_id, 
    	  
    	  					'<span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;My Messages'.($data->messageCount != false ? '&nbsp;<span class="label label-default">'.$data->messageCount.'</span>':NULL),   	  					
    	  					
    	  					array('title' => 'My Messages')
							
							); 
							
							echo "</li><li>";
							
							if(isset($deleted))
							
							{
							
							  echo anchor('clientarea/'.$this->prefix.'/deleted/', 
    	  
    	  					  '<span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Deleted '.($deleted != false ? '&nbsp;<span class="label label-default">'.$deleted.'</span>':NULL),   	  					
    	  					
    	  					  array('title' => 'My Messages')
							  
							  
							
							); 
							
							}
							
						echo "</li></ul>";
							
							
				?>

    	
    
    	
    	
    	
    	
    		
    		
    
  
  <ul class="nav nav-sidebar">
  	
  	<li><span class="sidebar-heading">Control Panel</span></li>
  	
    <li>
    	
    	<a href="#"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Help &amp; Support</a>
    	
   </li>
   
  </ul>
  
  <ul class="nav nav-sidebar">
  	<li><hr></li>
    <li><a href="/clientarea/logout/"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Logout</a></li>
  </ul>
  
</div>