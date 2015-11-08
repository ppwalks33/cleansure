<?php if(is_array($machines) && count($machines) > 0)

{
	
	if($c_id == NULL && $s_id == NULL)
	
	{
		
		$views = array('tracking', 'available_table');
		
	}
	
	else 
	
	{
		
		$views = array('tracking', 'available');
		
	}
	
	
	
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