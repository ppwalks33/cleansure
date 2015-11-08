
<?php 

		$atts = array(

					array('name' => 'password', 'class' => 'form-control', 'placeholder' => 'Account Password'),
					
					array('name' => 'password_confirm', 'class' => 'form-control', 'placeholder' => 'Confirm Password')
					
					);
		// add has-error class only if the form element has an error --> 
		echo '<div class="form-group has-error"><label for="accountPassword">Account Password</label>';			
		echo form_password($atts[0])."\n";
		
		// Example of how to style an error message
		echo '<span class="control-label errorMessagePad"><i class="fa fa-warning"></i> Error message goes here</span>';
		echo '</div>';
		
		echo '<div class="form-group"><label for="confirmPassword">Confirm Password</label>';		
		echo form_password($atts[1])."\n";
		echo '</div>';
		
?>