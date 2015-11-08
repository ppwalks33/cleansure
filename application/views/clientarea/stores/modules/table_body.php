<?php if(is_array($orders))

{
	
	/*
	 * Loop the orders
	 * 
	 */
	 echo "<div class=\"table-responsive customers\">\n";
	 
	 echo "<table class=\"table table-striped table-hover\">\n";
  
     echo "<thead>\n";
  
     echo "<tr>\n";
  
  $headers = array('Id','Parent','Order Reference','Customer Name', 'Site Name', 'Order Total', 'Date', 'Re-stock Date', 'Actions');
  
  for($i=0;$i<count($headers);$i++)
  
  {
  	
	echo "<th>".$headers[$i]."&nbsp;&nbsp;".anchor('#', '&nbsp;', array('title' => 'Sort '.$headers[$i]))."</th>\n";
	
  }
  
  echo "</tr>\n";
 
  echo "</thead>\n";
  
  echo "<tbody>\n";
	
	
	foreach($orders as $key => $order)
	
	{
		
		echo "<tr class=\"".(in_array($order['order_id'], $parent_ids)?'info':($order['parent_id'] > 0 ? 'success':NULL))."\">\n";
		
			echo "<td><span>#".$order['order_id']."</span></td>";
			
			echo "<td><span>".($order['parent_id'] == false ? 'N/A':'#'.$order['parent_id'])."</span></td>";
		
			echo "<td>"
					
					.$order['ref'].	
			
					// .anchor('/clientarea/stores/view_order/'.$order['order_id'].'/1/'.(in_array($order['order_id'], $parent_ids)?'0':'1'), 
					 
				//	 		$order['ref'], 
					 		
					// 		array('class' => 'trigger', 'data-title' => 'Order '.$order['ref'], 'data-dismiss' => true, 'data-action' => false)).
					 
					 
				 "</td>\n";
				 
			echo "<td>
			
						<span class='fa fa-briefcase'></span> ".$order['company_name'].
						
				         anchor('/clientarea/customers/profile/'.$order['customer_id'], 
				         		
				         		'&nbsp;&nbsp;<span class="glyphicon glyphicon-share-alt"></span>',
								
								array()
								)
						   
				  ."</td>\n";
				  
				  echo "<td>
			
						<span class='fa fa-map-marker'></span> ".$order['site_name'].
						
				         anchor('/clientarea/sites/profile/'.$order['site_id'], 
				         		
				         		'&nbsp;&nbsp;<span class="glyphicon glyphicon-share-alt"></span>',
								
								array()
								)
						   
				  ."</td>\n";
				  
				  echo "<td>
				  
				  			<span class=\"label label-success\">".$order['orderTotal']."</span>
				  			
				  			
				  			
				  			 ".anchor('/clientarea/stores/view_order/'.$order['order_id'].'/1/'.(in_array($order['order_id'], $parent_ids)?'0':'1'), 
				  						
				  					 '<span class="fa fa-eye rightPadIcon"></span> View Order', 
				  					 
				  					 array('class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-title' => 'Order '.$order['ref'], 'data-dismiss' => true, 'data-action' => false)
									 
									 )."
				  			
				  		</td>\n";
				  
				  echo "<td>".format_date($order['date'])."</td>\n";
				  
				  echo "<td>".anchor(
				  
				  					'/clientarea/stores/re_stock/'.$order['order_id'].($order['restock'] != '' ? '/1/':NULL),
									
									'<span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;'.($order['restock'] != '' ? format_date($order['restock']):'Add Date'),
									
									array('class' => 'trigger', 'data-title' => 'Re-Stock Date', 'title' => 'Re-Stock Date', 'data-reload' => true, 'data-action' => false)
									
									)."</td>\n";
				  
				 
				  	
				  
				  
				  echo "<td>";
				  
				   if(!isset($delete))
				  
				  {
				  
				  echo	anchor('/clientarea/stores/view_order/'.$order['order_id'].'/0/', 
				  
				  				'<span class="glyphicon glyphicon-open"></span>', 
				  				
				  				array(
				  				
				  					  'class' => '', 
				  					  
				  					  'title' => 'Open Order '.$order['ref'])
									  
								)."&nbsp;&nbsp;";
				  		
				  echo	anchor('/clientarea/stores/save_order/'.$order['order_id'], 
				  
				  			   '<span class="glyphicon glyphicon-floppy-disk"></span>', 
				  			   
				  			      array('class' => 'save_order', 
				  			      
				  			           'title' => 'Save Order '.$order['ref'], 
				  			           
				  			           'data-order' => $order['order_id'])
									   
							)."&nbsp;&nbsp;";
				  
				  }

					else 
					
					{
						
				if(isset($delete))
				
				{
	
				  echo anchor('clientarea/stores/reinstate/'.$order['order_id'], 
               			
               								'<span class="glyphicon glyphicon-ok-sign"></span>',
               								
               											array('class' => 'reinstate',               										
														
														'title' => 'Move Order From Deleted?')
														
												)."&nbsp;&nbsp;";
					}

                }
						
				  echo	anchor('/clientarea/stores/delete/'.$order['order_id'].'/'.((isset($delete)) && ($delete) != false ? '1':'0').'/', 
				  
				  				'<span class="glyphicon glyphicon-remove"></span>', 
				  				
				  				array('class' => ((isset($delete)) && ($delete) != false ? 'confirmDeleteOrder':NULL), 'title' => 'Delete Order '.$order['ref'], 'data-order' => $order['order_id'])
								
							  );
				  
				   echo "</td>\n";
		
		
		echo "</tr>\n";
		
		
		
	}

 echo "</tbody>\n</table>\n</div>";
	
}

else {
	
	echo vsprintf($this->lang->line('h2_heading'), array('warning-sign', 'No Orders Available'));
}

?>
