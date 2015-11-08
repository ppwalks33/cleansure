<?php 

$cart_exists =  (array_key_exists('order', $this->session->all_userdata()) ? true:false);


echo form_open('#', array('autocomplete' => 'off')); 

?>

<div class="table-responsive">

<table class="table table-striped checkout">

<tr>
  <td width="80">QTY</td>
  <td>Item</td>
</tr>

<tbody>

<?php $i = 1; ?>

<?php 

   if (is_array($this->cart->contents()) && count($this->cart->contents()) > 0)
   
   {
	
	foreach ($this->cart->contents() as $items): 
	
	?>


	<tr id="<?php echo $items['rowid']; ?>">
		
	  <td>
	  	
	  	<?php echo form_hidden($i.'[rowid]', $items['rowid']).
	  	
		           form_hidden($i.'[original_stock]', $items['original_stock'] - $items['qty']).
	  	
		           form_hidden($i.'[product_id]', $items['target']).
		           
				   
	  
	  				 form_input(
	  				 
	  				 			array('name' => $i.'[qty]', 
	  				 			
	  				 				  'value' => $items['qty'], 
	  				 				  
	  				 				  'maxlength' => '3', 
	  				 				  
	  				 				  'class' => 'form-control cartQty col-xs-12', 
	  				 				  
									  
									  'data-qty' => $items['qty'],
									  
									  'data-target' => $items['target'],
									  
									  'data-row' => $items['rowid'],
									  
									  'data-order' => $i)
									  
									  ); 
									  
			    
								 if($cart_exists == true)
				 
									 {
				 							
				 						echo form_hidden('order_id', $this->session->userdata('order'));
					
									 } 
			echo'<div class="clearfix visible-block"></div>';
			 echo anchor('/clientarea/stores/remove_row/', 
			 		
			 			'<span class="glyphicon glyphicon-remove"></span>&nbsp;Remove', 
			 			
			 			array('data-target' => $items['rowid'], 'class' => 'btn topPadBtn btn-xs btn-danger removeRow', 'title' => 'Remove Row', 'data-id' => $items['target']));
	  
	  	  ?>
	  	 
	 </td>
	 
	  <td>
	  	
		<?php echo $items['name']; ?>

	  </td>
	  
	</tr>

<?php $i++; ?>

<?php 

	endforeach; 
	
	?>
	
	</tbody>
	
	</table>

     </div>
     
     <div class="row">
     	
     	<div class="col-xs-12 col-md-12 col-lg-12" id="companySelect"></div>
     	
     	<div class="clearfix"></div>
     	
     	
     	<div class="col-xs-12 col-md-12 col-lg-12" id="siteSelect"></div>
     
     	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right bottomPad">
	
			<?php echo anchor('#', 
		
							  '<span class="glyphicon glyphicon-trash"></span>&nbsp;Empty', 
								
								array('class' => 'btn btn-danger rightPadBtn empty', 'data-cart' => $cart_exists,
								
								       'data-order' => ($cart_exists == true ? $this->session->userdata('order'):false)
								       
									  )
									  
							); 
								
			?>
            
             <?php echo form_submit(array('class' => 'btn btn-success rightPadBtn process_order', 'data-cart' => $cart_exists, 'data-order' => ($cart_exists == true ? $this->session->userdata('order'):false), 'value' => 'Process')); ?>
			
		</div>
		


    </div>
    
   
	
	
	<?php
	
	} else { echo "</tbody></table></div>\n"; }
	
	?>

	

<?php echo form_close(); ?>