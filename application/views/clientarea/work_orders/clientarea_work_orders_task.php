<?php

	

	echo sprintf($this->lang->line('h2'), 'Task');
	
	echo "<div class=\"row\">\n";
	
	echo "<div class=\"col-xs-12 col-lg-4\">\n";
	
			echo "<div class=\"panel panel-default\">\n";
			
			echo $this->cleansure->lang_header('Customer Information', 'company_information');  
			
			$this->load->view('clientarea/customers/modules/customer_information', array('customer_data' => $customer_data)); 
			
			echo "</div>\n";
			
			
			echo "<div class=\"panel panel-default\">\n";
			
			echo $this->cleansure->lang_header('Customer Address', 'company_information');  
			
			$this->load->view('clientarea/customers/modules/customer_address', array('customer_data' => $customer_data)); 
			
			echo "</div>\n";
			
			
			echo "<div class=\"panel panel-default\">\n";
			
			echo $this->cleansure->lang_header('Customer Contact Details', 'company_information');  
			
			$this->load->view('clientarea/customers/modules/customer_contact', array('customer_data' => $customer_data)); 
			
			echo "</div>\n";
	
	echo "</div>\n";
	
	echo "<div class=\"col-xs-12 col-lg-4\">\n";
	
	
			echo "<div class=\"panel panel-default\">\n";
			
			echo $this->cleansure->lang_header('Job Credentials', 'company_information');  
			
			$this->load->view($modules.'credentials', array('customer_data' => $customer_data)); 
			
			echo "</div>\n";
	
	
			echo "<div class=\"panel panel-default\">\n";
			
			echo $this->cleansure->lang_header('Task Costings', 'company_information');  
			
			$this->load->view($modules.'costings', array('customer_data' => $customer_data)); 
			
			echo "</div>\n";
			
			
			
			
	
	echo "</div>\n";
	
	echo "<div class=\"col-xs-12 col-lg-4\">\n";
	
	echo "</div>\n";
	
	echo "</div>\n";


?>