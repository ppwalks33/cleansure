<?php

  echo vsprintf($this->lang->line('h2_heading'), array('warning-sign', 'Confirm Delete - Put Back Stock'));
  
  echo "<p>Please choose from the options below:</p>";
  
  echo "<p>- <strong>Delete the order without putting the stock back into the system.</strong></p>";
  
  echo "<p>- <strong>Delete the order an put the stock back into the system.</strong></p>";
  
  echo anchor('/clientarea/stores/delete_order/'.$order_id.'/2/0', 

				'<span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Remove Order!', 
				
				 array('class' => 'btn btn-default confirmDelete', 'style' => 'width:100%;', 'data-action' => false)
				 
				)."<br><br>";

echo anchor('/clientarea/stores/delete_order/'.$order_id.'/2/1', 

				'<span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Destroy Order!', 
				
				 array('class' => 'btn btn-danger confirmDelete', 'style' => 'width:100%;', 'data-action' => true)
				)
  
  
  ?>