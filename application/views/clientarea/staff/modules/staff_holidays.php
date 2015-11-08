<?php
	echo "<h4 class=\"bottomPad\">".(isset($header) ? $header:NULL)."</h4>\n"; 
?>
	<div class="nav-tabs-custom">
	<!-- Tab Menu -->
	<?php
	
		echo '<ul class="nav nav-tabs">';
		
		$tabsTitle = array('Holidays' => 'plane', 'Past Holidays' => 'calendar', 'Open Requests' => 'share');
		
		// echo "<ul class=\"nav nav-tabs\" role=\"tablist\">\n";
		
		$i=0;
		
	    foreach ($tabsTitle as $ref => $glyph) {
			
			echo "<li ".($i==0?'class="active"':null).">".anchor('#tab_'.$i,ucwords($ref),array('title' => $ref, 'data-toggle' => 'tab'))."</li>";
		
		  $keys[$i] = $ref;
			
		  $i++;
		}
		echo '</ul>';
		?>
	<!-- /.Tab Menu -->
	<div class="tab-content">
		
		<?php
		$n = 0;
		$i = 0;
		foreach($keys as $k)
		
		{
			$n++;
			
			$var = "row_data_".$n;
			
			// echo "<div class=\"tab-pane ".($n == 1 ? "active":NULL). "\" id=\"".$k."\">\n";
			echo "<div class=\"tab-pane".($i==0?' active"':'"')." id=\"tab_".$i."\">";
			
			$i++;
			
			echo " <div class=\"table-responsive\">\n";
			
				echo "<table class=\"table table-striped table-hover\">\n";
				
				echo "<thead>\n";
          	
                echo "<tr>\n";
            	
                echo "<th>Leave Date&nbsp;&nbsp;".anchor('#', '<span class="glyphicon glyphicon-sort"></span>', array('title'=>'Sort By Leave Date ASC'))."</th>\n";
              
                echo "<th>Return Date&nbsp;&nbsp;".anchor('#', '<span class="glyphicon glyphicon-sort"></span>', array('title'=>'Sort By Return Date ASC'))."</th>\n";
				
				if($n == 1 || $n == 3) 
				
				{
              
                echo "<th>Controls&nbsp;&nbsp;</th>\n";
					
				}
              
                echo "</tr>\n";
              
                echo "</thead>\n";
			 
			    echo "<tbody>\n";		
				
				if(isset(${$var}))
				
				{
									
					foreach(${$var} as $row)
					
					{
						//print_r($row);
						
						  echo "<tr id=\"".$row->hol_id."\">\n";
						  
						  	echo "<td><span class=\"glyphicon glyphicon-time\"></span>&nbsp;".format_date($row->start_date)."</td>\n";
							
							echo "<td><span class=\"glyphicon glyphicon-time\"></span>&nbsp;".format_date($row->finish_date)."</td>\n";
							
							if($n == 1 || $n == 3) {
								
								echo "<td>\n";
							
								if($n == 1)
								
								{
									
									if($data->$prefix < 2 || $data->user_type == 1)
		
									{
	
									echo anchor('/clientarea/staff/update_holidays/'.$row->start_id.'/'.$row->finish_id.'/'.(int)false.'/'.$row->staff_id, '<span class="label label-default blue"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</span>', array('class' => 'holiday_trigger'))."&nbsp;\n";
	
									echo anchor('/clientarea/staff/update_holidays/'.$row->start_id.'/'.$row->finish_id.'/'.$row->hol_id.'/'.$row->staff_id, '<span class="label label-default red"><span class="glyphicon glyphicon-plane"></span>&nbsp;&nbsp;Delete</span>', array('class' => 'delete', 'data-id' => $row->hol_id, 'data-counter' => 'alertCounter'));
		
									}
									
								}
								
								elseif($n == 3)
								
								{
									
									if($data->$prefix < 2 || $data->user_type == 1)
		
									{
									
									echo anchor('/clientarea/staff/approval/1/'.$row->hol_id.'/'.$row->staff_id, '<span class="label label-default"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Approve</span>', array('class' => 'approval', 'data-counter' => 'alertCounter'))."&nbsp;\n";
									
									echo anchor('/clientarea/staff/update_holidays/'.$row->start_id.'/'.$row->finish_id.'/'.$row->hol_id.'/'.$row->staff_id, '<span class="label label-default red"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Decline</span>', array('class' => 'holiday_trigger delete', 'data-id' => $row->hol_id))."\n";
									
									}
								
								}
								
								echo "</td>\n";
								
							}
						  
						  echo "</tr>\n";						
					}

					
				}
			 			
				echo "</tbody>\n";
				
				echo "</table>\n";
			
			echo "</div>\n<br>\n<br>";
			
			
			
			if($n == 1)
				
				{
					
					if($data->$prefix < 2 || $data->user_type == 1)
		
						{
					
					$this->load->view('clientarea/staff/modules/holiday_request');
					
						}
					
				}
			
			echo "</div>";
			
		}
		
		?>
	</div>
