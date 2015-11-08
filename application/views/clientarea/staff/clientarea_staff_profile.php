<?php
	
	echo "<h2 class=\"sub-header\"><span class=\"glyphicon glyphicon-briefcase\"></span>&nbsp;&nbsp;Staff Profile</h2>\n";
	
	$folder = "clientarea/staff/modules/";

	echo "<br>";
	
	echo $this->lang->line('prompt');
	
	echo "<br>";
	
	$modules = array('Personal Information' => 'staff_details_info', 'Contact Information' => 'staff_contact_info', 'Contact Information' => 'staff_address_info', 
	
					 'For Office Use' => 'staff_reference_info', 'Job Information' => 'staff_employment_info', 'Workwear' => 'staff_workwear_info', 'Criminal Convictions' => 'staff_conviction_info', 
					 
					 'Disclosure and Barring Service (DBS)' => 'staff_dbs_info', 'Finance Information' => 'staff_finance_info', 'Medical Information' => 'staff_medical_info',
					 
					 'Doctors Information' => 'staff_doctor_info');
					 
	echo "<div class=\"row\">\n";
	
	echo "<div class=\"col-xs-12 col-lg-4\">\n";
	
	$c=$i=0;
		
	foreach($modules as $title => $view)
	
	{
		$c++;
		
		if($c > 5) { $i++; }
		
		echo "<div class=\"panel panel-default\">\n";
		
		echo $this->cleansure->lang_header($title, ($c > 5 ? 'interactive_header' : 'company_information'), ($c > 5 ? $i:NULL)); 
           
               $this->load->view($folder.$view);
			   
	    echo "</div>";
		
		
		
		if($c == 3 || $c == 8)
		
		{
			
			echo "</div>\n";
	
            echo "<div class=\"col-xs-12 col-lg-4\">\n";
		}
		
		
	}
					 
		echo "</div>\n";
?>


	
  
  	
    