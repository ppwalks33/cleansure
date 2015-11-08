
<?php 

	//echo vsprintf($this->lang->line('h2_heading'), array('signal', 'Stock'));  
	
	
	/* THAT DOES NOT WORK FOR RESPONSIVE DESIGN HAVING TO CREATE PAGE TO GET VISUAL RIGHT */
	/*
	
	$rows = array('suppliers_menu' => 2, 'products' => 8, 'checkout' => 2);
	
	echo "<div class=\"row\">\n";
	
	foreach($rows as $view => $col)
	
	{
		
		echo "<div class=\"col-xs-12 col-md-".$col."\">\n";
		
		$this->load->view('clientarea/stores/modules/'.$view);
		
		echo "</div>\n";
	}
	
	echo "</div>\n";
	
	*/
	
	?>	

	
	
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
    
    	<?php $this->load->view('clientarea/stores/modules/suppliers_menu'); ?>
        <?php $this->load->view('clientarea/stores/modules/checkout'); ?>
    
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
		<?php $this->load->view('clientarea/stores/modules/products'); ?>
	</div>
</div>