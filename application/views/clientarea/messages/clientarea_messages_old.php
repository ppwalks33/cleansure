

<?php

echo sprintf($this->lang->line('envelope_heading'), isset($messages) && is_array($messages) ? "All Messages":"Message");

echo "<div id=\"message\"></div>\n";
	
	if($this->session->flashdata('info')) {
				
				echo "<div class=\"alert alert-info\" role=\"alert\">
						
						<span class=\"glyphicon glyphicon-question-sign\"></span>".$this->session->flashdata('info')."
   				
   								
					</div>";	
			}
	
	
	
			$this->load->view($modules.'menu');
	
	 echo "<div class=\"panel-group\" id=\"accordion\">\n";
	
	 echo "<div class=\"panel panel-default\">\n";
		
	 echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'envelope', 'title' => (isset($messages) && is_array($messages) ? "All Messages":"Message")),  'i_header', 1); 
		
	 echo "<div id=\"collapse1\" class=\"panel-collapse collapse in\">\n";
		
	 echo "<div class=\"panel-body\">\n";
	 
	 	 if(isset($messages) && is_array($messages))
	 
		 {
	 	
		$this->load->view($modules.'messages_table', array('messages' => $messages));
		
	 	}
	 
			elseif(isset($mess) && is_object($mess))
	  	
		{
			
			$this->load->view($modules.'message', array('mess' => $mess));
			
		}
		
			else
				
				{
					
					echo sprintf($this->lang->line('h2'), 'You Currently Have No Messages!');
					
				}
	 
	 
	 echo "</div>\n";
	
	 echo "</div>\n";
	
	 echo "</div>\n";
	
	 echo "</div>\n";