

<div class="panel panel-default">
	
		<?php $this->load->view('clientarea/sites/modules/specification'); ?>
    
    </div>
    
    <div class="panel panel-default">

    	<?php $this->load->view('clientarea/sites/modules/qa'); ?>
  
    </div>
  	
  	 <div class="panel panel-default">

        <?php  echo $this->cleansure->lang_header('QA Related Files', 'company_information'); ?> 

      <div class="panel-body">
        
        <div class="file-details">
        	
          <ul class="fileTree">
          	
          	<?php  if(isset($folders) && count($folders) > 0)
			
			          {
			          	
						$c=0;
				 	   
				        foreach ($folders as $f => $files) 
				
				         {
				         	
							$c++;
				         	
							$dated_dir = preg_split("/[\s_]+/", $f);
							
							if($dated_dir[0] == $customer_data[0]->site_id)
							
							{
					
				           	echo "<li class=\"folder\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				           	
				           							<span>".date("d-m-Y",$dated_dir[1])."</span>".
				           							
				           		                     anchor("#", "<span class=\"glyphicon glyphicon-chevron-down\"></span>", array('class' => 'toggle_files', 'data-target' => $c, 'data-status' => 'closed'));
							
							echo "<ul class=\"dir_dropdown closed\" id=\"".$c."\">\n";
							
								for($i=0;$i<count($files);$i++)
								
								{
									$ext = pathinfo($files[$i], PATHINFO_EXTENSION);
									
									if($ext != 'html')
									
										{
											
											echo "<li><span class=\"glyphicon glyphicon-picture\"></span>&nbsp;&nbsp;"
											
												     .anchor($path.'/'.$f.'/'.$files[$i], $files[$i], 
												     
												          array('class' => 'pop_up', 'data-lightbox' => $f, 'data-title' => 'Specification Images', 'title' => 'Specification Images')).
												          
												  "</li>\n";
											
										}
									
								     }
								
								}

                                else 
					  
					                {
					                	
										if($c == 1)
										
										{
								  
							                 echo "<p>No Files Available!</p>\n";
											 
										}
                 
				           }


							echo "</ul>\n";							
							
							echo "</li>\n";
					
			        	}
						 			
					 }
					  
					  else 
					  
					  {
							echo "<p>No Files Available!</p>\n";
                 
				      }
	
          	
			?>
			
          </ul>
          
        </div>
        
      </div>
  
    </div>
	
    <div class="panel panel-default">
  	
      <div class="panel-heading">
    	
        <h3 class="panel-title">&raquo;&nbsp;&nbsp;Company Relationship</h3>
      
      </div>
    
      <div class="panel-body">
        
        <div class="company-details">
        <p>Supervisors:&nbsp;&nbsp;<span class="lead">2</span></p>
        <p>Staff:&nbsp;&nbsp;<span class="lead">25</span></p>
        <p>Contract Value:&nbsp;&nbsp;<span class="lead">£105,256.00 pa</span></p>
        <p>Contract Value:&nbsp;&nbsp;<span class="lead">£105,256.00 pa</span></p>
        </div>
        <br>
    
          </div>
      
        </div>