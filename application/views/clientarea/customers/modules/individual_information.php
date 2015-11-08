<div class="panel-body">

	<div class="company-details">
      	
      	<?php 
      	
      		$company_data = array( 'join_date'); 
      		
      		foreach ($company_data as $key) {
      			
      		?>
      		
      	 <p>Customer Type&nbsp;&nbsp;
        	
        	<span class="lead">
        	
        		Individual
        		
        	</span>
        	
        </p>
      
      	
      		
        <p><?php echo error_name($key); ?>&nbsp;&nbsp;
        	
        	<span class="lead">
        	
        		<?php echo (!empty($customer_data[0]->$key) ? $customer_data[0]->$key:$na);?>
        		
        	</span>
        	
        </p>
        
        <?php } ?>
        
       
        </div>
   
   </div>