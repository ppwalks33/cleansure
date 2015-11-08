<div class="panel-body">
	
	<?php
	
		$fields = array('start_date', 'finish_date', 'created');
		
		echo "<p>Job Type <span class=\"lead\">&nbsp;&nbsp;".($customer_data[0]->jobType == 1 ? 'Recurring':'One Shot')."</span></p>\n";
		
		for($i=0;$i<count($fields);$i++)
		
		{
			
			
			echo "<p>".ucwords(str_replace('_', ' ', $fields[$i]))."&nbsp;&nbsp; <span class=\"lead\">".format_date($customer_data[0]->$fields[$i])."</span>\n";
		}
		
		echo "<br><br>\n";
		
		echo sprintf($this->lang->line('h4'), 'Notes');
		
		echo $customer_data[0]->job_desc;
	
	?>

</div>