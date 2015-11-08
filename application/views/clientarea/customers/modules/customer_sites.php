 <div class="panel-body">
 	
 	
        
        <div class="table-responsive">
        	
        <table class="table table-striped table-hover">
        
          <thead>
          	
            <tr>
            	
              <th>Site Name&nbsp;&nbsp;</th>
              
              <th>Machinery&nbsp;&nbsp;</th>
              
              <th>Work Orders</th>
              
              <th>Specification&nbsp;&nbsp;</th>
              
              </tr>
              
            </thead>
            
            <?php foreach($sites as $name) { ?>
          
            <tr>
            	
              <td>
              	
              	
              	
              	<span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;
              	
              	<?php echo anchor('clientarea/sites/update_sites/'.(isset($customer_data) && !empty($customer_data[0]->comp_id) ? $customer_data[0]->comp_id:$company_id).'/'.$name->site_id.'/'.$name->address_id, 
            
            				   ($name->site_name == 'main' ? 'Company Head Quarters' : $name->site_name), 
            				  
            				    array('class' => ''.($data->$prefix < 2 || $data->user_type == 1 ? 'trigger':NULL).' siteEdit', 
            				  
            				         'data-title' => 'Edit Customer Name &amp; Address', 
            				        
            				         'data-glyph' => 'user', 
            				        
            				         'title' => 'Edit Customer Name &amp; Address',
									 
									 'data-action' => false)
									
									); 
									
									
					echo anchor('clientarea/sites/profile/'.$name->site_id, 
            
            				   '&nbsp;<span class="glyphicon glyphicon-share-alt"></span>', 
            				  
            				    array('title' => 'Edit Customer Site'));
            				    
            		?>
              	
              
              	
             </td>
             
              	<?php if(isset($customer_data)) { ?>
              
              <td>
              	
              		<span class="glyphicon glyphicon-compressed"></span>&nbsp;&nbsp;
              		
                      <?php echo anchor('/clientarea/machinery/allocate/'.$customer_data[0]->cus_id."/".$name->site_id,
			  
			  					        '<span class="label label-default">'.$name->machineCount.'</span>',
								
								        array('class' => 'trigger',
								
								              'data-title' => 'Configure Machinery', 
            				        
            				                  'data-glyph' => 'glyphicon-compressed', 
            				        
            				                  'title' => 'Configure Machinery',
									 
									          'data-action' => false));
									 
									 ?>
              		
              </td>
              
              <?php } else { echo "<td><span class=\"label label-default\">".$name->machineCount."</span></td>\n";}  ?>
              
              <td>
              	
              		<span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;
              		
              		<?php echo anchor('clientarea/work_orders/', 'Expand', array('title' => 'Go to Work Orders')); ?>
              	
              	</td>
              	
              	
              <td>
              	
              	  &nbsp;
              	  
              	  
              	  </td>
              
            </tr>
            
            <?php } ?>
        
          </table>
        </div>
        <br>
        
        <?php if(!empty($customer_data)): ?>
        	        
        <div class="btn-group pull-right">
        	
              <?php 
              
              if($data->$prefix < 2 || $data->user_type == 1)
		
		    {
              
              echo anchor('clientarea/sites/update_sites/'.$customer_data[0]->comp_id.'', 
            
            				   '<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Site', 
            				  
            				    array('class' => 'btn btn-default trigger sites', 
            				  
            				         'data-title' => 'Add Customer Site', 
            				        
            				         'data-glyph' => 'user', 
            				        
            				         'title' => 'Add A Site To The System',
									 
									  'data-action' => false)
									
									);  } 
									
				?>
            <a href="/clientarea/sites/<?php echo $customer_data[0]->comp_id; ?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View All Sites</a>
        </div>
        
        <?php endif; ?>
    
          </div>
      