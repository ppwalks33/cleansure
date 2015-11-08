<div class="row">
	
	<div class="col-xs-12 col-md-12">

<?php

echo $this->lang->line('confirm_delete');

echo anchor('/clientarea/stores/delete_order/'.$order_id.'/1/', 

				'<span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Empty Basket!', 
				
				 array('class' => 'btn btn-default confirmDelete', 'style' => 'width:100%;', 'data-action' => false)
				 
				)."<br><br>";

echo anchor('/clientarea/stores/delete_order/'.$order_id.'/2', 

				'<span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Destroy Order!', 
				
				 array('class' => 'btn btn-danger confirmDelete', 'style' => 'width:100%;', 'data-action' => true)
				)

?>

</div>

</div>