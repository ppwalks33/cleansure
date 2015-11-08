<?php

	$this->load->view('clientarea/specifications/modules/site_select');
	
	echo form_open(current_url(), array('class' => 'customer_form'));
	
	$this->load->view($modules.'create_job');
	
	echo form_close();
	
?>