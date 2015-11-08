
<?php 

	$folder = "clientarea/customers/modules/"; 
	
	/* echo sprintf($this->lang->line('brief_heading'), $header.' Profile');  */
	
	?>


<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">


<!-- Grey container Panel -->
<div class="box box-primary">
	<div class="box-header with-border">
		 <h3 class="box-title"><i class="fa fa-map-marker"></i> Site Information</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	<div class="roqw">
        	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               <?php  $this->load->view($folder.'user_address');?>
        	</div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            	<?php  $this->load->view($folder.'user_contact_name'); ?>
           		<?php $this->load->view($folder.'user_contact'); ?>
            </div>
    	</div>
    </div>
</div>

</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">


<!-- Grey container Panel -->
<div class="box box-primary">
	<div class="box-header with-border">
		 <h3 class="box-title"><i class="fa fa-map-marker"></i> Site Information</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	<div class="roqw">
        	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <?php $this->load->view($folder.'customer_profile_attributes', array('folder' => $folder)); ?>
        	</div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <?php $this->load->view($folder.'supplier_profile_attributes', array('folder' => $folder)); ?>
            </div>
    	</div>
    </div>
</div>


</div>



</div>



<div class="row">

	
<?php  if(isset($customer_data[0]->individual) && $customer_data[0]->individual == true || $type == 8) : ?>
	
  <div class="col-xs-12 col-lg-4">
  	
    <div class="panel panel-default">
    	
    	
    	
     <?php  
     
     	echo $this->cleansure->lang_header($header.' Information', 'company_information');  
        	
        $this->load->view($folder.'customer_information'); 
        
      ?>
       <?php echo "xxx"; ?>
    
    </div>
    
    
    <div class="panel panel-default">
    	
    	

    	 <?php  
    	 
    	 		echo $this->cleansure->lang_header($header.' Address', 'company_information');  

				$this->load->view($folder.'customer_address'); 
				
		?>
   <?php echo "xxx"; ?>
    </div>
    
    <div class="panel panel-default">

        <?php  
        
        echo $this->cleansure->lang_header($header.' Contact', 'company_information'); 
    
         $this->load->view($folder.'customer_contact'); 
         
         ?>
  <?php echo "xxx"; ?>
    </div>
    


  </div>
	
	<?php  endif; ?>
	
  <div class="col-xs-12 col-lg-<?php echo (isset($customer_data[0]->individual) == true || $type == 8 ? '4':'6'); ?>">
  	
  	<div class="panel panel-default">
        <?php  
        
        	echo $this->cleansure->lang_header('Main Contact Name', 'company_information');  

   			 $this->load->view($folder.'user_contact_name'); 
   			
   		?>
    
    </div>
    
    <?php if($type == 7): ?>

    <div class="panel panel-default">

        <?php  
        
        	echo $this->cleansure->lang_header('Main Contact Information', 'company_information');  

   			 $this->load->view($folder.'user_contact'); 
   			 
   		?>
    
    </div>
    
    
    <div class="panel panel-default">

     
		<?php  
		
			echo $this->cleansure->lang_header('Customer Address', 'company_information'); 
			
			$this->load->view($folder.'user_address');
			
			?>
  
    </div>
    
    <?php endif; ?>
    
    
    <div class="panel panel-default">

        <?php  echo $this->cleansure->lang_header('Customer Related Files', 'company_information'); ?> 

      <div class="panel-body">
        
       <?php $this->load->view($folder.'customer_files'); ?>
    	
      </div>
  
    </div>
    
    
  </div>
  
   <?php 
   
   	if($type == 7)
	
	{
	
		$this->load->view($folder.'customer_profile_attributes', array('folder' => $folder));
		
	}
	
	elseif($type == 8)
	
	{
		
		$this->load->view($folder.'supplier_profile_attributes', array('folder' => $folder));
		
	}
   	
   	
   	
   	?>
	
 
      
 
  
    </div>


	
