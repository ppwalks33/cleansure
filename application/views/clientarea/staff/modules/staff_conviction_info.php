 <div id="collapse1" class="panel-collapse collapse">
    	
      <div class="panel-body">
            
        <div class="staff-details">
        	
          <p>Any Criminal Convictions?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->conviction]; ?>"></span></span></p>
          
          <p>More Information:&nbsp;&nbsp;<span class="lead"><?php echo $row_data[0]->comment; ?></span></p>
          
          <p>Signed Accurate Statement?:&nbsp;&nbsp;<span class="lead"><span class="<?php echo $glyphs[$row_data[0]->signiture]; ?>"></span></span></p>
          
        </div>
        
        <br>
        
        <div class="btn-group pull-right">
        
       <?php 
       
       if($data->$prefix < 2 || $data->user_type == 1)
		
		{
       
       echo anchor('clientarea/staff/edit/'.$row_data[0]->staff_id.'/convictions_checks', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				        'data-title' => 'Edit Criminal Convictions',
									
									'title'      =>  'Criminal Convictions',
									
									'data-glyph'      =>  'user',
									
									'data-action' => false));
									
		} ?>
									
					</div>
                   
      </div>
      
    </div>
    