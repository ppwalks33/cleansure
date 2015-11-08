<?php if(is_array($machines) && count($machines) > 0)

{
	
	$views = array('tracking', 'staff_available');
	
		for($i=0;$i<2;$i++)
	
			{
		
				$this->load->view('clientarea/machinery/modules/'.$views[$i]);
			}

		}

			else 
			
			{
	
			echo 'Please Add Machinery '.anchor('clientarea/machinery/add', 'here', array('title' => 'Add Machinery to the system'));

			}

?>