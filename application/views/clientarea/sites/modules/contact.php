
<?php 

	

	if($user != false)
	
	{

	$this->load->view('modules/title'); 
	
	echo $this->lang->line('contact_header');
	
	}
	
	
	
	$this->load->view('modules/contact_details');

?>