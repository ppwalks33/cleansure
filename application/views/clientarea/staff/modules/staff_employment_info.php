 <div class="panel-body">
        
        <div class="staff-details">
        	
        	<?php 
        		
        		$emp = array('Part Time', 'Full Time');
				
        		?>
        	
          		<p>Start Date:&nbsp;&nbsp;<span class="lead"><?php echo format_date($row_data[0]->start_date);?></span></p>
          
          		<p>End Date:&nbsp;&nbsp;<span class="lead"><?php echo (!empty($row_data[0]->end_date) ? format_date($row_data[0]->end_date):'-');?></span></p>
          
          			<br>
          
          		<p>Job Title:&nbsp;&nbsp;<span class="lead"><?php echo $row_data[0]->job_title; ?></span></p>
          
          		<p>System Level:&nbsp;&nbsp;<span class="lead"><?php echo $row_data[0]->job_position; ?></span></p>
          
          		<p>Short Description:&nbsp;&nbsp;<span class="lead"><?php echo $row_data[0]->description; ?></span></p>
          
          			<br>
          
          		<p>Employment Basis:&nbsp;&nbsp;<span class="lead"><?php echo $emp[$row_data[0]->employment_basis]; ?></span></p>
          
          			<br>
          			
          		<p>Staff Members First Job?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->first_job]; ?>"></span></span></p>
          		
          		<p>Staff Members Only Job?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->only_job]; ?>"></span></span></p>
          
          		<p>Bank Holiday Entitlement?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->bank_hol_ent]; ?>"></span></span></p>
          		
          		<p>Holiday Entitlement?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->hol_ent]; ?>"></span></span></p>
          		
                <p>P45?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->p45]; ?>"></span></span></p>
                
        </div>
        
         <div class="btn-group pull-right">
        
        <?php 
        
        if($data->$prefix < 2 || $data->user_type == 1)
		
		{
        
        echo anchor('clientarea/staff/edit/'.$row_data[0]->staff_id.'/staff_edit', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				        'data-title' => 'Edit Staff Details',
									
									'title'      =>  'Staff Details',
									
									'data-glyph'      =>  'user',
									
									'data-action' => false));
									
		} ?>
									
					</div>
   
      </div>