<?php

	echo form_textarea(array('name' => 'job_desc', 'class' => 'form-control wisy', 'placeholder' => 'Job Description', 'value' => (isset($row_data) ? $row_data->job_desc :NULL)))."<br>\n";
	
?>