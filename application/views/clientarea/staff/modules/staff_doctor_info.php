 <div id="collapse5" class="panel-collapse collapse">
     	
      <div class="panel-body">
        
        <div class="staff-details">
        	
          <p>Doctors Name:&nbsp;&nbsp;<span class="lead">Dr. <?php echo $row_data[0]->doctors_name; ?></span></p>
          
        </div>
        
        <?php $atts = array('dadd_1', 'dadd_2', 'dadd_3', 'dadd_city', 'dadd_postcode'); 
        
        echo "<ul class=\"profile-contact\">";
         
          foreach ($atts as $a) 
		 
		 {
		 	
			echo "<li>".$row_data[0]->$a."</li>";
			
		 }
		 
		 echo "</ul>";
		 
		 $labels = array('Surgery Number', 'Emergency Number');
		 
		 $atts = array('doc_tel', 'doc_tel_eve');
		 
		 echo "<ul class=\"profile-contact\">";
		 
		 for($i=0;$i<2;$i++)
		 
		 {
		 	
			echo "<li><strong>".$labels[$i].":</strong>&nbsp;&nbsp;".$row_data[0]->$atts[$i]."</li>";
		 }
		 
		  echo "</ul>";
		 
		 ?>
         
      
        <br>
        
        <div class="btn-group pull-right">
        	
           <?php 
            
            echo anchor('clientarea/sites/maps/'.str_replace(' ', '',trim($row_data[0]->dadd_postcode)).'', 
            
            				  '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Google Maps', 
            				  
            				  array('class' => 'btn btn-default map', 
            				  
            				  'data-title' => '', 
							  
							  'title'      =>  'Company Address',
							  
							  'data-glyph' =>  'map-marker'));
            
            if($data->$prefix < 2 || $data->user_type == 1)
		
		  {
		  	
            echo anchor('clientarea/staff/edit/'.$row_data[0]->staff_id.'/doctor_edit/'.$row_data[0]->doc_cont_id.'/'.$row_data[0]->doc_add_id, 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				  'data-title'  => 'Edit Staff Doctors Details', 
							  
							  'title'       =>  'Company Information',
							  
							  'data-glyph'  =>  'user',
							  
							  'data-action' => false)); 
							  
							  }
							  
							  ?> 
							  
        </div>      
                   
      </div>
      
    </div>
    </div>