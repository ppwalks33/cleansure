<h3 class="tab-body-title">Recent Work Orders</h3>

<div class="box box-success box-solid collapsed-box">
	<div class="box-header with-border">
			<button data-widget="collapse" class="btn btn-box-tool btn-block collapse-search" style="font-size:21px; padding:0px 5px;"><span class="glyphicon glyphicon-search"></span>  Click to search work orders</button>
	</div><!-- /.box-header -->
    <div class="box-body" style="display: none;">
    <?php  $this->load->view($modules.'work_orders_search'); ?>
    </div><!-- /.box-body -->
</div>
 
 
 
 <?php

 	// echo "<div class=\"panel-group\" id=\"accordion\">\n";
	
	//  echo "<div class=\"panel panel-default\">\n";
	
	// echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'briefcase', 'title' => "Recent Work Orders"),  'i_header', 1); 
		
	//  echo "<div id=\"collapse1\" class=\"panel-collapse collapse in\">\n";
		
	//  echo "<div class=\"panel-body\">\n";	
	 
	
	 	
		$this->load->view($modules.'work_orders_table');
		
	 
	// echo "</div>\n";
	
	// echo "</div>\n";
	
	// echo "</div>\n";
	
	// echo "</div>\n";
	 
	 ?>