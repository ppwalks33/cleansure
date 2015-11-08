
 <?php 
 
    echo sprintf($this->lang->line('h4'), 'Type of Area');
 			 
 	echo form_dropdown('spec_type', $spec_type, '' , "class='".$class." type'")."\n"; 
       
    echo "<br>\n";
	
	echo sprintf($this->lang->line('h4'), 'Area Name');
 		
 	echo form_input(array('name' => 'area', 'class' => $class, 'Placeholder' => 'Please Enter an Area Name')); 
	
	echo "<br>\n";
	
	echo sprintf($this->lang->line('h4'), 'Survey Collection Type?');
 			 
 	echo form_dropdown('sci', $sci, '' , "class='".$class." sci'")."\n"; 
       
    echo "<br>\n";
	 
	echo "<br>\n";
	
	$rows = array(
	
					array('SCI Details', 'Specification Details '),
					
					array('sci_table', 'tasks_table')
	
	             );
				 
		for($i=0;$i<2;$i++)
		
		{
			
			$n=$i+1;
			
			echo "<div id=\"accordion".$n."\" class=\"panel-group disabled\">\n";
			
			echo "<div class=\"panel panel-default mySCI\">\n";
			
			echo $this->cleansure->lang_header($rows[0][$i], 'interactive_header', $n);
			
			echo "<div id=\"collapse".$n ."\" class=\"panel-collapse collapse\" style=\"height: 0px;\">\n";
			
			echo "<div class=\"panel-body\">\n";
			
			$this->load->view($modules.$rows[1][$i]);
			
			echo "</div>\n";
			
			echo "</div>\n";
			
			echo "</div>\n";
			
			echo "</div>\n";
			
			echo ($i==0 ? "<br>\n".sprintf($this->lang->line('h4'), 'Specification Details...'):NULL);
		}
 			
 	?>