<?php

	//	echo sprintf($this->lang->line('brief_heading'), $data->company_name.' Last 30 '.(!$this->uri->segment(3) ? 'Work':'Purchase').' Orders');
		
	//	echo "<div id=\"message\"></div>\n";
	
	if($this->session->flashdata('info')) {
		
		/*
				
				echo "<div class=\"alert alert-info\" role=\"alert\">
						
						<span class=\"glyphicon glyphicon-question-sign\"></span>".$this->session->flashdata('info')."
   				
   								
					</div>";
		 
		 */	
			}
	
	
	
			
	
			echo "<div class=\"nav-tabs-custom\">";
			
			echo  "<ul class=\"nav nav-tabs\" role=\"tablist\">";
			
            echo  "<li class=\"".($this->uri->segment(3) && $this->uri->segment(3) != 'search_work_orders' ?NULL:'active')."\">";
			
				echo anchor('/clientarea/work_orders/', 'Work Orders', array('role' => 'presentation', 'role' => 'tab', 'class' => (!$this->uri->segment(3) ? 'active':NULL) ) );
            
            echo "</li>";
			
			 echo  "<li  class=\"".($this->uri->segment(3) && $this->uri->segment(3) != 'search_work_orders' ? 'active':NULL)."\">";
			
				echo anchor('/clientarea/work_orders/purchase_orders', 'Purchase Orders', array('role' => 'presentation', 'role' => 'tab', 'class' => ($this->uri->segment(3) ? 'active':NULL) ) );
            
            echo "</li>";
   
            echo "</ul>";
			
			echo "<div class=\"tab-content\">"; 
			
			if($this->uri->segment(3) && $this->uri->segment(3) != 'search_work_orders')
			
			{
				
				//Orders Table
	            $this->load->view($modules.'purchase_orders_panel');
			}
			
			else 
			
			{
				
				//Orders Table
	            $this->load->view($modules.'work_orders_panel');
			}
	
			
			
			echo "</div>";
	 
			echo "</div>";	
	
?>