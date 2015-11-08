 <div class="panel-body">
        
        <ul class="profile-contact">
        	
        <?php 
        
        		$atts = array('email_address', 'daytime_telephone', 'evening_telephone', 'mobile_telephone', 'fax_number'); 
				
				$i=0;
				
				foreach ($atts as $a)
				
				{
					
					if(!empty($row_data[0]->$a))
					
					{
					$label = explode('_', $a);
					
					echo "<li><strong>".ucwords($label[0]).":</strong>&nbsp;&nbsp;".
					
																	($i == 0 ? anchor('#', $row_data[0]->$a, array('title' => 'E-mail&nbsp;'.$row_data[0]->first_name.'&nbsp;'.$row_data[0]->last_name)): 
																	
																	$row_data[0]->$a)."</li>";
					
					$i++;
				}
        		
				}
        		
        		?>
          
        </ul>
        <br>
        
        <div class="btn-group pull-right">
            
             <?php 
             
             if($data->$prefix < 2 || $data->user_type == 1)
		
		       {
             
             echo anchor('clientarea/customers/edit/contact/'.$row_data[0]->contact_id.'', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				        'data-title' => 'Edit Staff Contact',
									
									'title'      =>  'Staff Contact Details',
									
									'data-glyph'      =>  'user',
									
									'data-action' => false)); 
									
									}
									
					?>
           
        </div>
   
      </div>
      