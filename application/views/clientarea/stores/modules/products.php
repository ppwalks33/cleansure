 <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Stores</h3>
                  
                  <div class="box-tools pull-right">
                  
                    <?php echo $stock_pag; ?>
                    
                    	
                  </div>
                  
                  
                  
                </div><!-- /.box-header -->
                <div class="box-body">




<div class="row">
	
	<?php 
	
			if(is_array($pageData) && count($pageData) > 0): 
				
			$type =array('Product', 'Consumable', 'Prod/ Cons');
			
			$rowCounter = 0;
			
			foreach($pageData as $p):
				
				$qty = (isset($checkedOut) && array_key_exists($p['prod_id'], $checkedOut) ? $p['qty'] - $checkedOut[$p['prod_id']]:$p['qty'])
				
		?>
				
                
                <?php
                
				if($rowCounter >= 4) {
						$rowCounter = 0;
						echo '</div>';
						echo'<div class="clearfix visible-block"></div>';
					
				}
				if($rowCounter == 0) {
					
				echo '<div class="row-fluid" style="position:relative;">';
                
				}
				
				?>
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					
                    <?php echo form_open('/clientarea/stores/add_stock/'.$p['prod_id'], array('class' => 'add_stock', 'autocomplete' => 'off' )); ?>
                <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $p['name']; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	<div class="table-responsive">
					     	
					     		<table class="table table-striped table-hover">
					     			
					     			<tbody>
					     				
					     				<tr><td>Type:</td><td><?php echo $type[$p['type']]; ?></td></tr>
					     				
					     				<tr><td>Case Qty:</td><td><?php echo ($p['case_qty'] > 0 ? $p['case_qty']:$na); ?></td></tr>
					     				
					     				<tr><td>Core Size:</td><td><?php echo ($p['core_size'] > 0 ? $p['core_size']:$na); ?></td></tr>
					     				
					     				<tr><td>Roll Size:</td><td><?php echo ($p['roll_size'] > 0 ? $p['roll_size']:$na); ?></td></tr>
					     				
					     				<tr><td>Cost:</td><td>&pound;<?php echo $p['cost']; ?></td></tr>
					     				
					     				<tr><td>Price:</td><td>&pound;<?php echo $p['price']; ?></td></tr>
					     				
					     				<tr><td>Quantity:</td><td><span id="s<?php echo trim($p['prod_id']); ?>">
					     					
					     							<?php echo $p['qty']; ?>
					     							
					     							
					     					 </span> in stock</td></tr>
					     				
					     			</tbody>
					     			
					     		</table>
					     	
					 </div>
                         
                    <?php 
					     
					     		
								
								echo form_input(array('name' => 'stock', 'type'=>'hidden', 'id' =>'q'.trim($p['prod_id']), 'value' => $p['qty']));
					     		
					     		echo form_hidden('item', $p['name']);
								
								echo form_hidden('original_stock', $p['qty']);
						
								
								
					  ?>
                                
                              
					
					
                
                </div>
                
                <div class="box-footer">
                
                
                <!--  start -->
                 
					    	<div class="form-group">
                            <label>Quantity</label>
					    	<?php echo form_input(array('name' => 'qty', 'id' => $p['prod_id'], 'class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12 bottomPad', 'placeholder' => 'Qty..')); ?>
					    	</div>
					    
					    	<!-- <span class="fa fa-arrow-up"></span>  -->
					    	<?php echo form_submit(array('value' => 'Update Stock', 'class' => 'btn btn-warning btn-xs bottomPad update_stock', 'name' => 'update_stock', 'data-stock' => $p['qty'], 'data-target' => $p['prod_id'])) ;?>
					    	
					    	<!-- <span class="fa fa-tick"></span> -->
					    	<?php 
					    	
					    		$checkout = array('value' => 'Check Out Stock', 'id' => 'c'.$p['prod_id'],  'class' => 'btn btn-success btn-xs bottomPad submit', 'name' => 'checkout_stock', 'data-stock' => $p['qty'], 'data-target' => $p['prod_id']);
								
								if($p['qty'] == 0)
								
								{
									
									$checkout['disabled'] = true;
									
								}
					    	
					    		echo form_submit($checkout);
					    		
					    	?>
					    	
					    	
					  
					    
					    
					    
					 
                <!-- end -->
                
                
                
                
                
                </div>
                </div>
                <?php echo form_close(); ?>
                    
                    
                    </div>
               
					
			<?php 
			
				$rowCounter++;
			
                endforeach;
			
				endif; 
				
				
				
				?>
					
		</div>		
				
	
			
            		
</div>

		</div>
        <?php
	echo "<div class=\"box-footer\"><div class=\"box-tools pull-right\">\n";
				
				echo $stock_pag;
				
				echo "</div></div>\n";
				
				?>
        </div>