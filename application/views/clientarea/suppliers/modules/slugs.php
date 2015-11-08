
<?php

		$atts=array(
		
					array('name' => 'name', 'class' => $class, 'placeholder' => 'Name of link...', 'value' => (isset($slug) ? $slug->name:NULL)),
					
					array('name' => 'slug', 'class' => $class, 'placeholder' => 'Name of URL...', 'value' => (isset($slug) ? $slug->slug:NULL)));
					
					
		foreach ($atts as $key => $args)
		
		{
			
			echo form_input($args)."\n<br>\n";
			
		}
?>