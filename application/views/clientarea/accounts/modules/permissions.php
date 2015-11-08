<?php 
	
		//print_r($data);
	echo "<div class=\"table-responsive permissions\">\n";
  
    echo "<table class=\"table table-striped table-hover\">\n";
  
    echo "<thead>\n";
	
	echo "<tr>\n";
	
		echo "<th>Area</th>\n";
		
		echo "<th>Permission</th>\n";
		
		if($data->$prefix < 2 || $data->user_type == 1)
		
		{
		
		   echo "<th>Actions</th>\n";
		   
		}
	
	echo "</tr>\n";
	
	echo "</thead>\n";
	
	echo "<tbody>\n";
	
	foreach($areas as $a)
	
	{
		
		echo "<tr>\n";
		
			echo "<td><strong>".ucwords(str_replace('_', ' ', $a))."</strong></td>\n";
			
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;".$permissions[$permission->$a]."</td>\n";  
			
			if($data->accounts < 2 || $data->user_type == 1)
		
				{
		
			echo "<td>\n";
			
			for($i=0;$i<3;$i++)
			
			{
				
				$n=$i+1;
			
			echo	"<label class=\"radio-inline\">".
			
  						form_radio($a,$n, ($n == $permission->$a ? $permission->$a:false)).$permissions[$n]."
  						
					</label>\n";
					
			}
			
			echo  "</td>\n";
			
			}
			
		echo "</tr>\n";
		
	}
	
	echo "</tbody>\n";
	
	echo "</table>\n";
	
	echo  "</div>\n";

?>