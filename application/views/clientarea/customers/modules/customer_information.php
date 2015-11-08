<div class="panel-body">

	<div class="company-details">
      	
      	<?php 
      	
      		$company_data = array('company_name', 'company_type', 'join_date', 'company_number', 'vat_number'); 
      		
      		foreach ($company_data as $key) {
      			
      		?>
      
      	
      		
        <p><?php echo error_name($key); ?>&nbsp;&nbsp;
        	
        	<span class="lead">
        	
        		<?php echo (!empty($customer_data[0]->$key) ? $customer_data[0]->$key:$na);?>
        		
        	</span>
        	
        </p>
        
        <?php } ?>
        
       
        </div>
        
          <br>
        
        <br>
        
        <div class="btn-group pull-right">
            
            <?php 
            
            if(($data->$prefix < 2 || $data->user_type == 1) &&  ($this->prefix != 'work_orders'))
		
		     {
            
            echo anchor('clientarea/customers/edit/company/'.$customer_data[0]->comp_id.'', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				        'data-title' => 'Edit Company Details', 
            				        
            				        'data-glyph' => 'user', 
            				        
            				        'title' => 'Company Information',
									
									'data-action' => false)
									
									); 
									
									
			 }
									?>
            
        </div>
   
   </div>