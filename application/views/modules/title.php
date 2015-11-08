<div class="form-group">
	<label for="exampleInputEmail1">Title</label>
	<?php
		echo form_dropdown('title', $t_opts ,(!empty($row_data) ? $row_data->title:'Mr'), "class='".$class."'")."\n"; 
	?>
</div>

<div class="form-group">
	<label for="exampleInputEmail1">First Name</label>
	<?php
		echo form_error('first_name');     
    	echo form_input($first_name)."\n";
	?>
</div>

<div class="form-group">
	<label for="exampleInputEmail1">Surname Name</label>
	<?php
		echo form_error('last_name');
    	echo form_input($last_name)."\n"; 
	?>
</div>	

<?php         
/*
	echo form_dropdown('title', $t_opts ,(!empty($row_data) ? $row_data->title:'Mr'), "class='".$class."'")."\n"; 
       
    echo "<br>\n";
			  
    echo form_error('first_name'); 
        
    echo form_input($first_name)."\n"; 
        
    echo "<br>\n";
			  
    echo form_error('last_name');
        
    echo form_input($last_name)."\n";  
       		
    echo "<br>\n";
	*/
?>