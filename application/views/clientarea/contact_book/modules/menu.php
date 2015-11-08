<?php


//    echo $this->lang->line('menu'); 
								
	echo anchor('/clientarea/'.$path, '<i class="fa fa-plus"></i> Add New '.ucwords($link).' Contact', array('class' => 'btn btn-success btn-sm bottomPadBtn', 'data-action' => false, 'data-title' => 'New Contact', 'title' => 'New Contact'))."\n";
    

	
?>