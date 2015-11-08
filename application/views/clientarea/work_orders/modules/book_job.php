<?php

	 echo "<div class=\"panel-body\">\n";
	 
	 		
				echo "<div class=\"row\">\n";
				
					echo "<div class=\"col-xs-12 col-lg-6\">\n"; 
					
					echo "<div id=\"specMessage\"></div>\n";
					
					echo "<div class=\"panel panel-default\">\n";
					
					echo $this->cleansure->lang_header('This job is ...'.'', 'company_information');  
					
					echo form_hidden('comp_id', '');
					
					echo form_hidden('site_id', '');
					
					$radios = array('One Shot', 'Reccuring Contract');
					
					for($i=0;$i<2;$i++)
					
					{
						
						
						
						echo "<div class=\"radio padLeft\">\n";
						
						echo "<label>\n";
						
						echo form_radio('type', $i+1, ( $i+1 < 2 ? TRUE:NULL)).$radios[$i]."<br>\n";
						
						echo "</label>\n";
						
						echo "</div>\n";
						
					}
					
				
					
					
					echo "<div class=\"col-xs-12 col-lg-10\">\n"; 
					
					
					$this->load->view($modules.'desc');
					
					
					
					echo sprintf($this->lang->line('h4'), 'Date Commence');
					
					     $this->load->view('modules/datepicker');
						 
						 echo "<br>\n";
						 
					echo sprintf($this->lang->line('h4'), 'Date Until');
					
					     $this->load->view('modules/datepicker');
						 
						 echo "<br>\n";
						 
					
					echo sprintf($this->lang->line('h4'), 'What Days?');
						 
					
					$this->load->view($modules.'days');
					
	 
					echo "</div>\n";

?>