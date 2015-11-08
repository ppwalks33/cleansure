
<ul class="profile-contact topPad">
        	
          <li>
          	
          		<strong>Contact Name:</strong> 
          		
          			<?php echo $customer_data[0]->title.' '.$customer_data[0]->first_name.' '.$customer_data[0]->last_name; ?>
          		
          </li>
      
</ul>

<?php 

/* REM OUT TO NEED TO ASK PAUL ABOUT THIS */
/*
<div class="btn-group">
            
            <?php 
            
            if($data->$prefix < 2 || $data->user_type == 1)
		
		    {
            
            echo anchor('clientarea/customers/edit/users/'.$customer_data[0]->u_id.'', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-success btn-sm bottomPadBtn trigger', 
            				  
            				        'data-title' => 'Edit Customer Details', 
            				        
            				        'data-glyph' => 'user', 
            				        
            				        'title' => 'Customer Information',
									
									'data-action' => false)
									
									); 
									
						}
						
						?>
            
        </div>
   */   
 ?>