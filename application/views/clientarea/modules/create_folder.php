<?php

		$atts = array(
		
						array('name' => 'title', 'placeholder' => 'Name of Folder', 'class' => $this->class),
						
						array('name' => 'password', 'placeholder' => 'Password', 'class' => $this->class),
						
						array('name' => 'password_confirm', 'placeholder' => 'Confirm Password', 'class' => $this->class),
		
		);
		
		for($i=0;$i<count($atts);$i++)
		
		{
			
			  $label = str_replace('_', ' ', $atts[$i]['name']);
			
			  echo form_label(ucwords($label));
			  
			  if($i == 0)
			  
			  {
			
			     echo form_input($atts[$i])."\n<br>\n";
				 
				 echo "<hr>\n";
				 
				 echo $this->lang->line('folder_password');
				 
			  }
			  
			  else 
			  
			  {
				  
				  echo form_password($atts[$i])."\n<br>\n";
				  
			  }
			  
			  
		}

?>