</div>	
	
	

	
	
	<?php 
	
	/* OLD CODE BELOW */
	/*
		$nav = array('holidays' => 'plane', 'past_holidays' => 'calendar', 'open_requests' => 'share');
	
	
		
		echo "<ul class=\"nav nav-tabs\" role=\"tablist\">\n";
		
		$i=0;
		
		foreach($nav as $item => $glyph)
		
		{
			
			echo "<li ".($i == 0 ? "class=\"active\"":NULL).">\n";
			
			echo anchor('#'.$item, "<span class=\"glyphicon glyphicon-".$glyph."\"></span>&nbsp;&nbsp".str_replace('_', ' ', ucwords($item)), array('role' => 'tab', 'data-toggle' => 'tab'))."\n";
			
			echo "</li>\n";
			
			$keys[$i] = $item;
			
			$i++;
		}
		
		
		echo "</ul>\n";
		
		echo "<div class=\"tab-content\">";
		
		$n = 0;
		
		foreach($keys as $k)
		
		{
			$n++;
			
			$var = "row_data_".$n;
			
			echo "<div class=\"tab-pane ".($n == 1 ? "active":NULL). "\" id=\"".$k."\">\n";
			
			echo " <div class=\"table-responsive\">\n";
			
				echo "<table class=\"table table-striped table-hover\">\n";
				
				echo "<thead>\n";
          	
                echo "<tr>\n";
            	
                echo "<th>Leave Date&nbsp;&nbsp;".anchor('#', '<span class="glyphicon glyphicon-sort"></span>', array('title'=>'Sort By Leave Date ASC'))."</th>\n";
              
                echo "<th>Return Date&nbsp;&nbsp;".anchor('#', '<span class="glyphicon glyphicon-sort"></span>', array('title'=>'Sort By Return Date ASC'))."</th>\n";
				
				if($n == 1 || $n == 3) 
				
				{
              
                echo "<th>Controls&nbsp;&nbsp;</th>\n";
					
				}
              
                echo "</tr>\n";
              
                echo "</thead>\n";
			 
			    echo "<tbody>\n";		
				
				if(isset(${$var}))
				
				{
									
					foreach(${$var} as $row)
					
					{
						//print_r($row);
						
						  echo "<tr id=\"".$row->hol_id."\">\n";
						  
						  	echo "<td><span class=\"glyphicon glyphicon-time\"></span>&nbsp;".format_date($row->start_date)."</td>\n";
							
							echo "<td><span class=\"glyphicon glyphicon-time\"></span>&nbsp;".format_date($row->finish_date)."</td>\n";
							
							if($n == 1 || $n == 3) {
								
								echo "<td>\n";
							
								if($n == 1)
								
								{
									
									if($data->$prefix < 2 || $data->user_type == 1)
		
									{
	
									echo anchor('/clientarea/staff/update_holidays/'.$row->start_id.'/'.$row->finish_id.'/'.(int)false.'/'.$row->staff_id, '<span class="label label-default blue"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</span>', array('class' => 'holiday_trigger'))."&nbsp;\n";
	
									echo anchor('/clientarea/staff/update_holidays/'.$row->start_id.'/'.$row->finish_id.'/'.$row->hol_id.'/'.$row->staff_id, '<span class="label label-default red"><span class="glyphicon glyphicon-plane"></span>&nbsp;&nbsp;Delete</span>', array('class' => 'delete', 'data-id' => $row->hol_id, 'data-counter' => 'alertCounter'));
		
									}
									
								}
								
								elseif($n == 3)
								
								{
									
									if($data->$prefix < 2 || $data->user_type == 1)
		
									{
									
									echo anchor('/clientarea/staff/approval/1/'.$row->hol_id.'/'.$row->staff_id, '<span class="label label-default"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Approve</span>', array('class' => 'approval', 'data-counter' => 'alertCounter'))."&nbsp;\n";
									
									echo anchor('/clientarea/staff/update_holidays/'.$row->start_id.'/'.$row->finish_id.'/'.$row->hol_id.'/'.$row->staff_id, '<span class="label label-default red"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Decline</span>', array('class' => 'holiday_trigger delete', 'data-id' => $row->hol_id))."\n";
									
									}
								
								}
								
								echo "</td>\n";
								
							}
						  
						  echo "</tr>\n";						
					}
				}
			 			
				echo "</tbody>\n";
				
				echo "</table>\n";
			
			echo "</div>\n<br>\n<br>";
			
			
			
			if($n == 1)
				
				{
					
					if($data->$prefix < 2 || $data->user_type == 1)
		
						{
					
					$this->load->view('clientarea/staff/modules/holiday_request');
					
						}
					
				}
			
			echo "</div>";
			
		}
		
		
		echo "</div>"; 
		*/	
			?>