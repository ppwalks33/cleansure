<div class="modal fade" id="cleansureModel">
	
  <div class="modal-dialog box box-primary">
  	
    <div class="modal-content">
    	
      <div class="modal-header with-border">
      	
      
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
      
        
        <h3 id="myModalLabel" class="modal-title sub-header"></h3>
        
      </div>
      
      <div id="formWrap">
      	
      	<?php // echo form_open_multipart('#', array('class' => 'form', 'role'=>'form', 'autocomplete' => 'off')); ?>
      
      <div class="modal-body">
      	
       
        
      </div>
      
      <div class="modal-footer">
      	
        <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        
		<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> Save Changes</button>        
        <?php   
        /* WHY IS THIS AN INPUT TYPE NOT A BUTTON??? */
       // echo form_submit(array('class' => 'btn btn-success', 'value' => 'Save Changes')); 
       ?>
        
      </div>
      
      <?php // echo form_close(); ?>
      
      
      </div>
      
    </div>
    
  </div>
  
</div>