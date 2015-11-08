<!-- Grey container Panel -->
<div class="box">
	<div class="box-header with-border">
		 <h3 class="box-title">Team members overview</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	<a href="/clientarea/staff/add_staff_member/" class="btn btn-success btn-sm bottomPadBtn"><i class="fa fa-plus"> </i> Add Staff Member</a>
    	
    	
    	<div class="pull-right">
    		
                
     <?php
	  
							
							  echo anchor('clientarea/'.$this->prefix.'/deleted/', 
    	  
    	  					  '<span class="trashContainer"><i class="fa fa-trash trashBtn"></i><span class="label label-'.($deleted != false ? 'danger':'success').' messageCount iconCounter">'.($deleted != false ? $deleted:'0').'</span> Deleted Users</span>',   	  					
    	  					
    	  					  array('title' => 'My Messages', 'class' => '')
							  
							  
							
							); 
							

	  
	  
	  ?>
    		
    	</div>
    	
    	<?php   if(isset($pageData)) {  ?>
    	
		<div class="clearfix visible-xs-block"></div>
			<!-- Table Content -->
		    <div class="table-responsive customers">
            	<table class="table table-responsive table-bordered table-striped">
            	
              <thead>
              	
                <tr>
                	
                  <th>
                  	
                  	Staff Name&nbsp;&nbsp;
                  	
                  		<?php 
                  		
                  			echo anchor('/clientarea/staff/sort_table/users.last_name/'.($this->uri->segment(5) == 'asc' ? 'desc':'asc'),
							
										'<span class="fa fa-sort pull-right"></span>',
										
										array('title' => 'Sort the table via Staff Name'));
                  			
                  			?>
                  	
                  	</th>
                  
                  <th>Reference</th>
                  
                  <th>
                  	
                  	Date Added&nbsp;&nbsp;
                  	
                  	<?php 
                  		
                  			echo anchor('/clientarea/staff/sort_table/date.date/'.($this->uri->segment(5) == 'asc' ? 'desc':'asc'),
							
										'<span class="glyphicon glyphicon-sort"></span>',
										
										array('title' => 'Sort the table via Date'));
                  			
                  			?>
                  	</th>
                  	
                  <?php if ($this->uri->segment(3) != 'deleted') { ?>
                  
                  <th>Customers/ Sites&nbsp;&nbsp;</th>
                  
                  <th>Schedules&nbsp;&nbsp;</th>
                  
                  <th>Holidays</th>
                  
                  <th>Machinery</th>
                  
                  <th>System Status&nbsp;&nbsp;
                  	
                  	<?php 
                  		
                  			echo anchor('/clientarea/staff/sort_table/staff.status/'.($this->uri->segment(5) == 'asc' ? 'desc':'asc'),
							
										'<span class="glyphicon glyphicon-sort"></span>',
										
										array('title' => 'Sort the table via Status'));
                  			
                  			?></th>
                  			
                  <?php } ?>
                  
                  <th>Actions</th>
                  
                </tr>
                
              </thead>
              
              <tbody>
              	
              	<?php 
              			
						foreach($pageData as $row)
						
						{
							
					?>
              	
                <tr id="<?php echo $row->staff_id; ?>">
                	
                  <td>
                  	
                  	<span class="glyphicon glyphicon-user hideIcon"></span> <?php echo $row->first_name.'&nbsp;'.$row->last_name; ?> 
                  
                  </td>
                  
                  <td>
                  	
                  	<?php echo $row->reference; ?>
                  	
                  </td>
                  
                  <td>
                  	
                  		<span class="glyphicon glyphicon-time hideIcon"></span> <?php echo format_date($row->date_added); ?>
                  		
                  </td>
                  
                    <?php if ($this->uri->segment(3) != 'deleted') { ?>
                  
                  <td> 
                  	
                  	<?php if($row->staffIds > 0): ?>
                  	
                  	<span class="label label-success blockBtn"><?php echo ($row->staffIds > 0 ? $row->staffIds:'0'); ?></span>
                  	
                  	<?php echo anchor('clientarea/staff/view_sites/'.$row->staff_id, 
                  	
                  					  '<span class="fa fa-eye rightPadIcon"></span> View Sites', 
                  					                 					  
                  					  array('title' => 'View Staff Sites', 'data-title' => 'View Staff Sites', 'class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-action' => false)
                  					  
									  ); 
									  
					else:
						
						
						echo "<span class=\"label label-danger blockBtn\">0</span>";
					
					
					endif;
					
					?>
                  	
                  	
                  </td>
                  
                  <td>
                  	
                  		<?php 
                  		
                  				echo anchor('clientarea/schedules/staff/'.date('Y').'/'.date('m').'/'.$row->staff_id, 
                  		
                  						    '<span class="glyphicon glyphicon-calendar rightPadIcon"></span> View Schedules',										   
										   
										     array('title' => 'View '.$row->first_name.'&nbsp;'.$row->last_name.' Schedule', 'class' => 'btn btn-primary btn-xs blockBtn')
											 
											 );
										   
						?>
                  	
                  	</td>
                  
                  <td>
                  	
                  	<?php 
                  	
                  	if (!empty($row->hol) ? 'disabled':NULL) {
                  	echo anchor('clientarea/staff/holidays/staff_holidays/'.$row->staff_id, 
            
            				  '<span class="fa fa-eye rightPadIcon"> </span> View', 
            				  
            				  array('class'           => 'trigger btn btn-primary btn-xs blockBtn', 
            				  
            				        'data-title'      => 'Staff Holidays',
									
									'title'           =>  'Staff Holidays',
									
									'data-glyph'      =>  'briefcase',
									
									'data-action'     =>   false))."\n"; 
					}
									
									
					if($data->$prefix < 2 || $data->user_type == 1) {
									
					echo anchor('clientarea/staff/holidays/holiday_request/'.$row->staff_id, 
            
            				  '<span class="fa fa-pencil"></span> Request', 
            				  
            				  array('class'           => 'trigger btn btn-success btn-xs blockBtn', 
            				  
            				        'data-title'      => 'Holiday Request',
									
									'title'           =>  'Holiday Request',
									
									'data-glyph'      =>  'briefcase',
									
									'data-action'     =>   false))."\n"; 
									
					}
									
									?>
                 
                
                  </td>
                  
                  <td>
                  	
                  
                  		

                  		 <?php 
								if($row->machinery) {
								/* Wierd padding bug had to use inline style to fix no padding issue between label and button */
								echo '<span class="label label-success blockBtn" style="margin-right:0.3em;">'.$row->machinery.'</span>';
								
								echo anchor('/clientarea/machinery/staff_machinery_allocation/'.$row->staff_id,
			  
			  					        '<span class="fa fa-cog rightPadIcon"></span> View Equipment',
								
								          array('class' => 'trigger btn btn-primary btn-xs blockBtn',
								
								              'data-title' => 'Configure Machinery', 
            				        
            				                  'data-glyph' => 'glyphicon-compressed', 
            				        
            				                  'title' => 'Configure Machinery',
									 
									          'data-action' => false));
											  
								} else {
								
								echo "<span class=\"label label-danger blockBtn\">0</span>";
								
								}
									 
						 ?>
                  </td>
                  
                 
				  
                  
                  <td>
						
						<?php echo anchor('clientarea/staff/status/'.$row->staff_id.'/'.($row->status == false ? (int)true:(int)false), 
                  			
                  							  $row->status == true ? '<span class="fa fa-close staff-active rightPadIcon"></span> De-Activate User':'<span class="fa fa-check staff-active rightPadIcon"></span>Activate User',
											   
											   array('title' => ($row->status == true ? 'Activate '.$row->first_name.'&nbsp;'.$row->last_name:'De-Activate '.$row->first_name.'&nbsp;'.$row->last_name), 'class' => 'trigger btn btn-'.($row->status == true ? 'danger':'success').' btn-xs blockBtn')); ?>
						
						
						
			
			
                  								
                  			</td>
                  			
                  			 <?php } ?>
               
               		<td width="200">
           			
               			<?php 
               			
               			
               			$prompt = (isset($final_delete) ? 
               			
               					'Are You Sure, this will result in all the data for this user being removed completely!':
								
								'Are You sure you would like to delete this staff member?'
								
								);
								
								if(isset($final_delete))
								
								{
									
									echo anchor('clientarea/staff/reinstate/'.$row->staff_id, 
               			
               								'<span class="fa fa-check"></span> Re-activate User',
               								
               											array('class' => 'reinstate btn btn-success btn-xs blockBtn actionBtn',               										
														
														'title' => 'Move Staff Member From Deleted?')
														
												);
									
									
								}
								
									
                  	           if ($this->uri->segment(3) != 'deleted') { 

							echo anchor('/clientarea/staff/profile/'.$row->staff_id, '<span class="glyphicon glyphicon-user"></span> Edit User Profile', array('title' => $row->first_name.'&nbsp;&quot;sProfile','class' => 'btn btn-success btn-xs blockBtn actionBtn'));
										
										
										}
                  		
								             			
               					echo anchor('#', 
               			
               								'<span class="fa fa-trash"></span> Delete Member',
               								
               											array('class' => 'btn btn-danger btn-xs delete_row blockBtn actionBtn', 
               											
               											'data-table' => 'staff', 
               											
               											'data-target' => $row->staff_id, 
               											
														'data-title' => 'Delete Staff Member',
               											
               											'data-prompt' => $prompt,
														
														'title' => 'Confirm Delete?',
														
														'data-url' => '/clientarea/staff/delete/'.$row->staff_id.'/'. $row->user_id.'/'.(isset($final_delete) ?'/1':false)));
											
											?>
               			
               		</td>
               
                </tr>
                
                <?php } ?>
                
              </tbody>
              
            </table>

          </div>
          
          <?php /* echo $staff; */ ?>
          
  
  
<?php } else {
	
	echo '<h3>No Data Available</h3>';
	
} ?>
		   <!-- /. Table Content -->
		   
        </div><!-- /.box-body -->
      </div><!-- /.box -->
<!-- /.Grey container Panel -->
	  
	 