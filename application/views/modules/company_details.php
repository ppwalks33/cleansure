<?php

	if($arr == true)
				
				{
					
				$fields = array('company_name', 'company_number', 'vat_number');
				
				foreach( $fields as $f)
				
				 {
					
					$array =  ${''.$f.''}['name'].'[]';
				
				    ${''.$f.''}['name'] = $array;
					
				 }
				 
				 $array='[]';
					
				
				}
				
			  echo '<div class="form-group"><label for="exampleInputEmail1">'.error_name($company_name['name']).'</label>';
			  
              echo form_input($company_name)."\n"; 
			  
			  echo form_error('company_name');
			  
			  echo "</div>";
			  
			  echo '<div class="form-group"><label for="exampleInputEmail1">Company Type</label>'; 
			   
			  echo form_dropdown('company_type'.($arr == true ? '[]' : NULL), $c_opts ,(!empty($row_data)  ? $row_data->company_type:NULL), "class='".$class.(form_error('company_type') ? " error ":NULL)."' data-name='company_type'")."\n"; 
			  
			  echo form_error('company_type');
			  
			  echo "</div>";
			  
			  ?>
			  
			  
<div class="hide">		  
	<div class="form-group"><label for="exampleInputEmail1">Company Number</label>
		<?php echo form_input($company_number)."\n"; ?> 		  
	</div>
			  
	<div class="form-group"><label for="exampleInputEmail1">Vat Number</label>
		<?php echo form_input($vat_number)."\n"; ?>
	</div>	  
</div>	


































<?php
/*
	if($arr == true)
				
				{
					
				$fields = array('company_name', 'company_number', 'vat_number');
				
				foreach( $fields as $f)
				
				 {
					
					$array =  ${''.$f.''}['name'].'[]';
				
				    ${''.$f.''}['name'] = $array;
					
				 }
				 
				 $array='[]';
					
				
				}
				

              echo form_input($company_name)."\n"; 
			  
			  echo form_error('company_name');
			  
			  echo "<br>";
			   
			  echo form_dropdown('company_type'.($arr == true ? '[]' : NULL), $c_opts ,(!empty($row_data)  ? $row_data->company_type:NULL), "class='".$class.(form_error('company_type') ? " error ":NULL)."' data-name='company_type'")."\n"; 
			  
			  echo form_error('company_type');
			  
			  echo "<br>";
			  
			  echo form_input($company_number)."\n"; 
			  
			  echo "<br>";
			  
			  echo form_input($vat_number)."\n"; 
			  
			  echo "<br>"; 
			  
	*/		  
?>