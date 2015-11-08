 
 <?php 
 	
 	if($header != NULL)
	
	{
 	// echo sprintf($this->lang->line('panel_heading'), $header); 
	
	}
 	
 	?>
      
    <div class="<?php echo ($header != NULL ? 'panel-body':NULL);?> compSelect">
    	
       
    	<?php  echo form_open('', array('role' => 'form', 'class' => 'tets', 'id' => 'getCustomer', 'autocomplete' => 'off')); ?>
      	
      <div class="col-xs-12 col-sm-6">
      	
        <h4>Customer Information</h4>
        	
        <hr>
        
        <?php  echo form_dropdown('customers', $customers ,'', "class='".$class."' ".($header == NULL ? 'data-target ="purchase_order"':NULL), 'company_name')."\n";  ?>
        
        <br>
        
        <br>
        
      </div>
        
      <div class="col-xs-12 col-sm-6">
      	
        <h4>Site Information</h4>
        	
        <hr>
        
        <div id="sites">
        	
       		<select class="form-control selectpicker show-tick" disabled>
        	
          		<option>Please Select Site First...</option>
          
        	</select>
        
         </div>
        
        <br>
        
        <br>
        
      </div>
      
       
      
      <button class="btn btn-success pull-right selectComp" type="button"  disabled>
      	
        <span class="glyphicon glyphicon-ok"></span> Select Company &amp; Site
        
      </button>
      
      <a class="btn btn-danger pull-right reload disabled" href="<?php echo $_SERVER['REQUEST_URI']; ?>" style="margin-right:20px;">
      	
        <span class="glyphicon glyphicon-refresh"></span> Reset Form
        
      </a>
      
    
      
      
      
      <?php  echo form_close(); ?>
   
    </div>