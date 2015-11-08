
<?php


	$yn = array(false,true);	
	
	echo form_label('Any Convictions');
	
	echo form_dropdown('conviction',$yn, (isset($row_data) ? $row_data->conviction:NULL), "class='".$class."'")."\n<br>\n";
	
	$ta = array('class' => 'form-control comment', 'rows' => '3', 'name'=> 'comment', 'value' => (isset($row_data) ? $row_data->comment:NULL),  'disabled' => 'false');
	
	if(isset($row_data))
	
	{
		
		$ta = array_slice($ta, 0, -1);
	}
	
	echo form_label('Description');

	echo form_textarea($ta);
	
	echo "<br>\n";
	
	if(isset($row_data) && $row_data->signiture == false)
	
	{
		echo "<br>\n";
		
		echo "<label class=\"checkbox\">\n
		
		       ".form_checkbox('signiture', true)."<strong> Have they signed to say this is an accurate statement?</strong>
		
             </label>\n";
	}

?>