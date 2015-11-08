<?php

echo "<div class=\"panel-group\" id=\"accordion\">\n";
	
	 echo "<div class=\"panel panel-default\">\n";
		
	 echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'user', 'title' => "Create A Job"),  'i_header', 1); 
		
	 echo "<div id=\"collapse1\" class=\"panel-collapse collapse jobs\">\n";
		
	    $this->load->view($modules.'book_job');
					
	echo "</div>\n";
					
					
	echo "</div>\n";
					
					
					echo "<div class=\"col-xs-12 col-lg-6\">\n"; 
				
					
					echo "<div class=\"panel panel-default staffPanel\">\n";
					
					echo $this->cleansure->lang_header('Job Attributes...'.'', 'company_information');  
					
					$this->load->view($modules.'add_staff');
					
					echo "</div>\n";
					
					echo "</div>\n";
					
					echo "</div>\n";
				
				
				echo "</div>\n";
	
	 
	 echo "</div>\n";
	
	echo "</div>\n";
	
	echo "</div>\n";
	
	echo "</div>\n";
	

?>