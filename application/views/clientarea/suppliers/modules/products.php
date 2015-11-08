
<?php $atts = array(

					array('name' => 'name', 'class' => 'form-control', 'placeholder' => 'Product/ Consumable Name...', 'value' => (isset($row_data) ? $row_data->name:NULL)),
					
					array('name' => 'case_qty', 'class' => 'form-control', 'placeholder' => 'Case Qty...', 'value' => (isset($row_data) ? $row_data->case_qty:NULL), 'maxlength' => '4', 'style' => 'width:50%;'),
					
					array('name' => 'qty', 'class' => 'form-control', 'placeholder' => 'Qty...', 'value' => (isset($row_data) ? $row_data->qty:NULL), 'maxlength' => '4', 'style' => 'width:50%;'),
					
					array('name' => 'cost', 'class' => 'form-control', 'placeholder' => 'Cost...', 'value' => (isset($row_data) ? $row_data->cost:NULL), 'maxlength' => '8', 'style' => 'width:50%;'),
					
					array('name' => 'price', 'class' => 'form-control', 'placeholder' => 'Price...', 'value' => (isset($row_data) ? $row_data->price:NULL), 'maxlength' => '8', 'style' => 'width:50%;'),
					
					array('name' => 'core_size', 'class' => 'form-control', 'placeholder' => 'Core size...', 'value' => (isset($row_data) ? $row_data->core_size:NULL), 'style' => 'width:50%;'),
					
					array('name' => 'rollsize', 'class' => 'form-control', 'placeholder' => 'Roll size...', 'value' => (isset($row_data) ? $row_data->roll_size:NULL), 'style' => 'width:50%;'),
					
					array('name' => 'length', 'class' => 'form-control', 'placeholder' => 'Length...', 'value' => (isset($row_data) ? $row_data->length:NULL), 'style' => 'width:50%;'),
					
					array('name' => 'width', 'class' => 'form-control', 'placeholder' => 'Width...', 'value' => (isset($row_data) ? $row_data->width:NULL), 'style' => 'width:50%;'),
					
					array('name' => 'weight', 'class' => 'form-control', 'placeholder' => 'Weight...', 'value' => (isset($row_data) ? $row_data->weight:NULL), 'style' => 'width:50%;'),
					
					array('name' => 'litres', 'class' => 'form-control', 'placeholder' => 'Litres...', 'value' => (isset($row_data) ? $row_data->litres:NULL), 'style' => 'width:50%;'),

					);
					
	
	for($i=0;$i<count($atts);$i++)
	
	{
		
		echo form_input($atts[$i])."<br>\n";
		
		if($i == 0)
		
		{
			
			echo form_dropdown('type', $type, (isset($row_data) ? $row_data->type:NULL) , 'class="'.$class.'"')."<br>\n";
		}
		
       elseif($i == 6)
	   
	   {
	   	
		 echo sprintf($this->lang->line('h4'), 'Measurments');
	   }
		
	}
	
	 echo sprintf($this->lang->line('h4'), 'Date Quoted');
	
	$this->load->view('modules/datepicker');
	
	echo "<br>\n<br>\n<br>\n<br>\n<br>\n<br>\n<br>\n";

?>
