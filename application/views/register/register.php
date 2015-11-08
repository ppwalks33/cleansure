<?php 

		if ($this->session->flashdata('message'))
	
			{
			
				echo "<div class=\"alert alert-success col-lg-12\">
	
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>".$this->session->flashdata('message')."
			
					</div>";
		}
 	
 		echo form_open($_SERVER['REQUEST_URI'], array('class' => 'form-signin', 'role' => 'form')); 
 	
      	echo $this->lang->line('signee');
		
	 ?>
      		
        <hr>
        
      	<label class="checkbox">
      		
          <?php echo  form_checkbox('director', 'accept', FALSE).$this->lang->line('directorConfirm'); ?>
          
        </label>
        
        <?php  echo form_error('director') ?> 
        
        <br>
        
        <?php echo $this->lang->line('signeeReq'); 
        	
			
              $this->load->view('modules/title');
			  
			  echo form_error('gender');
		
        	  echo form_dropdown('gender', $g_opts ,'', "class='".$class.(form_error('gender') ? " error ":NULL)."'")."\n"; 
        	
              echo "<br>\n";
			  
			  echo"<div class=\"row\">\n";
			  
			  echo $this->lang->line('dob');
        
              $this->load->view('modules/dob');
			  
			  echo "</div>\n";
        	
              echo "<br>\n";
			  
			  echo $this->lang->line('CompanyInfo')."\n"; 
			  
			  echo "<hr>";
			  
			  $this->load->view('modules/company_details');
			  
			  $this->load->view('modules/address');
			  
			  echo $this->lang->line('contact');
			  
			   echo "<hr>\n";
			   
			 $this->load->view('modules/contact_details');


		   ?>
    
       
     
        <br>
       <button class="btn btn-lg btn-primary btn-block" type="submit">Continue&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
        <br>
        
       <?php echo form_close(); ?>
       
   
      