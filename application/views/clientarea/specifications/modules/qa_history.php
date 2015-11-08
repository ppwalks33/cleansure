<?php

if(is_array($qas))

{
	
	
	$this->table->set_heading('Date', 'Areas', 'Score', 'Rating', 'Author');
	
	foreach($qas as $q)
	
	{
		
		$overall = ($q['overall'] * 4);
		
		$percentage = number_format($q['score'] / ($overall / 100),2);
		
	
		$this->table->add_row($q['date'], 
		
							 '<span class="badge">&nbsp;'.trim($q['overall']).'&nbsp;</span>',
							 
							$q['score'].'&nbsp;/&nbsp;'.$overall, 
							
							$percentage.'%', 
							
							'&nbsp;'
							
					
		
		                                 );
										 
										 
	}

    	echo $this->table->generate(); 
		
	
}

?>