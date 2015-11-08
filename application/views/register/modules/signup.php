  <?php
        	  echo form_dropdown('title', $t_opts ,$data['title'], "class='".$class."'")."\n"; 
       
              echo "<br>\n";
			  
			  echo form_error('first_name'); 
        
        	  echo form_input($first_name)."\n"; 
        
              echo "<br>\n";
			  
			  echo form_error('last_name');
        
       		  echo form_input($last_name)."\n";  
       		
              echo "<br>\n";
			  
			  echo form_error('gender');
		
        	  echo form_dropdown('gender', $g_opts ,$data['gender'], "class='".$class.(form_error('gender') ? " error ":NULL)."'")."\n";
			  
			  echo "<h2>Contact Details</h2>\n<hr>\n";
			  
			  
			  $vals = array('email_address', 'daytime_telephone', 'mobile_telephone');
			  
			  $contact = array('email_address', 'daytime_telephone', 'evening_telephone', 'mobile_telephone');
			  
			  foreach ($contact as $c) 
			  
			  {
			  	
				 echo form_input(${''.$c.''})."\n"; 
				 
				 if(in_array($c, $vals))
				 
				 	{
				 	
					 	echo form_error($c);
				 	}
			  
			     echo "<br>";
			  } 
			  
			 ?>