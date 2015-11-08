<div class="row">
	
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;Search Purchase Orders</h4>
	
	<?php echo form_open('/clientarea/work_orders/search_work_orders'); ?>
	
	<div class="col-xs-12 col-md-2">
	
	<?php
	
		echo form_label('Customer');
		
		echo form_dropdown('customers', $customers ,'', "class='".$class."'", 'company_name')."\n";
	
	?>
	

</div>

<div class="col-xs-12 col-md-2">
	
	<?php echo form_label('Customer Site'); ?>

<div id="sites">
        	
       		<select class="form-control selectpicker show-tick" disabled>
        	
          		<option>Please Select Site First...</option>
          
        	</select>
        
   </div>
 
 </div>


<div class="col-xs-12 col-md-2">
	
	<?php
	
		echo form_label('Order Ref');
		
		echo form_input(array('name' => 'order_num', 'class' => 'form-control', 'placeholder' => 'Search For Order Ref..'))."\n";
	
	?>
	

</div>

<div class="col-xs-12 col-md-2">
	
	<?php
	
		echo form_label('Date From');
		
		echo form_input(array('name' => 'date_from', 'class' => 'form-control datepicker', 'placeholder' => 'Date From..'))."\n";
	
	?>
	

</div>

<div class="col-xs-12 col-md-2">
	
	<?php
	
		echo form_label('Date To');
		
		echo form_input(array('name' => 'date_to', 'class' => 'form-control datepicker', 'placeholder' => 'Date To..'))."\n";
	
	?>

</div>
	
<div class="col-xs-12 col-md-12">
	
	<?php echo form_button(array('class' => 'btn btn-lg btn-block btn-success','type' => 'submit', 'content' => span('search').' Search Purchase Orders')); ?>
	
</div>
	


	
	
	<?php echo form_close(); ?>
	
	
</div>

<br>
