
<?php  $b =  $data; ?>

<div class="table-responsive">
        	
        <table class="table table-striped table-hover">
        	
        
          <thead>
          	
            <tr>
            	
              <th>Contact Name&nbsp;&nbsp;<a href="#" title="Sort Contact Names"><span class="glyphicon glyphicon-sort"></span></a></th>
              
              <th>Contact Details</th>
              
              <th>Notes&nbsp;&nbsp;<a href="#" title="Sort Notes"><span class="glyphicon glyphicon-sort"></span></a></th>
              
              </tr>
              
            </thead>
            
            <?php 
            
            	 $i=0;
				 
				 $btn = array('contact', 'note');
            
            	 foreach($site_contacts as $c): 
					 
					$url = "/clientarea/sites/contacts/".(!empty($c->u_id) ? $c->u_id:0)."/".$c->s_id."/".$c->c_id."/";
					 
					$note_url = "/clientarea/sites/notes/".(!empty($c->u_id) ? $c->u_id:0)."/";
            	 
              		echo "<tr class=\"".($i == 0 ? "main-contact":NULL)."\">\n<td>\n"; 
					
					if(!empty($c->f_name))
					
					{
              			
              		  echo "<span class=\"glyphicon glyphicon-user\"></span>&nbsp;&nbsp;".anchor($url.$btn[0], $c->f_name."&nbsp;".$c->l_name, 
              		  
              		  																			 array('class' => 'trigger', 
              		  																			 
              		  																			 	   'data-title' => 'Edit Contact Details', 
              		  																			 	   
              		  																			 	   'data-glyph' => 'user', 
              		  																			 	   
              		  																			 	   'data-action' => false))."\n"; 
					  
					}
					
					else 
					
					{
						echo "<span>Main Company Contact</span>";
					}
					
					echo "</td>\n<td>";
              				
              		$fields = array('daytime_telephone', 'evening_telephone', 'mobile_telephone', 'fax_number' , 'email_address');   
					
					
					$data = "";      
              		
              		foreach($fields as $f): 
					
					  $label = explode('_', $f);
              			
              			 $data .= (!empty($c->$f) ? 
              				
              							ucwords($label[0]).":&nbsp;&nbsp;".$c->$f."<br>".($label[0] = "fax" ? "<br>":NULL)
										
										:
              							
              							NULL);

						endforeach; 
						
						echo anchor($url.$btn[0], $data, 
						
									array('class' => 'trigger',
									
										  'data-title' => 'Edit Contact Details', 
										  
										  'data-glyph' => 'user', 
										  
										  'data-action' => false));	
						
						echo "</td><td>\n";
						
						if($c->u_id)
						
						{
				
						echo (!empty($c->message) && $c->m_u_id == $c->u_id ? anchor($note_url.$c->message_id.'/'.(int)$c->message_date, 
						
														   'View Notes', 
														   
														   array('class'          => 'popup note-author trigger',
						
															     'data-toggle'    => 'tooltip',
															 
															     'data-placement' =>  'top',
															
															     'title'          => '&raquo;&nbsp;&nbsp;'.$c->message_title,
															
															     'data-content'   => '<p>'.$c->message.'</p><hr><span>Last Edited:'.$c->auth_first_name.'&nbsp;'.$c->auth_last_name.'<br>Date:&nbsp;'.$c->date.'</span>',
															     
																 'data-action' => false,
																 
																 'data-title'  => 'Edit Note',
																 
																 'data-glyph'  => 'file'
															
																)) : 
																								
																							
												  ($data->$prefix < 2 || $data->user_type == 1 ? anchor($note_url, 
												   
												   		  '&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span> Add Note',
														  
														  array('class'       => 'trigger',
														  
														  		'data-glyph'  => 'file',
																
																'data-title'  => 'Add A Note',
																
																'data-action' => false)):NULL));
																
																}

		
																							
						
															
					echo "</td>\n</tr>\n";
						
           			$i++;
					
           			endforeach; 
					
					echo "</table>\n</div>\n<br>\n";
					
					echo "<div class=\"btn-group pull-right\">\n";
					
					
					if($b->$prefix < 2 || $b->user_type == 1)
		
					{
 	
					
					echo anchor('/clientarea/sites/contacts/-/'.$c->s_id.'/-/'.$btn[0], 
					
								'<span class="glyphicon glyphicon-plus"></span> New '.ucwords($btn[0]), 
								
								array('class'          => 'btn btn-default trigger',
						
									  'data-title'     => 'New '.$btn[0],
																																  
									  'data-glyph'     => 'user',
									  
									  'data-action' => false));
																	
					}															  
						 
					
					echo "</div>\n";
           			
           	?>
      
      </div>