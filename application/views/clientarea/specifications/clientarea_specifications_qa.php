<?php 

	
	echo sprintf($this->lang->line('tag_heading'), 'Create a Quality Audit'); 
	
	?>

<br>

<div id="message">

		<?php if ($this->session->flashdata('warning')) 

			{
 		
		
 				echo "<div class=\"alert alert-warning\" role=\"alert\">
		 
		    		 <span class=\"glyphicon glyphicon-info-sign\"></span>".$this->session->flashdata('warning')."
		 			
		 			</div>";
			} elseif($this->session->flashdata('info')) {
				
				echo "<div class=\"alert alert-info\" role=\"alert\">
						
						<span class=\"glyphicon glyphicon-question-sign\"></span>".$this->session->flashdata('info')."
   				
   								
					</div>";	
			}

		?>

</div>
  	

    
   <?php 
   
   	if($skip == false)
	
	{
		
		echo "<div class=\"panel panel-default\">";
		
		 //We tell the top to skip this section from the template clientarea_specification_spec_qa
		
        $this->load->view($modules.'site_select');
		
		echo "</div>";
       
       
	} 
	   
     $this->load->view($modules.'menu_qa', array('skip' => $skip));
     
     ?>

<div class="panel-group" id="accordion">
	
  <div class="panel panel-default">
  	
     <?php echo $this->cleansure->lang_header('Hide / Show', 'interactive_header' , 1);  ?>
     
    </div>
    
    <div id="collapse1" class="panel-collapse collapse in">
    	
      <div class="panel-body" id="scores">
       
          <p>Your Score Will appear here...</p>
          
      </div>
      
    </div>
    
  </div>