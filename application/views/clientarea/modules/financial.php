
<?php

	//print_r($financials); 
	
	//echo $financials[1];

	$count =  count($financials); 
	
	for($i=0;$i<$count;$i++)
	
	{
		echo form_hidden($financials[$i], false);
		
		echo form_input( ${''.$financials[$i].''})."<br>\n";
		
		echo ($i == 0 ? '<br><hr><br>':NULL);
		
	}
	
?>