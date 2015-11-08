<?php

    echo form_open(current_url());
	
	$this->load->view($this->data['modules'].'add_supplier');
	 
	 echo form_button(array('type' => 'submit', 'class' =>'btn btn-default', 'content' => 'Submit'));
	 
	 echo form_close();

	

?>