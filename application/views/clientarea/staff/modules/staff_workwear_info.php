<div class="panel-body">
        
        <div class="staff-details">
        	
        <p>

			Staff Member Recieved Work Wear?:  
			
				<span class="lead">
						
						<span class="<?php echo $glyphs[$row_data[0]->workwear]; ?>"></span>

				</span>

		</p>
        	
         <p><span class="lead"><?php echo $row_data[0]->workwear_info; ?></span></p>
         
        </div>
        
        <br>
        
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
									
									}
									?>
									
					</div>
      </div>
      