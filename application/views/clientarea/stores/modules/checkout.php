<div class="box box-success">
	<div class="box-header no-border">
    	<h3 class="box-title"><i class="fa fa-basket"></i> Checkout</h3>
         <div class='box-tools'>
          	<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
          </div>
    </div>
    <div class="box-body no-padding">
    
					


<?php

	//echo sprintf($this->lang->line('h4'), 'Checkout'); 
	
	echo "<div id=\"basket\">\n";
	
	echo $this->load->view('clientarea/stores/modules/basket');
	
	echo "</div>\n";
?>

	</div>
</div>