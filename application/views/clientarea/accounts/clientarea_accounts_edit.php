<?php
	/* -------------------------------------------------------------------------------
	*  Only ONE!!!! of the 3 alert warning show appear in this section as one time!
	*  -------------------------------------------------------------------------------
	*/
?>


<!-- alert information Panel this is loaded as default -->
<div class="callout callout-warning alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="icon fa fa-info-circle"></i> Remember</h4>
    Please Ensure you set the correct permissions upon creating the account. You can do so by clicking on the permissions link provided in the table.
</div>

<!-- Only show when Add User is successful -->
<div class="callout callout-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="fa fa-check"></i> New User Successfully Added</h4>
    Please Ensure you set the correct permissions upon creating the account. You can do so by clicking on the permissions link provided in the table.
    <div class="clearfix"></div>
    
    <!-- add link back to section overview -->
    <a href="/clientarea/accounts/" class="btn btn-primary topPadBtn"><i class="fa fa-arrow-left"></i> Back To Overview Panel</a>
</div>

<!-- Only show when we have errors -->
<div class="callout callout-danger alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="fa fa-ban"></i> Error</h4>
    Please Ensure you set the correct permissions upon creating the account. You can do so by clicking on the permissions link provided in the table.
</div>

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
		 <h3 class="box-title">Edit User Account</h3>
		 <div class="pull-right backBtnContainer">
		 	
		 	<!-- add link back to section overview -->
		 	<a href="/clientarea/accounts/" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left"></i> Back To Overview Panel</a>
		 	
		 </div>
    </div><!-- /.box-header -->
    	<div class="topColPad">

<?php

	echo form_open(current_url());

	$this->load->view($this->data['modules'].'new_user');
	
	// echo form_button(array('type' => 'submit', 'class' =>'btn btn-default', 'content' => 'Submit'));
	
	echo form_close();

?>
	</div>
    <div class="box-footer">
    	<?php echo form_button(array('type' => 'submit', 'class' =>'btn btn-success pull-right', 'content' => '<i class="glyphicon glyphicon-user"></i> Update User Account')); ?>
    </div>
</div>