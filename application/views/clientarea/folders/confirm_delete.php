<?php 

 	if($locked == true)
	
	{
		
		echo "<div class=\"alert\"></div>\n";
		
		echo sprintf($this->lang->line('h4'), 'Please Enter Your Password To Delete!');
		
		echo form_label('Folder Password:');
		
		echo "<div class=\"row\">

					<div class=\"col-lg-8\">\n";		
		
		echo form_password(array('name' => 'password', 'class' => $this->class, 'placeholder' => 'Please Enter Password'))."\n";
		
		echo "</div>\n</div>\n<br>\n";
		
		echo "<span class=\"error-text\" style=\"color:red;\"></span>\n<br>\n<br>\n";
		
	}

?>
<p>Please Confirm you would like to delete the folder? <br> <br>
	
	<small>All files within the folder will also be deleted!</small>
	
</p>

<br><br>

<div class"row">
	
	<div class="col-xs-12 col-md-6 confirm-delete">
		
		<?php echo anchor('#', 
		
						'Cancel &nbsp;<span class="glyphicon glyphicon-remove"></span>',
						
						array('class' => 'btn btn-default', 'data-dismiss' => 'modal')
						
						); ?>
						
	</div>
	
	<div class="col-xs-12 col-md-6 confirm-delete">
		
		<?php 
		
		$confirm_delete = array('class' => 'btn btn-default confirm_delete');
		
		if($locked == true)
		
		{
			
			$confirm_delete['disabled'] = true;
			
		}
		
		echo anchor('#', 
		
						'Delete Item &nbsp;<span class="glyphicon glyphicon-trash"></span>',
						
						$confirm_delete
						
						); ?>
		
	</div>
	
	
	<br><br><br><br>
	
	
</div>