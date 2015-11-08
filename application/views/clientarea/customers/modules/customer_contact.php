<div class="panel-body">
	
  <ul class="profile-contact">
        	
          <li><strong>E-mail:</strong>&nbsp;&nbsp;
          	
          		<a href="mailto:<?php echo $customer_data[0]->comp_email;?>" title="E-mail '<?php echo $customer_data[0]->first_name.'&nbsp;'.$customer_data[0]->last_name; ?>' ">
          	
          						<?php echo (!empty($customer_data[0]->comp_email) ? $customer_data[0]->comp_email:$na); ?>
          						
          	    </a>
          	    
          </li>
          
          <li>&nbsp;</li>
          
          <?php 
          
          		$cust_cont = array('Daytime' => 'comp_tel', 'Evening' => 'comp_eve_tel', 'Mobile' => 'comp_mob', 'Fax' => 'comp_fax'); 
          		
          		foreach ($cust_cont as $k => $v)
				
				{
					
					echo "<li>\n";
					
					echo "<strong>".$k."</strong>&nbsp;&nbsp;\n";
					
					echo (!empty($customer_data[0]->$v) ? $customer_data[0]->$v:$na)."\n";
					
					echo "</li>";
					
				}
          		
          	?>
          
          
        </ul>
        <br>
        
        <div class="btn-group pull-right">
        	
            
            <?php 
            
            if($data->$prefix < 2 || $data->user_type == 1)
		
		    {
            
            echo anchor('clientarea/customers/edit/contact/'.$customer_data[0]->comp_cont_id.'', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-default trigger', 
            				  
            				        'data-title' => 'Edit Company Contact',
									
									'title'      =>  'Company Contact Details',
									
									'data-glyph'      =>  'user',
									
									'data-action' => false));
									
									} 
									
			?>
            
        </div>
        
      </div>
    