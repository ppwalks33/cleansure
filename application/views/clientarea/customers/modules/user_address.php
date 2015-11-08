

<ul class="profile-contact topPad">

<!-- PAUL TO PLUGIN IN GOOGLE MAP AND IF CLICK ON MAKE IT GO INTO MODAL BOX -->
<img src="/images/temp-google-map.png" alt="Google Map" class="img-responsive bottomPad" />
        	
        <?php 
        
        	$address_data = array('user_add_1', 'user_add_2', 'user_add_3', 'user_city', 'region', 'user_postcode'); 
			
			
			echo "<strong>Address:</strong> ";
			
			foreach($address_data as $a) 
			{
				
				echo "".(!empty($customer_data[0]->$a) ? $customer_data[0]->$a:$na).", ";
				
			}
        	
       		?>
       		
      	</ul>
      	
        <br>
        
        <div class="btn-group">
            
             <?php 
             /*
               echo anchor('clientarea/sites/maps/'.str_replace(' ', '', strtolower(trim($customer_data[0]->user_postcode))).'', 
            
            				  '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Google Maps', 
            				  
            				  array('class' => 'btn btn-success btn-sm bottomPadBtn map', 
            				  
            				  'data-title' => '', 
							  
							  'title'      =>  'Company Address',
							  
							  'data-glyph' =>  'map-marker',
							  
							  'data-action' => false));
							  
             */
			 if($data->$prefix < 2 || $data->user_type == 1)
		
		    {
			 
             echo anchor('clientarea/customers/edit/address/'.$customer_data[0]->user_add_id.'', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-success btn-sm bottomPadBtn trigger', 
            				  
            				  'data-title' => 'Edit Customer Address',
            				  
							  'title'      => 'Customer Address',
							  
							  'data-glyph' => 'briefcase',
							  
							  'data-action' => false));
							  
							  }
							  
							   ?>
            
            
        </div>
        
