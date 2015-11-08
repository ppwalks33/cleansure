
<?php 
		
		echo sprintf($this->lang->line('h4'), 'Current score'); 
		
		
		echo "<ul>\n";
		
		
		echo "<li>".$score[2]."%";
		
		
		if(isset($myScore))
		
		{
			
		
		 echo "<span class=\"".($myScore[1] == true ? 'up':'down')."\"><span class=\"glyphicon glyphicon-circle-arrow-".($myScore[1] == true ? 'up':'down')."\"></span>&nbsp;- ".$myScore[2]."%</span>";
		 
		 
		}
		 
		 
		 echo"</li>\n";
		 
		
		echo "<li>".$score[1]." out of ".$score[0]."</li>\n";
		
		
		echo "</ul>\n";
		
?>
            	  
      