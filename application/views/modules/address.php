<?php 
			  
	if($arr == true)
				
			{
					
				$fields = array('address_line_', 'city', 'postcode');
				
				foreach( $fields as $f)
				
				 {
				 	
					if($f == 'address_line_')
					
					{
						
						for($n=1;$n < 4; $n++)
						{
							
							$array =  ${''.$f.$n.''}['name'].'[]';
				
				            ${''.$f.$n.''}['name'] = $array;
							
						 }
					 }
					
					else 
					
					{
						
						$array =  ${''.$f.''}['name'].'[]';
				
				        ${''.$f.''}['name'] = $array;
						
						
					}
					
					
					
				 }
					
				
				}
			
			
?>


<div class="form-group">
	<label for="exampleInputEmail1">Address</label>
	<div class="input-group">
		 <input type="text" style="" placeholder="Wire this in..." class="form-control" data-name="address" value="" name="address">
		<span class="input-group-btn">
        	<?php
	  		echo anchor("#", "<span class=\"glyphicon glyphicon-search\"></span> Address Finder", array('Title' => 'Find Address', 'class' => 'btn btn-warning pull-right addressFinder', 'id' => 'addressFinder'));  
			?>
    	</span>
   </div>
</div>
<div class="form-group">
	<label for="exampleInputEmail1">Address Line 2</label>
	<input type="text" style="" placeholder="Wire this in..." class="form-control" data-name="address2" value="" name="address2">	
</div>	
<?php /*

			  echo "<div class=\"address\">\n";
			  
			
			  echo "<br>"; 
			  
			  echo "<br style=\"clear:both\">"; 
			  
			  for($i=1; $i < 4; $i++) {
			  	
			  echo form_input(${'address_line_' . $i})."\n"; 
				  
				  if($i == 1)
				  
				  {
				  	
					echo form_error('address_line_'.$i);
					
				  }
				 
			  echo "<br>"; 
				 
			  }
 */
 ?>
<div class="form-group">
	<label for="exampleInputEmail1">City/Town</label>			  
	<?php 
		echo form_input($city)."\n"; 
		
		echo form_error('city');
	?>
</div>	

<div class="form-group">
	<label for="exampleInputEmail1">Country</label>			  
	<?php 
		echo form_dropdown('county'.($arr == true ? '[]' : NULL), $counties_ops,(!empty($row_data) ? $row_data->county:''), "class='".$class."' data-name='county'", 'region')."\n"; 
	
	?>
</div>

<div class="form-group">
	<label for="exampleInputEmail1">Postcode</label>			  
	<?php 
		echo form_input($postcode)."\n"; 
			  
		echo form_error('postcode');
	?>
</div>	

