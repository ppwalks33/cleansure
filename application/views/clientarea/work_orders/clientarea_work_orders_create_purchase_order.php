
<?php

 echo"<div class=\"row\">\n";

 echo"<div class=\"col-xs-12 col-md-12\">\n";
 
 	echo anchor('/clientarea/'.$this->prefix.'/purchase_orders', 
 		
 				span('share-alt').'&nbsp;&nbsp;Back To Puchase orders', 
 				
 				array('class' => 'btn btn-default pull-right'));
 
 echo "<br><br></div></div>"; 
 
 echo "<div class=\"panel-group\" id=\"accordion\">\n";
	
	 echo "<div class=\"panel panel-default\">\n";
		
	 echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'shopping-cart', 'title' => "Create Purchase Order"),  'i_header', 1); 
		
	 echo "<div id=\"collapse1\" class=\"panel-collapse collapse in\">\n";
		
	 echo "<div class=\"panel-body\">\n";	
	 
	  echo "<div class=\"row\">\n";
	  
	  $this->load->view('clientarea/specifications/modules/site_select', array('header' => Null));
	 
	 	echo form_open(current_url(), array('class' => 'customer_form', 'data-after' => '/clientarea/work_orders/purchase_orders/'));
		
		 echo "<div class=\"col-xs-12 col-md-12 loader\" id=\"message\"></div>\n";
		
			 echo "<div class=\"col-xs-12 col-md-6\">\n";
			 
			 	echo sprintf($this->lang->line('h4'), 'Process Purchase Order?');
				
			  echo "<div class=\"p_o1 area\"></div>";	
			 
			 echo "</div>\n";
			 
			 echo "<div class=\"col-xs-12 col-md-6\">\n";
			 
			 echo "<div class=\"p_o2 area\"></div>";
			 
			 echo "</div>\n";
			 
			 echo "<div class=\"col-xs-12 col-md-12\">\n";
			 
			 echo "<div class=\"p_o3\"></div>";
			 
			 echo "</div>\n";
			  
			 echo "<div class=\"col-xs-12 col-md-12 sub hidden\">\n";
			  
			 echo form_button(array('type' => 'submit', 
			  
			  						 'class' => 'btn btn-primary btn-lg btn-block',
									 
									 'content' => '<span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Create Purchase Order'));
	 	
		echo "</div>\n";
		
		echo form_close();
		
		echo "<br style=\"clear:both;\">";
		
		echo "</div>\n";
	 
	 echo "</div>\n";
	
	 echo "</div>\n";
	
	 echo "</div>\n";
	
	 echo "</div>\n";
	 
	 ?>