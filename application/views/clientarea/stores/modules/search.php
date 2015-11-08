<div class="row">
	
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	
	
	<?php 
	     
	   //     echo $this->lang->line('search_stores');
	   
			echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><p>Please Select a filter below...</p></div>';
			
			echo form_open('/clientarea/stores/search');
			
			
			
			echo '<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">'; 

				
					echo form_label('Order Ref..');
					
					echo form_input(array('name' => 'ref', 'class' => 'form-control', 'placeholder' => 'Please Enter Order Number', 'value' => NULL));
				
				
				echo "</div>";
			
			echo '<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">'; 
			
			echo'<div class="form group"><label>Company</label>';
				
				$this->load->view('/clientarea/stores/modules/customer_select', array('notext' => true));
				
			echo '</div>';
			
			echo "</div>";
			
			echo '<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">'; 

				
					echo form_label('Date From..');
					
					echo form_input(array('name' => 'date_from', 'class' => 'form-control datepicker', 'placeholder' => 'Date From..', 'value' => NULL, 'style' => 'width:100%;'));
				
				
			echo "</div>";
				
			echo '<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">'; 

				
					echo form_label('Date To..');
					
					echo form_input(array('name' => 'date_to', 'class' => 'form-control datepicker pull-left', 'placeholder' => 'Date To..', 'value' => NULL, 'style' => 'width:100%;'));
				
				
				echo "</div>";
				
				
				
				echo '<div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">'; 
				
		
					echo '<div class="form-group" style="margin-top:30px;">';
					echo form_label(form_checkbox('csv',true,NULL).' CSV?');
					
					echo '</div>';
				
				echo "</div>";
				
				echo '<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">'; 
				
				echo '<div class="topPad">';
				
					echo form_button(
					
									array(
									
											'type'    => 'submit',
											
											'class'   => 'btn btn-block btn-success',
											
											'content' => '<span class="glyphicon glyphicon-search"></span> Search'
											
											
											
											)
									
									);		
				
				echo "</div></div>";
	
		    echo form_close();
			
			echo "</div>";
			
			?>
            <?php 
			
			
			/* ------------------------------------------------------------------------------------------------ //
			//                                                                                                  //
			// COMMENT OUT THIS SECTION, PLEASE READ BELOW COMMENT TO WHERE TO FIND THE SOURCE CODE             //
			//                                                                                                  //
			// I've moved this to the Clientarea_stores.php and wrap an if statment around it                   //
			// it now lives in the class box-footer should you need to edit this section.                       //
			//                                                                                                  //
			// PLEASE BE AWARE THE MENU.phg file is no longer in use                                            //
			// If you wish to edit the buttons read above comment to find them in the Clientarea_stores.php     //
			//                                                                                                  //
			// ------------------------------------------------------------------------------------------------ //
			
			
			echo "<div class=\"col-xs-12 col-md-12\">";
			
			$this->load->view('clientarea/stores/modules/menu');
			
			echo "</div>";
		*/
	 ?>
	
</div>
