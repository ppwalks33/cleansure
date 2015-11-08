<?php 

	
	echo sprintf($this->lang->line('tag_heading'), 'Recent Specification of Work'); 
	
	echo "<div id=\"message\"></div>\n";
	
	$this->load->view($modules.'menu');
	
	echo anchor((isset($tasks) ? base_url().'clientarea/specifications/complete/'.$tasks[0]['site_id']:''),'Save Specification', array('class' => 'btn btn-success pull-right', 'id' => 'specSaveRec'))."\n";
			
	echo "<br>\n<br>\n<br>\n";
	
	$this->load->view($modules.'areas');
	
	?>
