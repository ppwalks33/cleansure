 <div id="collapse4" class="panel-collapse collapse">
    	
      <div class="panel-body">
        
        
        <div class="staff-details">
        	
          <p>Dermatitis?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->dermatitis]; ?>"></span></span></p>
          
          <p>Health Issues?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->health]; ?>"></span></span></p>
          
          <p>Health Information:&nbsp;&nbsp;<span class="lead"><?php echo $row_data[0]->notes_health; ?></span></p>
          
          <br>
          
          <p>Disabilities?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->disabilities]; ?>"></span></span></p>
          
          
          <p>Disability Information:&nbsp;&nbsp;<span class="lead"><?php echo (!empty($row_data[0]->notes_dis) ? $row_data[0]->notes_dis:NULL); ?></span></p>
          
          <br>
          
          <p>Permission to Contact Doctor?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->contact_doc]; ?>"></span></span></p>
         
          
        </div>
        
        <br>
        
        <div class="btn-group pull-right">
           
           
            <?php 
            
            if($data->$prefix < 2 || $data->user_type == 1)
		
		{
            
            echo anchor('clientarea/staff/edit/'.$row_data[0]->staff_id.'/medical', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class'      => 'btn btn-default trigger', 
            				  
            				        'data-title' => 'Medical Details',
									
									'title'      =>  'Medical Details',
									
									'data-glyph' =>  'user',
									
									'data-action'=> false));
									
		} ?>
            
           
        </div>  
                  
      </div>
      
    </div>