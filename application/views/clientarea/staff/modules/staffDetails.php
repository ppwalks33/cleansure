<?php

	 		/*  echo $this->lang->line('staffDetails');
			  
			  echo "<hr>\n";
      	*/
              $this->load->view('modules/title');
			  
			 
			  echo '<div class="form-group">';
			  
			  echo '<label>Gender</label>';
		
        	  echo form_dropdown('gender', $g_opts ,'', "class='".$class.(form_error('gender') ? " error ":NULL)."'")."\n"; 
			  
			  echo form_error('gender');
			  
			  echo '</div>';
        	
 
			 
			  echo '<div class="form-group">';
			  
			  echo '<label>Date Of Birth</label>';
			  
              $this->load->view('modules/dob');
			   
			  echo '</div>';
			  
			 
        	
             
			  
			
?>