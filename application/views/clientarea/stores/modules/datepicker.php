<div class="row">

          <div class="col-xs-6 MyDate">
            
            <span class="col-xs-12 datepicker-date">
            	
            	
            	
            	<?php 
            	
            		$arr = array( 'class' => 'datebutton-input datepicker', 'placeholder' => 'dd/mm/yyyy', 'name' => 'date[]', 'value' => (isset($row_data)  ? remove_time($row_data->date):NULL));
				
					echo form_input($arr);
					
					?>
            	
            	</span>
            	
          </div>
          
          <div class="col-xs-6">
          	
            <a href="#" class="btn btn-danger pull-right datebutton">
            	
            <span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Choose Date</a>
            
          </div>
          
        </div>