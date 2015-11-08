
<?php 

	$this->load->view('/clientarea/customers/modules/customer_sites');

	echo anchor('/clientarea/sites/'.$company_id, 
	
				'Customer Sites Profile', 
				
				array('class' => 'btn btn-lg btn-primary btn-block', 'title' => 'Customer Sites Profile')
				
				);
				
	echo "<br><br>";
	
	echo "<div id='modalMessage'></div>";
				
	$this->load->view('clientarea/sites/modules/sites');
	
  ?>
  
