<?php

if($data->contact_book < 2 || $data->user_type == 1)

{

$string[0] = 'Click ';
			
			$string[1] = ' to add '.ucwords($ref).' to the system';
			
			switch($ref)
			{
				
				case "personal":
					
					echo $string[0].anchor('clientarea/contact_book/personal/', 'here', array('title' => 'Add '.ucwords($ref).' Contact', 'class' => 'trigger', 'data-title' => 'Add A Personal Contact', 'data-glyph' => 'book', 'data-action' => false)).$string[1];
					
				break;
					
			    case "staff":
					
					echo $string[0].anchor('clientarea/staff/add/', 'here', array('title' => 'Add '.ucwords($ref).' Contact')).$string[1];
					
				break;
					
				case "customer":
					
					echo $string[0].anchor('clientarea/customers/add/', 'here', array('title' => 'Add '.ucwords($ref).' Contact')).$string[1];
					
					
				break;
					
				case "suppliers":
					
					echo $string[0].anchor('clientarea/suppliers/', 'here', array('title' => 'Add '.ucwords($ref).' Contact')).$string[1];
					
					
				break;
			}
			
}

else 

{
	
	echo "<p>You do Not have Permission To add Contact Details</p>\n";
	
   }
			

?>