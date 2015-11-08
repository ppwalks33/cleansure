<!-- Grey container Panel -->
<?php echo form_open(current_url()); ?> 

<?php
	/* ---------------------------------------------------------------
	*  Need a class switch here on <div class="box"> tag
	 * 
	 * Options
	 * --------------------
	 * Default       =   box-primary
	 * Form Error    =   box-danger
	 * Form Success  =   box-success
	 * --------------------
	 * 
	 * Never remove the box class only swap the second class!!!!
	 * ---------------------------------------------------------------
	*/
?>
<div class="box box-primary">
	<div class="box-header with-border">
		 <h3 class="box-title">Add New Suubcontractor Contact</h3>
		 <div class="pull-right backBtnContainer">
		 	
		 	<!-- add link back to section overview -->
		 	<a href="/clientarea/subcontractors/" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left"></i> Back To Overview Panel</a>
		 	
		 </div>
		 
    </div><!-- /.box-header -->
    <div class="box-body">
    	<div class="topColPad">
    		<div class="row">
    			<div class="col-md-4">
    				<?php $this->load->view('modules/title'); ?>
    				<?php $this->load->view('modules/company_details'); ?>
    			</div>
    			<div class="col-md-4"><?php $this->load->view('modules/contact_details'); ?></div>
    			<div class="col-md-4"><?php $this->load->view('modules/address'); ?></div>
    		</div>
    	</div>
    	
    	<?php 
/*
   $views = array('company_details', 'title', 'contact_details',  'address');

	for($i=0;$i<4;$i++)
	
	{
		
	//  echo sprintf($this->lang->line('h4'), ucwords(str_replace('_', ' ', $views[$i])))."\n";
	   
      $this->load->view('modules/'.$views[$i]);
	  
	}
	  
	*/ 

 ?>
    	
    </div>
     <div class="box-footer">
    	<?php echo form_button(array('type' => 'submit', 'class' =>'btn btn-success pull-right', 'content' => '<i class="glyphicon glyphicon-user"></i> Create New Contact')); ?>
    </div>
</div>

<?php echo form_close(); ?>

