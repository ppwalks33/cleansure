<?php

	if($data->customers < 2 || $data->user_type == 1)
		
		{
			
		 $atts = array('name' => 'site_name', 'class' => $class, 'placeholder' => 'Site Name...', 'value' => (!empty($row_data) ? $row_data->site_name:NULL));
		 
    	 echo form_input($atts);
	
		 echo "<br>\n";

		 echo $this->lang->line('add_site_model_header');

		 $this->load->view('modules/address'); 
		 
		 if($hideContact == NULL)
		 
		 {
		  	
		   echo $this->lang->line('add_site_model_contact');
		 	
		        $this->load->view('modules/title'); 
	
	       echo $this->lang->line('add_site_contact');
	   
	            $this->load->view('modules/contact_details'); 
				
		 }
		 
	
		}
		
?>
	
