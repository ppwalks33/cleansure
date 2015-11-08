<div class="panel-body">
        
        <ul class="profile-contact">
        	
       <?php 
       			
       		$atts=array('address_line_1', 'address_line_2', 'address_line_3', 'city', 'region', 'postcode');
			
			foreach($atts as $a)
			
			{
				
				echo "<li>".$row_data[0]->$a."</li>";
			}
       		
       	?>
       	
        </ul>
        
        <br>
        
        <div class="btn-group pull-right">
           
			 <?php 
            
            echo anchor('clientarea/sites/maps/'.trim($row_data[0]->postcode).'', 
            
            				  '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Google Maps', 
            				  
            				  array('class' => 'btn btn-default map', 
            				  
            				  'data-title' => '', 
							  
							  'title'      =>  'Company Address',
							  
							  'data-glyph' =>  'map-marker'));
            
			if($data->$prefix < 2 || $data->user_type == 1)
		
		    {
            
            echo anchor('clientarea/customers/edit/address/'.$row_data[0]->staff_add_id.'', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				  'data-title' => 'Edit Company Address', 
							  
							  'title'      =>  'Company Information',
							  
							  'data-glyph' =>  'briefcase',
							  
							  'data-action' => false));
							  
							  
			} ?>           
           
           
        </div>
   
      </div>
      
  