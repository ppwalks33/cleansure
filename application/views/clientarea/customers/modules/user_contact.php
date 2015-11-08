
	 
 <ul class="profile-contact topPad">
          
          <li>
          	
          		<strong>E-mail:</strong>&nbsp;&nbsp;
          		
          		<a href="mailto:<?php echo $customer_data[0]->email_address; ?>" title="E-mail '<?php echo $customer_data[0]->first_name.'&nbsp;'.$customer_data[0]->last_name; ;?>'">
          			
          			<?php echo (!empty($customer_data[0]->email_address) ? $customer_data[0]->email_address:$na); ?>
          			
          		</a>
          		
          </li>
          
          <li>&nbsp;</li>
          
          <?php 
          
          	$contact = array('Daytime' => 'daytime_telephone', 'Evening' => 'evening_telephone', 'Mobile' => 'mobile_telephone', 'Fax' => 'fax_number');
			
			foreach ($contact as $k => $c) {
			
			echo "<li>\n";
			
			echo "<strong>".$k.":</strong>&nbsp;&nbsp;\n";
			
			echo (!empty($customer_data[0]->$c) ? $customer_data[0]->$c:$na)."\n";
			
			echo "</li>";
			
			}
			
			?>
			
        </ul>
        
        <br>
        
        <div class="btn-group">
            
            <?php 
            
            if($data->$prefix < 2 || $data->user_type == 1)
		
		    {
		    	
            echo anchor('clientarea/customers/edit/contact/'.$customer_data[0]->uc_id.'', 
            
            				  '<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit', 
            				  
            				  array('class' => 'btn btn-success btn-sm bottomPadBtn trigger', 
            				  
            				  		'data-title' => ' Edit Main Contact',
            				  
            				  		'title'      =>  'Company Contact Details',
									
									'data-glyph'      =>  'user',
									
									'data-action' => false)); 
									
						}
						
						?>
            
        </div>
