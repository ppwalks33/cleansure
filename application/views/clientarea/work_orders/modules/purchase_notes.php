<?php

 echo "<div class=\"panel-group\" id=\"accordion\">\n";
	
	 echo "<div class=\"panel panel-default\">\n";
		
	 echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'shopping-cart', 'title' => "Purchase Order Notes"),  'i_header', 1); 
		
	 echo "<div id=\"collapse1\" class=\"panel-collapse collapse in\">\n";
		
	 echo "<div class=\"panel-body\">\n";	
	 	
		echo $note;
	 
	 echo "</div>\n";
	
	 echo "</div>\n";
	
	 echo "</div>\n";
	
	 echo "</div>\n";
	 
	 ?>