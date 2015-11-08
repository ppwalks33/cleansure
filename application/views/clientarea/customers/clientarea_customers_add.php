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
		 <h3 class="box-title"><i class="fa fa-briefcase"></i> Customer Information - Step 1 of 3</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
   
       <div class="row">
    		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
            <label>Customer Type</label>
    			<?php 
      	
      	  			echo form_dropdown('type', $c_type,'Mr', "class='".$class." type'")."\n"; 
       			?>
                </div>
			<?php  $this->load->view('modules/title'); ?>
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
		 <h3 class="box-title"><i class="fa fa-building"></i> Company Information - Step 2 of 3</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			 <?php $this->load->view('modules/company_details'); ?>
		</div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        	<?php  $this->load->view('modules/address'); ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        	<div class="form-group">
            
            <?php /*
        	<label class="checkbox">
        	
        	<?php 
        	
        	$data = array(
    						'name'     => 'cust_dupe',
    						'class'    => 'cust_dupe',
    						'value'    => TRUE,
    					);


			echo form_checkbox($data);

			?>
        	
         &nbsp;<strong>Same as <span>Customer</span> Contact Details?</strong>
          
        </label>
		*/
		?>
        <label style="display:block;">If Contact Details are the same</label>
        <button class="btn btn-warning"><i class="fa fa-plus"></i> Duplicate Details</button>
        </div>
        <?php  $this->load->view('modules/contact_details'); ?>
        </div>

	</div>
</div>


<!-- Grey container Panel -->
<div class="box box-primary">
	<div class="box-header with-border">
		 <h3 class="box-title"><i class="fa fa-map-marker"></i> Site Information - Step 3 of 3</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	<div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            	<label style="display:block;">If Contact Details are the same</label>
        		<button class="btn btn-warning"><i class="fa fa-plus"></i> Duplicate Details</button>
        	</div>
        </div>
    	</div>
        <div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        	
				<div class="cc_dupe">
        			<?php  $this->load->view('modules/contact_details'); ?>
        
        		</div>
		</div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
          <?php  $this->load->view('modules/address'); ?>
        
        </div>
    </div>
    </div>
    
    <div class="box-footer">
    <a href="/nimda/customers.php" title="Create Customer"><button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"></i> Create Customer</button></a>
    </div>
</div>


<?php echo form_close(); ?>

