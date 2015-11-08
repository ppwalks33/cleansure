<?php 

	$folder = "clientarea/customers/modules/"; 
	
	echo $this->lang->line('sites_header'); 
	
	echo "<br>";
	
	echo sprintf($this->lang->line('site_lead'), $company_info->company_name);
	
	echo "<div id=\"message\">\n";
	
	if ($this->session->flashdata('info')) 

			{
 		
				$this->load->view('clientarea/modules/flashmessageinfo');
 			
			}
			
	echo "</div>";
	
	if($data->$prefix < 2 || $data->user_type == 1)
		
	{
	
	echo $this->load->view($folder.'menu'); 
	
	}
 			
 	?>
 	
<div class="panel-group" id="accordion">
	
  <div class="panel panel-default">
  	
  	<?php	echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'eye-close', 'title' => "Hide / Show"),  'i_header', 1); ?>

    
    <div id="collapse1" class="panel-collapse collapse in">
    	
      <div class="panel-body">
      	
        <div class="table-responsive customers">
        	
            <table class="table table-striped table-hover">
            	
              <thead>
              	
                <tr>
                	
                  <th>
                  	
                  		Site Name&nbsp;&nbsp;<a href="#" title="Sort Contact Name"><span class="glyphicon glyphicon-sort"></span></a>
                  		
                  </th>
                  
                  <th>
                  	
                  		Site Address
                  		
                  </th>
                  
                  <th>
                  	
                  		Address Controls
                  		
                  </th>
                  
                  <th>
                  	
                  		Machinery&nbsp;&nbsp;<a href="#" title="Sort Machinery"><span class="glyphicon glyphicon-sort"></span></a>
                  		
                  </th>
                  
                  <th>
                  	
                  		Work Orders
                  		
                  		
                  </th>
                  
                  <th>
                  	
                  		Work Rating&nbsp;&nbsp;<a href="#" title="Convert to ft2"><span class="glyphicon glyphicon-refresh"></span></a>
                  		
                  </th>
                  
                  <th>
                  	
                  		Contract Work&nbsp;&nbsp;<a href="#" title="Sort Contracts"><span class="glyphicon glyphicon-sort"></span></a>
                  		
                  </th>
                  
                  <th>
                  	
                  		One Shot Jobs&nbsp;&nbsp;<a href="#" title="Sort Jobs"><span class="glyphicon glyphicon-sort"></span></a>
                  		
                  </th>
                  
                  <th>
                  	
                  		Staff
                  		
                  </th>
                  
                  
                  <th>
                  	
                  		Stores&nbsp;&nbsp;<a href="#" title="Sort "><span class="glyphicon glyphicon-sort"></span></a>
                  		                  		</th>
                   </tr>
                   
              </thead>
              
              <tbody>
              	
              	<?php 
					
              		foreach ($sites as $s) { 
              			
              	?>
              	
                <tr>
                	
                  <td>
                  	
                  		<span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;<?php echo $s->site_name; ?></a>&nbsp;&nbsp;
                  		
                  		<?php 
                  		
                  		
 	
                  		
                  		echo anchor('clientarea/sites/profile/'.$s->site_id.'/', 
            
            				   "<span class=\"glyphicon glyphicon-share-alt\"></span>", 
            				  
            				    array('class' => '', 
            				  
            				         'title' => 'Edit Site Profile')
									
									); 
									
									
									
							?>
                  		
                  		
                  		
                  </td>
                  
                
                  
                  <td class="address">
                  	
                  		 <?php  $add = array('address_line_1', 'address_line_2', 'address_line_3', 'city', 'region', 'postcode');
				  
				  			foreach ($add as $a) 
					
								{
						
									echo (!empty($s->$a) ? $s->$a."<br>\n":NULL);
								}
				  
				  			?>
                  		
                  </td>
                  
                  <td>
                  	
          
                    
                     <?php 
                     
                     if($data->$prefix < 2 || $data->user_type == 1)
		
						{
                     
                      echo anchor('clientarea/sites/update_sites/'.$s->cus_id.'/'.$s->site_id.'/'.$s->address_id, 
            
            				   "<span class=\"label label-default edit-address\"><span class=\"glyphicon glyphicon-pencil\"></span>&nbsp;&nbsp;Edit</span>", 
            				  
            				    array('class' => 'trigger', 
            				  
            				         'data-title' => 'Edit Customer Site', 
            				        
            				         'data-glyph' => 'user', 
            				        
            				         'title' => 'Edit Customer Site',
									 
									 'data-action' => false)
									
									);
									
						}	
									
					echo "&nbsp;&nbsp;";
             
                     echo anchor('clientarea/sites/maps/'.trim($s->postcode).'', 
            
            				     '<span class="label label-default google-maps"><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Maps</span>', 
            				  
            				       array('class' => 'map', 
            				  
            				      'data-title' => '', 
							  
							      'title'      =>  'Company Address',
							  
							      'data-glyph' =>  'map-marker',
							  
							      'data-action' => false));
								  
								  ?>
							  
                   
                    
                  </td>
                  
                  <td>
                  	
                  	
                  		<span class="glyphicon glyphicon-compressed"></span>&nbsp;&nbsp;
                  		
                  		 <?php echo anchor('/clientarea/machinery/allocate/'.$s->cus_id."/".$s->site_id,
			  
			  					        '<span class="label label-default">'.$s->machineCount.'</span>',
								
								          array('class' => 'trigger',
								
								              'data-title' => 'Configure Machinery', 
            				        
            				                  'data-glyph' => 'glyphicon-compressed', 
            				        
            				                  'title' => 'Configure Machinery',
									 
									          'data-action' => false));
									 
						 ?>
                  		
                  </td>
                  
                  <td>
                  		
                  		<span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;<?php echo anchor('clientarea/work_orders/', 'Expand', array('title' => 'Go To Work Orders')); ?>
                  		
                  </td>
                  
                  <td>
                  	
                  		<a href="" title="" data-toggle="modal" data-target="#workRatingModal">2503&nbsp;m<sup>2</sup></a>&nbsp;/&nbsp;hr<br>
                  		
                  </td>
                  
                  <td>
                  	
                  	<?php if($s->contracts > 0)
					
					{
						
					?>
                  	
                  		<span class="label label-default"><?php echo $s->contracts; ?></span>&nbsp;&nbsp;<?php echo anchor('/clientarea/customers/contracts/2/'.$s->company_id.'/'.$s->site_id, 
                  		
                  																				'View Contracts', 
                  		
                  																				array('title' => 'View Contracts', 
                  																				
                  																					  'class' => 'trigger',
                  				
                  					  																  'data-title' => 'View Contracts', 
            				        
            				          																  'data-glyph' => 'user',
            				          
            				          																  'data-action' => true)
																									  
																									  ); 
                  		
                  		
																			 } else { echo $na; ; } ?>
                  	
                  </td>
                  
                  <td>
                  	
                  	<?php if($s->oneshots > 0)
					
					{
						
					?>
                  	
                  		<span class="label label-default"><?php echo $s->oneshots; ?></span>&nbsp;&nbsp;<?php echo anchor('/clientarea/customers/contracts/1/'.$s->company_id.'/'.$s->site_id, 
                  		
                  																				'View Jobs', 
                  		
                  																				array('title' => 'View Jobs', 
                  																				
                  																					  'class' => 'trigger',
                  				
                  					  																  'data-title' => 'View Jobs', 
            				        
            				          																  'data-glyph' => 'user',
            				          
            				          																  'data-action' => true)
																									  
																									  ); 
                  		
                  		
																			 } else { echo $na; } ?>
                  	
                  </td>
                  
                  <td>
                  	
                  	<?php if($s->staffCount > 0)
					
					{
						
						?>
                  	
                  		<span class="label label-default"><?php echo $s->staffCount; ?></span></a>&nbsp;&nbsp;<?php echo anchor('/clientarea/customers/view_staff/'.$s->company_id.'/'.$s->site_id, 
                  		
                  																				'View Staff', 
                  		
                  																				array('title' => 'View Staff', 
                  																				
                  																					  'class' => 'trigger',
                  				
                  					  																  'data-title' => 'View Staff', 
            				        
            				          																  'data-glyph' => 'user',
            				          
            				          																  'data-action' => true)
																									  
																									  ); 
                  		
                  		
																			 } else { echo $na; } ?>
                  	
                  		
                  </td>
                  
                  <td>
                  	
                  		<span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;
                  		
                  		<?php echo anchor('clientarea/work_orders/', 'Expand', array('title' => 'Go to Work Orders')); ?>
                  		
                  </td>
                  
                </tr>
                
                <?php } ?>
               
              </tbody>
              
            </table>

          </div>
            
      </div>
      
    </div>
    
  </div>