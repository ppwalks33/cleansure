<?php

	
	// If error if I use the below line now commented out I've but the link 6 in place from the work orders which make is only half work! Need fixing so I can style
	// if(is_array($purchase_orders))
	if(isset($purchase_orders) && is_array($purchase_orders))
	{
		$this->table->set_heading('Date', 'Customer', 'Site', 'Supplier','Order Ref', 'Stores Ref', 'Type', 'Notes','Cost', 'VAT' , 'Actions');
		
		// echo sprintf($this->lang->line('h4'), 'Purchase Orders');
		
		foreach($purchase_orders as $o)
		{
			
			$this->table->add_row('<span class="glyphicon glyphicon-time hideIcon"></span> '.format_date($o['date']), 
			
									'<span class="fa fa-briefcase hideIcon"></span> '. $o['company_name'],
									
									//anchor('/clientarea/customers/profile/'.$o['cus_id'], 
										
									//		$o['company_name'], 
											
									//		array('title' => 'Go To '.$o['company_name'])
											
									//		), 
									
									'<span class="fa fa-building hideIcon"></span> '. $o['site_name'],
									
									// anchor('/clientarea/sites/profile/'.$o['site_id'],
										
									//		$o['site_name'],
											
									//		array('title' => 'Go To '.$o['site_name'])),
									
									
								
									
								
									($o['supplier'] != '' ? 
										
										'<span class="fa fa-shopping-cart hideIcon"></span> '. $o['supplier']
										
										:
										'<span class="glyphicon glyphicon-remove cross"></span> N/A'),
										
										
									/*
									anchor('/clientarea/suppliers/profile/'.$o['supplier_id'],
												
												$o['supplier'],
												
											array('title' => 'Go To '.$o['supplier'].' Profile')
											)
										
										:span('remove')), 
									*/
									
									
									'#'.$o['purchase_ref'],
									
									($o['ref'] != '' ? 
									
										anchor('/clientarea/stores/view_order/'.$o['order_id'].'/1/1',
										
												'<span class="fa fa-eye"></span> '.$o['ref'], 
												
												array('class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-title' => 'Order '.$o['ref'], 'data-dismiss' => true, 'data-action' => false)
												
											   )
												
												:'<span class="glyphicon glyphicon-remove cross"></span> N/A'), 
									
									($o['order_type'] == 1 ? '<span>Stores Order</span>':'<span>Custom Order</span>'), 
									
									anchor('/clientarea/work_orders/view_notes/'.$o['id'],
									
											'<span class="fa fa-eye"></span> View Notes',	
											
											array('class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-title' => 'Order '.$o['ref'], 'data-dismiss' => true, 'data-action' => false)),
											
									'<strong>&pound;&nbsp;'.$o['cost'].'</strong>',
									
									($o['tax'] == true ? 
										
										'<span class="glyphicon glyphicon-ok tick"></span>'
										:
										'<span class="glyphicon glyphicon-remove cross"></span>'
										
										),
				
									
									($delete == true ? anchor('/clientrea/work_orders/reinstate/'.$o['id'], span('ok-sign'), array('title' => 'Re-instate Order')):NULL).'&nbsp;&nbsp;'.
									
									
									anchor('/clientarea/customers/profile/'.$o['cus_id'], '<span class="fa fa-briefcase"></span> Edit Customer Profile', array('class' => 'btn btn-success btn-xs blockBtn actionBtn')).
									
									anchor('/clientarea/sites/profile/'.$o['site_id'], '<span class="fa fa-briefcase"></span> Edit Customer Site', array('class' => 'btn btn-success btn-xs blockBtn actionBtn')).
									
									anchor('/clientarea/suppliers/profile/'.$o['supplier_id'], '<span class="fa fa-shopping-cart"></span> Edit Supplier', array('class' => 'btn btn-success btn-xs blockBtn actionBtn')).
	
			
	
									'<span class="topPad blockItem">'.
									
									anchor('/clientarea/work_orders/print/'.$o['id'], '<span class="glyphicon glyphicon-print"></span> Print Purchase Order', array('class' => 'btn btn-success btn-xs blockBtn actionBtn topPad')).	
									
									'</span>'.
									
									'<span class="topPad blockItem">'.
									
									anchor('/clientarea/work_orders/delete/'.$o['id'].'/2/0', '<span class="fa fa-trash"></span> Delete Purchase Order', array('class' => 'btn btn-danger btn-xs blockBtn actionBtn topPad')).
									
									'</span>'
									// btn btn-danger btn-xs blockBtn actionBtn
									//.anchor('#', '<span class="fa fa-trash"></span> Delete Work Order', array('class' => 'btn btn-danger btn-xs blockBtn actionBtn'))
									
									);
		}

	echo $this->table->generate();
		
		
	}
	else {
		
	//	echo "<div class=\"warning\">";
	
	echo 'No Purchase Orders Available';
			
	//    echo vsprintf($this->lang->line('h2_heading'), array('warning-sign', 'No Purchase Orders Available...'));
			
	//	echo "</div>";
	}
	
	
	

?>