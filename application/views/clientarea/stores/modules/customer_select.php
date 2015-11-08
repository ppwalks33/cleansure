 
 
 
 <?php
 
 		if(!isset($notext))
		
		{
 
 	       echo "<p>Please Select a Customer For the Order..</p>";
		   
		}
		
 
 	  echo form_dropdown('customers', $customers ,'', "class='".$class."'", 'company_name')."\n"; 
	  
	  
	   ?>