<?php /* echo $this->lang->line('staffHeading'); */ ?>

<div id="message">

		<?php if ($this->session->flashdata('warning')) 

			{
 		
		
 				echo "<div class=\"alert alert-warning\" role=\"alert\">
		 
		    		 <span class=\"glyphicon glyphicon-info-sign\"></span>".$this->session->flashdata('warning')."
		 			
		 			</div>";
			}

		?>

</div>

<?php echo form_open($_SERVER['REQUEST_URI'], array('role' => 'form', 'class' => 'customer_form')); ?>

<!-- Grey container Panel -->
<div class="box box-primary">
	<div class="box-header with-border">
		 <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Personal Information - Step 1 of 3</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
   
       <div class="row">
       		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
             <?php $this->load->view('clientarea/staff/modules/staffDetails'); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <?php $this->load->view('modules/address'); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <?php $this->load->view('modules/contact_details'); ?>
            </div>
       </div>
       
    </div>
</div>   

<!-- Grey container Panel -->
<div class="box box-primary">
	<div class="box-header with-border">
		 <h3 class="box-title"><i class="fa fa-medkit"></i> Medical Details - Step 2 of 3</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
   
       <div class="row">
       		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <?php $this->load->view('clientarea/staff/modules/medical'); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <?php $this->load->view('clientarea/staff/modules/doctor');  ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
             <?php $this->load->view('modules/address'); ?>
            </div>
       </div>
       
    </div>
</div>  


<!-- Grey container Panel -->
<div class="box box-primary">
	<div class="box-header with-border">
		 <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Employment Information - Step 3 of 3</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
   
       <div class="row">
       		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            	<div class="form-group">
              		<label class="checkbox">
        	 			<?php echo form_checkbox('startToday', 1 , false).$this->lang->line('startToday'); ?>
          			</label>
                 </div>    
                  <?php $this->load->view('clientarea/staff/modules/staff_edit'); ?>
        		
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <?php
		
             $this->load->view('clientarea/staff/modules/convictions_checks'); 
			
			 $this->load->view('clientarea/staff/modules/dbs_check');  
	
			?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
            <label class="checkbox">

			<?php 
			
				$data = array(
    						  'name'        => '',
                              'id'          => 'financeOpen',
                              'class'       => 'openElement',
                              'value'       => false,
    						  'checked'     => false
     						  );
			
				echo form_checkbox($data).$this->lang->line('finance');
				
				?>

				 
		</label>
        
        
        <?php $this->load->view('/clientarea/modules/financial'); ?>
        </div>
         
            </div>
       </div>
       
    </div>
    <div class="box-footer">
     <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"></i> Create Staff Member</button>
       
    </div>
</div>  






<?php 

/* PAUL CODE BELOW


<div class="row">
	
  <div class="col-xs-12 col-lg-4">
  	
    <div class="panel panel-default">
    	
      <div class="panel-heading">
      	
        <h3 class="panel-title"><?php echo $this->lang->line('personalInfo'); ?></h3>
        
      </div>
      
      <div class="panel-body">
      
      <?php 
      
      	   $this->load->view('clientarea/staff/modules/staffDetails'); 
        
           echo "<hr>\n";
        
           $this->load->view('modules/contact_details'); 
        
           echo "<br>\n";
        
           echo $this->lang->line('staffPostal'); 
       
           $this->load->view('modules/address'); 
           
           ?>
         
        <br>
   
      </div>
    
    </div>

  </div>
	
  <div class="col-xs-12 col-lg-4">

    <div class="panel panel-default">

      <div class="panel-heading">

        <?php echo $this->lang->line('jobHeading'); ?>

      </div>
    
      <div class="panel-body">
        
        <?php echo $this->lang->line('employmentHeading'); ?>
        	
        <hr>
        
        <label class="checkbox">
        	
          <?php echo form_checkbox('startToday', 1 , false).$this->lang->line('startToday'); ?>
          
        </label>
        
        <br>
        
        
       <?php 
        	
        	$this->load->view('clientarea/staff/modules/staff_edit');
        	
        	echo $this->lang->line('convictions'); 
			
			echo "<hr>";
			
             $this->load->view('clientarea/staff/modules/convictions_checks'); 
			
			 $this->load->view('clientarea/staff/modules/dbs_check');  
            
             echo $this->lang->line('financial'); 
            
            ?>
        
        
        <hr>
        
         <label class="checkbox">

			<?php 
			
				$data = array(
    						  'name'        => '',
                              'id'          => 'financeOpen',
                              'class'       => 'openElement',
                              'value'       => false,
    						  'checked'     => false
     						  );
			
				echo form_checkbox($data).$this->lang->line('finance');
				
				?>

				 
		</label>
        
       <br>
        
         <div class="finance">

        
          <?php $this->load->view('/clientarea/modules/financial'); ?>
          
          
         </div>
          
        <br>
        
        <br>
    
      </div>
  
    </div>

  </div>
	
  <div class="col-xs-12 col-lg-4">
	
    <div class="panel panel-default">
  	
      <div class="panel-heading">
    	
        <?php echo $this->lang->line('medical'); ?>
      
      </div>
    
      <div class="panel-body">

      <?php 
      
      		echo $this->lang->line('medical_details'); 
			
			echo "<hr>";
      
      		$this->load->view('clientarea/staff/modules/medical'); 
      		
      		echo $this->lang->line('doctors')."\n";
			
			echo "<hr>\n";
			
			$this->load->view('clientarea/staff/modules/doctor'); 
      	?>
        
        <br>
        
        <br>
        
        <div id="medicalAddress">
        
          <?php $this->load->view('modules/address'); ?>
         
         </div>
        
        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Create Staff Member&nbsp;&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
        
        <br>
        
        <br>

      </div>
  
    </div>

  </div>
	
</div>
*/
?>
<?php echo form_close(); ?>
