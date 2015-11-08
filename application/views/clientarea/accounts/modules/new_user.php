<?php echo form_hidden('type', 5); ?>
<div class="box-body">
    	<div class="row">
    		<div class="col-md-4">
    			<!-- <h4>User Details</h4> -->
    			<?php $this->load->view('modules/title'); ?>
    		</div>
    		
    		<div class="col-md-4">
    			<!-- <h4>Contact Email</h4> -->
    			<?php 
    					echo form_hidden('user', true);
    					$this->load->view('modules/contact_details'); 
    			?>
    		</div>
    		
    		<div class="col-md-4">
    		<!-- <h4>Account Details</h4> -->
    			
    			<?php
    					echo '<div class="form-group"><label for="accountPassword">Username</label>';		
    					echo form_input(array('name' => 'username', 'class' => 'form-control nameCheck', 'placeholder' => 'Username...', 'value' => (isset($user) ? $user->username:NULL)))."\n";
						echo '</div>';
						if(isset($user))
		
						{
			
							echo "<p><strong>Please leave blank if you do not wish to edit password.</strong></p>\n<br><hr>";
						}
		
						$this->load->view($modules.'password');
    				?>
    		
    		</div>
     	</div>