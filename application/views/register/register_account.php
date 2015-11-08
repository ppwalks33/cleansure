<h1>Subscription Models</h2>
        <hr>
        
        <div class="list-group">
        	
        	<?php 
        	
        	if(is_array($packages)) { 
        		
        		foreach ($packages as $p) { 
        		?>
        	
          			<a href="#" class="list-group-item package" data-id="<?php echo $p['id'] ?>" data-package="<?php echo $p['code'] ?>">
          	
            
            			<h4 class="list-group-item-heading">Monthly @ &pound;<?php echo $p['recurringChargeAmount'] ?>/pcm</h4>
            
            				<p class="list-group-item-text"><?php echo $p['description']; ?></p>
            
          			</a>
          
         
          <?php 
				}
				
				} 
          
          else {
          	
			?>
			
			<h2>No Packages Availble Currently, Please call for further information</h2>
			
			<?php } ?>
        </div>
        <hr>

		<div id="payment_form">
			
			
		</div>
		