 <div class="col-xs-12 col-lg-<?php echo ($customer_data[0]->individual == true ? '4':'6'); ?>">
  	
  	<?php if($customer_data[0]->individual == false) 
  	
  	{
  		
		echo "<div class=\"panel panel-default\">\n";
		
		echo $this->cleansure->lang_header('Customer Information', 'company_information');  

   			 $this->load->view($folder.'individual_information');
		
		echo "</div>\n";
  	} 
	
	?>
	
    <div class="panel panel-default">
  	
      <div class="panel-heading">
    	
        <h3 class="panel-title">&raquo;&nbsp;&nbsp;Company Relationship</h3>
      
      </div>
    
      <div class="panel-body">
        
        <div class="company-details">
        <p>Supervisors:&nbsp;&nbsp;<span class="lead">2</span></p>
        <p>Staff:&nbsp;&nbsp;<span class="lead">25</span></p>
        <p>Contract Value:&nbsp;&nbsp;<span class="lead">£105,256.00 pa</span></p>
        <p>Contract Value:&nbsp;&nbsp;<span class="lead">£105,256.00 pa</span></p>
        </div>
        <br>
        
        <div class="btn-group pull-right">
        	
        	<?php if($data->$prefix < 2 || $data->user_type == 1)
		
		    {
		    	
				?> 
            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;&nbsp;Upload File</button>
            
            <?php } ?>
            
            
            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View Files</button>
            
        </div>
    
          </div>
      
        </div>
        
          <div class="panel panel-default">
  	
      <?php  
		
			echo $this->cleansure->lang_header('Customer Sites', 'company_information'); 
			
			$this->load->view($folder.'customer_sites');
			
			?>
    
     
        </div>

      </div>

      </div>