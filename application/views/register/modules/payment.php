<?php 

	echo form_open('https://clean-sure.chargevault.com/create/payment/module/hosted/planCode/'.$package.'', array('id' => 'payment_form')); 
	
	echo "<h2>".$package." Package</h2>";
	
	echo form_input($code);
	
	echo form_input($subscription);
	
	echo form_input($firstName);
	
	echo form_input($lastName);
	
	echo form_input($email);
	
	echo form_input($company);
	
	echo '<input type="hidden" name="subscription[method]" value="paypal" id="subscription-method" />';
	
	echo '<input type="hidden" name="subscription[ccFirstName]" id="subscription-ccFirstName" value="'.$data['first_name'].'">';
	
	echo '<input type="hidden" name="subscription[ccLastName]" id="subscription-ccLastName" value="'.$data['last_name'].'">';
	
	echo '<input type="submit" name="customer_form_submit" id="customer_form_submit" value="Continue to PayPal" class="btn btn-default pull-right">';
	
	echo '<br style="clear:both">';
	
	echo form_close();
	
	?>