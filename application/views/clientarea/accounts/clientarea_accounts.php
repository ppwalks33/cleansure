<div class="box">
	<div class="box-header with-border">
		 <h3 class="box-title">User Accounts</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	<?php
    	if($data->accounts < 2 || $data->user_type == 1)
		
		{
	
			$this->load->view($modules.'menu');
	
		}
		
		 if(is_array($accounts))
	 
	 {
	 	
		$this->load->view($modules.'users_table', array('accounts' => $accounts));
		
	 }
	
    	?>
    </div>
</div>    
    




<?php
	
	// echo sprintf($this->lang->line('user_heading'), 'User Accounts &amp; Permissions');
	
	if($this->session->flashdata('info')) {
				
			/*	
				echo "<div class=\"alert alert-info\" role=\"alert\">
						
						<span class=\"glyphicon glyphicon-question-sign\"></span>".$this->session->flashdata('info')."
   				
   								
					</div>";	
			 
			 */
			}
	
	
	// echo "<div class=\"panel-group\" id=\"accordion\">\n";
	
	// echo "<div class=\"panel panel-default\">\n";
		
	// echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'user', 'title' => "User Accounts"),  'i_header', 1); 
		
	// echo "<div id=\"collapse1\" class=\"panel-collapse collapse in\">\n";
		
	// echo "<div class=\"panel-body\">\n";
	 
	
	 
	// echo "</div>\n";
	
	//echo "</div>\n";
	
	//echo "</div>\n";
	
	// echo "</div>\n";
	
	
	
	?>
