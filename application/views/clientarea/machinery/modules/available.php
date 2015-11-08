<?php 

	if(count($available) > 0)
	
	{
	
        echo sprintf($this->lang->line('h4'), 'Available Machinery');
		
		echo form_hidden('hidden', false);
        
       
	
	foreach($machines as $m)
	
	{
			
		
			if(in_array($m->mach_id, $available))
			
			{		
				echo "<div class=\"checkbox padLeft\">\n<label>\n";
	
	            echo form_checkbox('machine_id[]', $m->mach_id, ($m->customer_id == $c_id && $m->site_id == $s_id ? TRUE:NULL)).$m->type."&nbsp;(".$m->identifier.")";
  
                echo "</label>\n</div>\n";	
				
			}
		
	}
	
	}

?>