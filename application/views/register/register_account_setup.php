<?php 

	echo form_open($_SERVER['REQUEST_URI'], array('class' => 'registration-signin', 'role' => 'form'));
	
	echo $this->lang->line('account_header');
	
?>
	<hr>
	
      	<label class="checkbox">
         
      		
          <?php 
          
            echo form_error('signee');  
          
          	echo  form_checkbox('signee', 'accept', FALSE).$this->lang->line('account_signee'); 
          	
          	?>
          
     
        </label>
        
        <label class="checkbox">
         
      		
          <?php 
          
            echo "<br>".$this->lang->line('admin_confirm')."";
          
          	echo  form_checkbox('signee_check', 'true', TRUE).$this->lang->line('signee_check'); 
          	
          	?>
          
     
        </label>
     
			  
			  <?php
        	
        	  echo form_dropdown('title', $t_opts ,$data['title'], "class='".$class."'")."\n"; 
       
              echo "<br>\n";
			  
			  echo form_error('first_name'); 
        
        	  echo form_input($first_name)."\n"; 
        
              echo "<br>\n";
			  
			  echo form_error('last_name');
        
       		  echo form_input($last_name)."\n";  
       		
              echo "<br>\n";
			  
			  echo form_error('gender');
		
        	  echo form_dropdown('gender', $g_opts ,$data['gender'], "class='".$class.(form_error('gender') ? " error ":NULL)."'")."\n";
			  
			  echo "<h2>Contact Details</h2>\n<hr>\n";
			  
			  
			  $vals = array('email_address', 'daytime_telephone', 'mobile_telephone');
			  
			  $contact = array('email_address', 'daytime_telephone', 'evening_telephone', 'mobile_telephone');
			  
			  foreach ($contact as $c) 
			  
			  {
			  	
				 echo form_input(${''.$c.''})."\n"; 
				 
				 if(in_array($c, $vals))
				 
				 	{
				 	
					 	echo form_error($c);
				 	}
			  
			     echo "<br>";
			  }  
			  
			  echo "<h2>Login Information</h2>\n<hr>\n";
			  
			  echo form_error('username');
        
       		  echo form_input($username)."\n";  
			  
			   echo "<br>\n";
			  
			  echo form_error('password');
        
       		  echo form_input($password)."\n";  
			  
			   echo "<br>\n";
			  
			  echo form_error('password_confirm');
        
       		  echo form_input($password_confirm)."\n";  
			  
			  echo "<br>\n";
			   
			  echo form_error('pin');
        
       		  echo form_input($pin)."\n"; 
       		  
			   echo "<br>\n";
       		  
			  echo form_error('pin_confirm');
        
       		  echo form_input($pin_confirm)."\n";  
			  
			   echo "<br>\n";

			  ?>
			  
        <label class="checkbox">
        	
        	 <?php 
          
            echo form_error('signee_confirm');  
          
          	echo  form_checkbox('signee_confirm', 'accept', FALSE).$this->lang->line('signee_confirm'); 
          	
          	?>
       
        </label>
        <br>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Continue&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
        <br>
      </form>
      

    </div> <!-- /container -->