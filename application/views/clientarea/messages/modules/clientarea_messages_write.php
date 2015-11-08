<?php

	echo "<select name=\"reciptent_id\" class=\"form-control selectpicker show-tick\" >\n";
	
	foreach($members as $key => $memb)
	
	{
		
		echo "<option value=".$key.">".$memb."</option>\n";
	}
	
	echo "</select>\n<br><br>\n";
	
	echo form_input(array('name' => 'title', 'class' => $class, 'placeholder' => 'Message Subject...'))."<br>\n";
	
	echo form_textarea(array('name' => 'message', 'class' => $class.' wisy', 'placeholder' => 'Message Body...'))."<br>\n";

?>