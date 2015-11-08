<?php

if(isset($wk_orders) && is_array($wk_orders))

{

 $costs = array('labour_cost', 'material_cost', 'machine_cost', 'total_cost');

 echo "<div class=\"table-responsive\">\n";
  
  		echo "<table class=\"table table-hover\">\n";
  
  		echo "<thead>\n";
  
  		echo "<tr>\n";
  
  					$headers = array('Type','Order Ref', 'Customer',  'Site', 'Date Added', 'Commence Date', 'Finish Date', 'Costs', 'Staff', 'Days', 'Notes', 'Actions');
					
					
  
  					for($i=0;$i<count($headers);$i++)
  
  					{
  						
						
  	
								echo "<th>".$headers[$i]." </th>\n";
								
							
	
  					}
					
					
  
  		echo "</tr>\n";
 
        echo "</thead>\n";
		
		echo "<tbody>\n";
		
		foreach($wk_orders as $wo)
		
		{
			
		//	echo "<tr>\n";
		
			
				echo "".($wo['type'] == 1 ? '<tr>':'<tr class="info">')."\n";
			
				echo "<td>".($wo['type'] == 1 ? '<span class="fa fa-warning hideIcon"></span> One Shot':'<span class="fa fa-refresh hideIcon"></span> Recurring')."</td>";
				
				echo "<td>".$wo['order_num']."</td>";
				
				echo "<td><span class=\"fa fa-briefcase hideIcon\"></span> ".$wo['company_name']."</td>\n";
				
				echo "<td><span class=\"fa fa-building hideIcon\"></span> ".$wo['site_name']."</td>\n";
				
				echo "<td><span class=\"glyphicon glyphicon-time hideIcon\"></span> ".format_date($wo['created'])."</td>\n";
				
				echo "<td><span class=\"bottomPadBtn blockItem\"><span class=\"glyphicon glyphicon-time hideIcon\"></span> ".format_date($wo['startDate'])."</span> ".anchor(current_url().'/'.'updateDate/'.$wo['com_id'], '<span class="fa fa-calendar"></span> Edit Start Date', array('title' => 'Dates', 'data-title' => 'Dates', 'class' => 'trigger btn btn-success btn-xs blockBtn', 'data-action' => false))."</td>\n";
				
				echo "<td><span class=\"bottomPadBtn blockItem\"><span class=\"glyphicon glyphicon-time hideIcon\"></span> ".format_date($wo['finishDate'])."</span> ".anchor(current_url().'/'.'updateDate/'.$wo['fin_id'], '<span class="fa fa-calendar"></span> Edit Deadline Date', array('title' => 'Dates', 'data-title' => 'Dates', 'class' => 'trigger btn btn-success btn-xs blockBtn', 'data-action' => false))."</td>\n";
				
				echo "<td>".anchor(current_url().'/'.'costs/'.$wo['wk_id'], '<span class="fa fa-eye"></span> View Costings', array('title' => 'View Costs', 'data-title' => 'WO Costs', 'class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-action' => false))."</td>\n";
				
				echo "<td>".anchor(current_url().'/'.'staff/'.$wo['wk_id'], '<span class="fa fa-eye"></span> View Staff/ Hours', array('title' => 'View Staff', 'data-title' => 'Current Staff', 'class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-action' => false))."</td>\n";
				
				echo "<td>".anchor(current_url().'/'.'days/days/'.$wo['days_id'], '<span class="fa fa-eye"></span> View Days', array('title' => 'Days', 'data-title' => 'Days', 'class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-action' => false))."</td>\n";
				
				echo "<td>".anchor(current_url().'/'.'notes/'.$wo['wk_id'], '<span class="fa fa-eye"></span> View Job Notes', array('title' => 'Notes', 'data-title' => 'Notes', 'class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-action' => false))."</td>\n";
				
				echo "<td>"
					
					.anchor('/clientarea/work_orders/task/'.$wo['wk_id'], '<span class="fa fa-bullhorn"></span> Edit Work Order', array('class' => 'btn btn-success btn-xs blockBtn actionBtn'))
					
					
					.anchor('clientarea/customers/profile/'.$wo['cust_id'], '<span class="fa fa-briefcase"></span> Edit Customer Profile', array('class' => 'btn btn-success btn-xs blockBtn actionBtn'))
					
					.anchor('clientarea/sites/profile/'.$wo['sites_id'], '<span class="fa fa-building"></span> Edit Customer Site', array('class' => 'btn btn-success btn-xs blockBtn actionBtn'))
					
					
					
					."<span class=\"topPad blockItem\">"
					
					.anchor('#', '<span class="fa fa-trash"></span> Delete Work Order', array('class' => 'btn btn-danger btn-xs blockBtn actionBtn'))
					
					."</span></td>\n";
				
				
			//	.anchor('/clientarea/work_orders/task/'.$wo['wk_id'], '<span class="glyphicon glyphicon-user"></span> Edit Profile', array('class' => 'btn btn-success btn-xs blockBtn actionBtn')."</td>\n";
			//	</td>\n";			
			
			echo "<tr>\n";
			
		}
		
		
		echo "</tbody>\n";
		
		echo "</table>\n";
		
		echo "</div>\n";
		
		}

			else
				
		{
			if($delete == true)
			{
			
			echo sprintf($this->lang->line('h2'), 'Nothing To Delete..');	
				
			}else {
				
				echo sprintf($this->lang->line('h2'), 'Steps To Take First..');
			
			    echo "<p>Before you add a work order you must do the following first.</p>\n";
			
			    echo "<ul>\n";
			
			    echo "<li>Add A Customer Into The System.</li>\n";
			
			    echo "<li>Add A Staff Member Into The System.</li>\n";
			
			    echo "</ul>\n";
				
			}
			
		}
		
		?> 