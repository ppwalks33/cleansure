
<?php 

	$customer_folder = "clientarea/customers/modules/"; 
	
	$folder = "clientarea/sites/modules/";
	
	echo $this->lang->line('sites_profile_header'); 
	
	echo "<br>";
	
	echo $this->lang->line('prompt');
	
	echo "<br>";
	
	?>

<div class="row">
	
  <div class="col-xs-12 col-lg-4">
  	
    <div class="panel panel-default">
    	
     <?php  
     
     	echo $this->cleansure->lang_header('Company Information', 'company_information');  
        	
        $this->load->view($customer_folder.'customer_information'); 
        
      ?>
       
    
    </div>
    
    
    <div class="panel panel-default">

    	 <?php  
    	 
    	 		echo $this->cleansure->lang_header('Site Address', 'company_information');  

				$this->load->view($customer_folder.'customer_address'); 
				
		?>
   
    </div>
    
    
    


  </div>
	
  <div class="col-xs-12 col-lg-4">
    
    
   <div class="panel panel-default">

      <div class="panel-heading">

        <h3 class="panel-title">&raquo;&nbsp;&nbsp;Site Contacts</h3>

      </div>
    
      <div class="panel-body">
        
        <?php $this->load->view($folder.'site_contacts');  ?>
  
    </div>
    
    
  </div>
	
  <div class="col-xs-12 col-lg-4">
  	
  	<?php $this->load->view($folder.'site_attributes');  ?>
        
      </div>

      </div>
      
      
  
    </div>


	
