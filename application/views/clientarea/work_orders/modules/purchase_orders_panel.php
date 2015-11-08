 <h3 class="tab-body-title">Recent Purchase Orders</h3>

<div class="box box-success box-solid collapsed-box">
	<div class="box-header with-border">
			<button data-widget="collapse" class="btn btn-box-tool btn-block collapse-search" style="font-size:21px; padding:0px 5px;">
				
					<span class="glyphicon glyphicon-search"></span>  Click to search purchase orders</button>
	</div><!-- /.box-header -->
    <div class="box-body" style="display: none;">
    	
    	<?php 
		 /* Search is broken so I've temporary commented it out so Paul can first fix the main contain table */
		  $this->load->view($modules.'purchase_order_search'); 
		 ?>
    </div><!-- /.box-body -->
</div>
 
 
 <?php
 // echo "<div class=\"panel-group\" id=\"accordion\">\n";
	
//	 echo "<div class=\"panel panel-default\">\n";
		
//	 echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'shopping-cart', 'title' => "Recent Purchase Orders"),  'i_header', 1); 
		
//	 echo "<div id=\"collapse1\" class=\"panel-collapse collapse in\">\n";
		
//	 echo "<div class=\"panel-body\">\n";	
	 
	// 	$this->load->view($modules.'purchase_order_search');
	 	
	 $this->load->view($modules.'purchase_orders_table');
		
//	 echo "</div>\n";
	
//	 echo "</div>\n";
	
//	 echo "</div>\n";
	
//	 echo "</div>\n";
	 
	 ?>