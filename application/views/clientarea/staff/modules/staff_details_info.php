<div class="panel-body">
      	
        
        <div class="staff-details">
        	
        	
          <p>Staff Name:&nbsp;&nbsp;<span class="lead"><?php echo $row_data[0]->title.'&nbsp;'.$row_data[0]->first_name.'&nbsp;'.$row_data[0]->last_name; ?></span></p>
          
          <p>Gender:&nbsp;&nbsp;<span class="lead"><?php echo $row_data[0]->gender; ?></span></p>
          
          <p>Date of Birth:&nbsp;&nbsp;<span class="lead"><?php  echo format_date($row_data[0]->date);?></span></p>
          
        </div>
        
        <br>
        
        <div class="btn-group pull-right">
        	
            <?php
            
            if($data->$prefix < 2 || $data->user_type == 1)
		
		{
            
             echo anchor('clientarea/staff/edit/'.$row_data[0]->user_id.'/personal_data/'.$row_data[0]->date_id, 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				        'data-title' => 'Edit Staff Details',
									
									'title'      =>  'Staff Details',
									
									'data-glyph'      =>  'user',
									
									'data-action' => false)); 
									
									}?>
            
        </div>
   
      </div>