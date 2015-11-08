<?php

	  echo "<div class=\"panel-body\" >\n";
	 
	  echo "<div class=\"row\">\n";
	 
	  echo "<div class=\"col-xs-12 col-lg-12\">\n";
	 
	  echo sprintf($this->lang->line('h4'),' Work Order Costing')."\n";
	  
	  echo "</div>\n";
	  
	  echo "</div>\n";
	 
	 $this->load->view($modules.'wk_orders');
	 
	 
	 if(is_array($staff))
	 
	 {
	 	
	 	echo sprintf($this->lang->line('h4'), $data->company_name.' Staff Members')."\n";
	 
	 	$this->load->view($modules.'staff_select', array('staff' => $staff));
		
		echo form_button(array('type' => 'submit', 'content' => 'Create Work Order', 'class' => 'btn btn-default pull-right'));
	 
	 }
	 
	 else 
	 
	 {
		 
		$this->load->view('clientarea/modules/flashmessagewarning', array('warning' => 'No Staff have been added yet, we suggest you do that first!'));
	 }
					 
	 echo "</div>\n";

?>