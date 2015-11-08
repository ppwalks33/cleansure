 
 
 <?php 
 
      echo sprintf($this->lang->line('h4'), 'Last Score');
	  
	  echo "<ul>\n";
	  
	  echo "<li>".$previous_score[2]."% <span class=\"".($myScore[0] == true ? 'up':'down')."\"><span class=\"glyphicon glyphicon-circle-arrow-".($myScore[0] == true ? 'up':'down')."\"></span>&nbsp;- ".$myScore[2]."%</span></li>\n";
	  
	  echo "<li>".$previous_score[1]." out of ".$previous_score[0]."</li>";	  
	  
	  echo "</ul>\n";
	  
 ?>
            	