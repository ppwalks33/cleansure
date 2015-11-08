<?php
	/* -------------------------------------------------------------------------------
	*  Only ONE!!!! should show in this section as one time!
	*  -------------------------------------------------------------------------------
	*/
?>

<!-- Only show when Add User is successful -->
<div class="callout callout-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="fa fa-check"></i> New User Successfully Added</h4>
    Please Ensure you set the correct permissions upon creating the account. You can do so by clicking on the permissions link provided in the table.
    <div class="clearfix"></div>
    
    <!-- add link back to section overview -->
    <a href="/clientarea/contact_book/" class="btn btn-primary topPadBtn"><i class="fa fa-arrow-left"></i> Back To Overview Panel</a>
</div>

<!-- Only show when we have errors -->
<div class="callout callout-danger alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="fa fa-ban"></i> Error</h4>
    Please Ensure you set the correct permissions upon creating the account. You can do so by clicking on the permissions link provided in the table.
</div>


<?php

	$this->load->view($modules.'personal_contact', $this->data);

?>