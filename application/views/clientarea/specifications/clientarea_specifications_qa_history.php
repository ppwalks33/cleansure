<?php

		echo sprintf($this->lang->line('tag_heading'), 'Quality Audit History'); 
		
		if(is_array($history))
		
		{
			
		  echo "<br><br>";
		
		  echo "<div role=\"tabpanel\">";
		  
		  echo "<ul class=\"nav nav-tabs\" role=\"tablist\">";
		
		  for($i=0;$i<count($tabheaders);$i++)
		  
		  {
		  	
			$id = strtolower(str_replace(' ', '', $tabheaders[$i]));
		  	
			echo "<li role=\"presentation\" class=\"".($i==0?'active':NULL)."\"><a href=\"#".$id."\" aria-controls=\"".$id."\" role=\"tab\" data-toggle=\"tab\">".$tabheaders[$i]."</a></li>";
			
		  }
		  
		  echo "</ul>";
		  
		  echo "<div class=\"tab-content\">\n";
		  
		  $i=0;
		  
		  foreach(arraySort($history, 'spec_name') as $name => $qas)
		  
		  {
		  	
			$id = strtolower(str_replace(' ', '', $name));
		  	
			echo "<div role=\"tabpanel\" class=\"tab-pane ".($i==0?'active':NULL)." \" id=\"".$id."\"><br>
			
						<h3>".$name."</h3>";
						
			
			$this->load->view($modules.'qa_history' , array('qas' => $qas));
						
						
			echo "</div>";
			
			
			$i++;
			
		  }
		  
		    echo "</div>";
			
			 echo "</div>";
		  
		}
?>

