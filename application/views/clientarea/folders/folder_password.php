<div id="alert"></div>

<p>Please enter your password to gain access to the folder or contact your administrator.</p>

<hr>

<div class="row">

<div class="col-lg-8">

<?php

    echo form_label('Folder Password');

	echo form_password(array('name' => 'password', 'class' => $this->class));

?>

</div>

</div>

<br>

<span class="error-text" style="color:red;"></span>

<br style="clear:both">
