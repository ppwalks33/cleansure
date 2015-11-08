<?php

 			  $vals = array('email_address1', 'daytime_telephone', 'mobile_telephone');
			  
			  $contact = array('email_address', 'daytime_telephone', 'evening_telephone', 'mobile_telephone', 'fax_number');
			  
			  
			  $i=0;
			  
			  foreach ($contact as $c) 
			  
			  {
			  	
			  	$i++;
				
			
				
			  	if($arr == true)
				
				{
					
				$array =  ${''.$c.''}['name'].'[]';
				
				${''.$c.''}['name'] = $array;
				
				}

					/* Add to sort label of input forms */
				     echo '<div class="form-group"><label for="exampleInputEmail1">'.ucwords (str_replace('_', ' ', $c)).'</label>';
			  		 echo form_input(${''.$c.''})."\n"; 
					
				 
				 if(in_array($c, $vals))
				 
				 	{
				 	
					 	echo form_error($c.'[]');
				 	}
			  
			     echo "</div>";
			  }
			  
			  
?>























<?php
/*
 			  $vals = array('email_address', 'daytime_telephone', 'mobile_telephone');
			  
			  $contact = array('email_address', 'daytime_telephone', 'evening_telephone', 'mobile_telephone', 'fax_number');
			  
			  $i=0;
			  
			  foreach ($contact as $c) 
			  
			  {
			  	
			  	$i++;
				
			
				
			  	if($arr == true)
				
				{
					
				$array =  ${''.$c.''}['name'].'[]';
				
				${''.$c.''}['name'] = $array;
				
				}
				
					
			  		echo form_input(${''.$c.''})."\n"; 
							
					
				 
				 if(in_array($c, $vals))
				 
				 	{
				 	
					 	echo form_error($c.'[]');
				 	}
			  
			     echo "<br>";
			  }
			  
	*/		  
?>