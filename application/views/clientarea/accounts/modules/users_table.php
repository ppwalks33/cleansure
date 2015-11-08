<?php

	echo "<div class=\"table-responsive customers\">\n";
  
  		echo "<table class=\"table table-striped table-hover\">\n";
  
  		echo "<thead>\n";
  
  		echo "<tr>\n";
  
  					$headers = array('Name', 'Email', 'Username', 'Level', 'Date Added', 'Permissions', 'Actions');
  
  					for($i=0;$i<count($headers);$i++)
  
  					{
  						
						
  	
								echo "<th>".$headers[$i]."&nbsp;&nbsp;</th>\n";
								
							
	
  					}
  
  		echo "</tr>\n";
 
        echo "</thead>\n";
		
		echo "<tbody>\n";
		
			foreach ($accounts as $user)
			
			{
				
				echo "<tr id=\"".$user['u_id']."\">\n";
				
				echo "<td><strong>\n";
				
				echo "<i class=\"glyphicon glyphicon-user hideIcon\"></i> ".ucwords($user['first_name'].'&nbsp;&nbsp;'.$user['last_name']);
				
				echo "<strong></td>\n";
				
				echo "<td>\n";
				
				    echo "<strong>".mailto($user['email_address'], $user['email_address'])."</strong>";
				
				echo "</td>\n";
				
				echo "<td>\n";
				
					echo $user['username'];
				
				echo "</td>\n";
				
				echo "<td>\n";
				
					echo ucwords(str_replace('_', ' ', $level[$user['type']]));
				
				echo "</td>\n";
				
				echo "<td>\n";
				
					echo "<i class=\"glyphicon glyphicon-time hideIcon\"></i> ".format_date($user['date']);
				
				echo "</td>\n";
				
				echo "<td>\n";
				
					echo anchor('clientarea/accounts/permissions/'.$user['u_id'], '<i class="fa fa-eye rightPadIcon"></i> View Permissions', array('title' => 'View Account Permissions', 'class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-title' => 'Account Permissions', 'data-action' => false));
				
				echo "</td>\n";
				
				echo "<td>\n";
				
				if($data->$prefix < 2 || $data->user_type == 1)
		
					{
				
				echo anchor('/clientarea/accounts/edit/'.$user['u_id'], '<i class="glyphicon glyphicon-user"></i> Edit User Profile', array('title' => 'Edit User Profile'.$user['first_name'].' '.$user['last_name'].'\'s Account', 'class' => 'btn btn-success btn-xs blockBtn actionBtn', 'data-title' => 'Edit User', 'data-action' => false));
				
				
					}
					
				echo "</td>\n";
				
				
				echo "</tr>\n";
				
			}
		
		echo "</tbody>\n";
		
		echo "</table>\n";
		
		 echo "</div>\n";

?>