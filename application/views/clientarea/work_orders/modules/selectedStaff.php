 <br><br>

<?php 


	foreach($selectedStaff as $selected)
	
	{
		
		echo "<br>\n";
		
		echo "<div class=\"row\">\n";
		
		echo "<div class=\"col-xs-12 col-lg-12\">\n";
		
		echo sprintf($this->lang->line('h4'), $selected[0]['first_name']."&nbsp".$selected[0]['last_name']);
		
		$times = array('start', 'end');
		
			for($i=0;$i<2;$i++)
		
				{
					
					echo "<div class=\"col-xs-12 col-lg-6\">\n";
					
					echo "<span><b>Please Enter The ".$times[$i]." Time</b></span>\n";
					
						echo "<div class=\"input-group bootstrap-timepicker\">\n";
						
						echo form_input(array('name' => $times[$i].'_time[]', 'class' => 'input-small form-control timepicker'));
						
						echo "<div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-time\"></span></div>";
									
						echo "</div>\n";
			
					echo "</div>\n";
				}
				
				echo "</div>\n";
		
		echo "</div>\n";
		
	}
	
	echo "<br>\n<br>\n<br>\n<br>";
?>