 <div class="panel-body">
 
 	
 <ul class="profile-contact">
 
        	
        <?php 
        
        	$comp_add = array('address_line_1', 'address_line_2', 'address_line_3', 'city', 'add_county', 'postcode'); 
			
			foreach ($comp_add as $a)
			
			{
				echo "<li>\n".(!empty($customer_data[0]->$a) ? $customer_data[0]->$a:$na)."\n</li>\n";
				
			}
        	
        	
        	?>
        	
        </ul>
        

 <br>
        
        <div class="btn-group pull-right">
           
            <?php 
            
            
            
            echo anchor('clientarea/sites/maps/'.trim(str_replace(' ', '',strtolower(trim($customer_data[0]->postcode)))).'', 
            
            				  '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Google Maps', 
            				  
            				  array('class' => 'btn btn-default map', 
            				  
            				  'data-title' => '', 
							  
							  'title'      =>  'Company Address',
							  
							  'data-glyph' =>  'map-marker'));
            
          if(($data->$prefix < 2 || $data->user_type == 1) && ($this->prefix != 'work_orders'))
		
		    {
		    	
            echo anchor('clientarea/customers/edit/address/'.$customer_data[0]->comp_add_id.'', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				  'data-title' => 'Edit Company Address', 
							  
							  'title'      =>  'Company Information',
							  
							  'data-glyph' =>  'briefcase',
							  
							  'data-action' => false));
							  
			}
			
			 ?>
            
        </div>
        
  </div>