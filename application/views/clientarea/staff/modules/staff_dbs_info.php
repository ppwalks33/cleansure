 <div id="collapse2" class="panel-collapse collapse">
 	
 
 <?php   
 
 	
	$dbs = array('Standard', 'Enhanced', 'Enhanced With List checks');
 	
 	?>
      <div class="panel-body">
        
        
        <div class="staff-details">
        	
          <p>Employee Been DBS Checked?:&nbsp;&nbsp;
          			
          						<span class="lead">
          							
          								<span class="glyphicon glyphicon-<?php echo ($row_data[0]->signiture == true ? 'ok':'remove');  ?>"></span>
          								
          					   </span>
          					   
          </p>
          
          <p>Which Check?&nbsp;&nbsp;
          	
          							<span class="lead"><?php echo $dbs[$row_data[0]->dbs]; ?></span>
          							
          </p>
          
          <p>Has Certificate Been Verified?:&nbsp;&nbsp;
          	
          							<span class="lead">
          								
          								<span class="glyphicon glyphicon-<?php echo ($row_data[0]->verified == true ? 'ok':'remove');  ?>"></span>
          								
          							</span>
          							
          </p>
          
          <p>Any Discrepencies?&nbsp;&nbsp;
          	
          							<span class="lead">
          								
          								<span class="glyphicon glyphicon-<?php echo ($row_data[0]->discrepencies == true ? 'ok':'remove');  ?>"></span>
          								
          							</span>
          							
          </p>
          
          <p>Discrepency Information (if applicable):&nbsp;&nbsp;<span class="lead"><?php echo $row_data[0]->description; ?></span></p>
          
        </div>
        
        <br>
        
       <div class="btn-group pull-right">
        
       <?php
       
       if($data->$prefix < 2 || $data->user_type == 1)
		
		{
       
        echo anchor('clientarea/staff/edit/'.$row_data[0]->staff_id.'/dbs_check', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				        'data-title' => 'Edit DBS Check',
									
									'title'      =>  'DBS Check',
									
									'data-glyph'      =>  'user',
									
									'data-action' => false)); 
									
									}
									
									?>
									
		
                   
      </div>  
                
      </div>
      
    </div>