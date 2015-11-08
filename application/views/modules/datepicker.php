<div class='input-group date' id='datetimepicker1'>
	<input type='text' class="form-control" />
    <span class="input-group-btn">
       <button class="btn btn-warning datebutton"><span class="glyphicon glyphicon-calendar"></span> Choose Date</button>
   </span>
</div>

     
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    


<?php

/* Paul code */

/*

<div class="row">

          <div class="col-xs-6 MyDate">
            
            <span class="col-xs-12 datepicker-date">
            	
            	<input type="hidden" class="todaysDate" value="<?php echo date("m/d/Y");?>">
            	
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
 */
?>
