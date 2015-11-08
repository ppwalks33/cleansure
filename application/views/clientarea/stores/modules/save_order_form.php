<?php

	echo $this->lang->line('save_order_form');
	
	echo "<br><br>\n";
	
	echo form_label('Name the Order!');
	
	echo form_input(array('class' => $this->class, 'placeholder' => 'Name for the Order', 'name' => 'order_name'));
	
	echo form_hidden('order_id', $order_id);
	
	?>


