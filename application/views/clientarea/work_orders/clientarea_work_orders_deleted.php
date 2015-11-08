<?php

      $type = $this->session->userdata('location');
	  
	  if($delete == true)
	  {
	  	
		echo "<div class=\"row\"\n><div class=\"col-xs-12 col-md-12\">\n";
		
	  	echo anchor('/clientarea/work_orders/'.($type == 1 ? 'purchase_orders':NULL), 
	  	
	  				span('share-alt').'&nbsp;&nbsp;Go Back', 
	  				
	  				array('title' => 'Go Back To Main Page', 'class' => 'btn btn-default pull-right'));
					
		echo "</div>\n</div><br>";
		
	  }


     echo "<div class=\"panel-group\" id=\"accordion\">\n";
	
	 echo "<div class=\"panel panel-default\">\n";
		
	 echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'trash', 'title' => "Deleted ".($type == 1 ? 'Purchase Orders':'Work Orders')),  'i_header', 1); 
		
	 echo "<div id=\"collapse1\" class=\"panel-collapse collapse in\">\n";
		
	 echo "<div class=\"panel-body\">\n";	
	 	
		$this->load->view($modules.($type == 2 ? 'work_orders_table': 'purchase_orders_table'),array('delete' => true));	
	 
	 echo "</div>\n";
	
	 echo "</div>\n";
	
	 echo "</div>\n";
	
	 echo "</div>\n";
	 ?>