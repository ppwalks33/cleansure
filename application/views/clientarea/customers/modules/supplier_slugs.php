 <div class="table-responsive customers">
        
      <table class="table table-striped table-hover">
      	
      	<thead>
      		
      		<tr>
      			
      			<th>Name</th>
      			
      			<th>URL</th>
      			
      			<?php 
      			
      				if($data->$prefix < 2 || $data->user_type == 1)
		
						{ 
							
						?>
      			
      							<th>Delete</th>
      			
      			<?php } ?>
      			
      		</tr>
      		
      	</thead>
      	
      	<tbody>
      		
      		<?php 
      		
      			
				
				if(isset($customer_data[0]->url_id))
				
				{
					
				$items = array('url_id', 'url_name', 'slug'); 
      			
      			for($i=0;$i<3;$i++)
				
					{
					
						${$items[$i]} = array_map('trim', explode(',', $customer_data[0]->$items[$i]));
					
					}
					
				}
					
					if(isset($url_id) && is_array($url_id))
					
					{
						
						
						for($i=0;$i<count($url_id);$i++)
						
						{
							
							echo "<tr id=\"".trim($url_id[$i])."\">\n";
							
							
      			
      				     if($data->$prefix < 2 || $data->user_type == 1)
		
						{ 
							
						
							
							echo "<td>".anchor('clientarea/suppliers/slugs/'.trim($url_id[$i]).'/'.(int)true.'/', $url_name[$i], array('data-title' => 'Edit Slug', 'data-action' => false, 'title' => 'Click To Edit '.$url_name[$i].' Page', 'class' => 'trigger'))."</td>\n";
							
						}
						
						 else
						 	
						 {
						 		
								echo "<td>".$url_name[$i]."</td>\n";
								
						 }							
							echo "<td><a href=\"".prep_url($slug[$i])."\" target=\"_blank\" title=\"".$slug[$i]."\">".$slug[$i]."</a></td>\n";
							
							if($data->$prefix < 2 || $data->user_type == 1)
		
								{
							
							echo "<td>".anchor('clientarea/suppliers/slug/'.(int)false.'/'.trim($url_id[$i]),'<span class="label label-default google-maps"><span class="glyphicon glyphicon-remove"></span>Delete</span>', array('class' => 'delete', 'data-id' => $url_id[$i]))."</td>\n";
								
								}
														
							echo "</tr>\n";
							
							
						}
						
					}
					
					else 
					
					{
						
						echo "<tr>\n<td>No Links Added Yet!</td>\n<td></td>\n<td></td>\n</tr>\n";
					}
      			
      			?>
      		
      	</tbody>
      	
      </table>
      
      </div>
      
      <?php 
      			
      				if($data->$prefix < 2 || $data->user_type == 1)
		
						{ 
							
						?>
      
     <div class="btn-group pull-right">
        	
        	<?php echo anchor('clientarea/suppliers/slugs/'.$customer_data[0]->comp_id.'/'.(int)false, '<span class="glyphicon glyphicon-paperclip"></span>&nbsp;&nbsp;Add Link', array('data-title' => 'Add Slug', 'data-action' => false, 'class' => 'trigger btn btn-default'))?>
        	
          
        </div>
        
<?php } ?>