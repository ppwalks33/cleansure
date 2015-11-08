<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

<?php

$i=0;

foreach($files as $name => $order)

{
	$i++;
	echo "<div class=\"panel panel-default\">\n";
	
		echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$i."\">\n";
		
		echo"<h4 class=\"panel-title\">\n";
		
		$id = str_replace(' ', '', $name);
		
		echo anchor('#'.$id, ucwords($name), array('data-toggle' => 'collapse', 'data-parent' => '#accordion', 'aria-expanded' => "true", 'aria-controls' => $id));
		
		echo "</h4>\n";
		
		echo "</div>\n";
		
		echo "<div id=\"".$id."\" class=\"panel-collapse collapse ".($i == 1 ? 'in':NULL)."\" role=\"tabpanel\" aria-labelledby=\"heading".$i."\"><br>";
		
		$this->table->set_heading('Ref','Name', 'Qty', 'Case Qty', 'type', 'Price');
		
			foreach($order as $o)
			
			{
				
				$this->table->add_row($o->ref, $o->name, $o->qty, $o->case_qty, ($o->type == 0 ? 'Consumable':'Product'), '&pound;'.$o->price);
			}
		
		echo $this->table->generate();
		
		echo "</div>\n";
		
		echo "</div>\n";
	
}

?>

</div>
