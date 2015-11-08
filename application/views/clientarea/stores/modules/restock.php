<?php

if(isset($row_data))

{
	
	$this->load->view('clientarea/stores/modules/hidden_keys');
}

	echo "<div class=\"row\">";
	
	echo "<div class=\"col-xs-12 col-md-12 restockDate\">";
	
	echo sprintf($this->lang->line('h4'), 'Starting From');
	
	$this->load->view('clientarea/stores/modules/datepicker');
	
	echo "</div>";
	
	echo "</div>";
	
	echo "<div class=\"row\">";
	
	echo "<div class=\"col-xs-12 col-md-12\">";
	
	echo "<hr>";
	
	echo sprintf($this->lang->line('h4'), 'Frequency');
	
	echo "<p>Please select which days you would like to restock this order.</p>";
	
	$this->load->view('clientarea/work_orders/modules/days');
	
	echo "<hr>";
	
	echo "<p>Please select a which weeks in the month would like to restock</p>";
	
	$this->load->view('clientarea/stores/modules/monthly');
	
	echo "<hr>";
	
	echo "<p>Please select which month you would like to restock this order.</p>";
	
	$this->load->view('clientarea/stores/modules/months');
	
	echo "</div>";
	
	echo "</div>";
	
	
?>