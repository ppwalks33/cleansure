<?php

if(is_array($staff))

{

	 foreach($staff as $s)
	 
	 {
	 	echo "<label class=\"checkbox-inline padRight\">\n";
		
		echo form_checkbox('staff_id[]', $s['staff_id'], NULL)."&nbsp;<strong>".$s['first_name']."&nbsp;".$s['last_name']."</strong>\n";
		
		echo "</label>";
		
	 }
	 
	 echo "<br>\n<br>\n";
	 
	 echo anchor('#', 'Configure Staff Members', array('class' => 'btn btn-info conStaff', 'title' => 'Configure Staff Members'));
	 
	 echo "<div id=\"times\"></div>\n";
	 
	 echo "<br>\n<br>\n";
	 
}

else {
	
	echo "<h3>No Staff Available In the System</h3>";
}
	 

?>