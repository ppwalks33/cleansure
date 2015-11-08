<?php



	$this->load->view('modules/title');
	
	 echo form_dropdown('gender', $g_opts , $row_data->gender, "class='".$class.(form_error('gender') ? " error ":NULL)."'")."\n"; 
	 
	 echo "<br style=\"clear:both\"><br>\n";
	
	$this->load->view('modules/dob');
	
	echo "<br style=\"clear:both\"><br>\n";

 ?>