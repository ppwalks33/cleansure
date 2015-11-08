 <div id="collapse3" class="panel-collapse collapse">
    	
      <div class="panel-body">
        
        
        <div class="staff-details">
        	
        <?php 
        
        	$atts = array('payroll_number', 'bank', 'branch', 'account_number', 'sort_code', 'roll_number', 'account_name');
        	
        	$i=0;
			
			foreach($atts as $a)
			
			{
				
				if($i == 0)
				
				{
					
					echo "<p>Payroll/Reference Number:&nbsp;&nbsp;<span class=\"lead\">".$row_data[0]->$a."</span></p>\n";
				}
				
				else {
					
					echo "<p>".ucwords(str_replace('_', '&nbsp;', $a)).":&nbsp;&nbsp;<span class=\"lead\">".$row_data[0]->$a."</span></p>\n";
					
					
				}
				
				
				
				
				echo ($i == 0 ? "<br>\n":NULL);
				
				
				$i++;
			}
        	
        	?>
          
        </div>
        
        <br>
        
        <div class="btn-group pull-right">
        	
           <?php 
           
           if($data->$prefix < 2 || $data->user_type == 1)
		
		{
           
           echo anchor('clientarea/staff/edit/'.$row_data[0]->staff_id.'/financial', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				        'data-title' => 'Financial Details',
									
									'title'      =>  'Financial Details',
									
									'data-glyph'      =>  'user',
									
									'data-action' => false)); 
									
									}?>
            
        </div> 
                   
      </div>
      
    </div>
    