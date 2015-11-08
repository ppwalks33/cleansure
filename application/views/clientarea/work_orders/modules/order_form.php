<?php 
		
		
			 echo form_hidden('company_id', $ids[0]);
	   
	  		 echo form_hidden('site_id', $ids[1]);
		
			$checkboxes = array('stores_order', 'custom_order');
		
				for($i=0;$i<count($checkboxes);$i++)
		
				{
					$label = '&nbsp;'.ucwords(str_replace('_', ' ', $checkboxes[$i]));
			
					$n = $i + 1;
			
		   			echo form_label(form_radio('order_type',$n, ($i==0?true:false)).$label,Null, array('class' => 'checkbox-inline'));
			
				}
			
			echo "<br><br>";
			
			echo sprintf($this->lang->line('h5'), 'Please Select A Stores Order');
			
			echo form_dropdown('order_id',(is_array($orders) ? $orders:array('#'=>'No Orders available for this customer')), NULL, 'class="form-control '.$this->dropdown.'"', 'ref');
			
			echo "<br>";
		
		echo "<br><br><br><br><br>";
		
		echo "<div class=\"break\"></div>";

		
		echo sprintf($this->lang->line('h5'), 'Please Select A Supplier');
			
			echo form_dropdown('supplier_id',(is_array($suppliers) ? $suppliers:array('#'=>'No Suppliers Have Been Entered..')), NULL, 'class="form-control '.$this->dropdown.'"', 'company_name');
		
			echo "<br>";
			
			
		echo "<div class=\"break\"></div>";
		
		
			
			echo sprintf($this->lang->line('h5'), 'Any Notes');
			
			echo form_textarea(array('name' => 'notes', 'class' => 'disabled form-control wisy'));
			
			
			echo "<br><br>";
			
			echo "<div class=\"row\">";
			
			echo "<div class=\"col-xs-12 col-md-6\">";
			
			echo form_label('Cost');
			
			echo "<div class=\"form-group\">
    
    				<label class=\"sr-only\" for=\"cost\">Cost (in GBP)</label>
    	
    					<div class=\"input-group\">
      
      						<div class=\"input-group-addon\">£</div>
      
      							<input type=\"text\" class=\"form-control\" id=\"cost\" name=\"cost\" placeholder=\"0.00\">

    						</div>
    						
  						</div>
  						
  					</div>";
			
			echo "<div class=\"col-xs-12 col-md-6\">";
			
			echo form_hidden('tax', false);
			
			echo '<span class="checkbox_down">'.form_label(' Including VAT '.form_checkbox('tax', true, NULL),'cost').'</span>';
						
			echo "</div>";
			
			echo "</div>";
			
?>