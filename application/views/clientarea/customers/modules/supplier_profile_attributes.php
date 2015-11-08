 <div class="col-xs-12 col-lg-4">
    
      <div class="panel panel-default">
  	
       <?php echo $this->cleansure->lang_header($header.' Web Links', 'company_information'); ?>
    
      <div class="panel-body">
      	
     	<?php $this->load->view($folder.'supplier_slugs'); ?>
    
      </div>
      
    </div>
    
      <div class="panel panel-default">
  	
       <?php echo $this->cleansure->lang_header($header.' Products', 'company_information'); ?>
    
      <div class="panel-body">
      	
     	<?php $this->load->view($folder.'supplier_products'); ?>
    
      </div>
      
    </div>
    
    
 </div>