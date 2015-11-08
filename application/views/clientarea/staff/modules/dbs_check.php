
<?php

/*
 * Future Reference data stored in certifications table...
 * 
 */ 

$atts = array(
			
			array('signiture', 'dbs', 'verified', 'discrepencies'),
			
			array('Standard', 'Enhanced', 'Enhanced with List Checks')
			
			);
			
		/*
		 * We could put this into a loop to save code
		 * 
		 * job needs to be done so redo
		 * 
		 * sigiture first
		 * 
		 */
			
		echo $this->lang->line('dbs');

		echo "<label class=\"checkbox\">\n";
		
		echo form_hidden($atts[0][0], false);
		
		echo form_checkbox($atts[0][0],1 , (isset($row_data) ? $row_data->signiture:NULL))."DBS Check Required?";
		
		echo "</label>\n";
		
		echo "<br>\n";
		
		/*
		 * Type of DBS
		 * 
		 */
		 
		echo "<div class=\"dbs-check\">\n";
		 
		echo form_label('Type Of Check?');
	
	    echo form_dropdown('dbs',$atts[1], (isset($row_data) ? $row_data->dbs:NULL), "class='".$class."' ")."\n";
	
	    echo "</div>";
		
		echo "<br>\n";
		
		
		/*
		 * Been Verified?
		 * 
		 */ 
	
		echo "<label class=\"checkbox\">\n";
	
	    echo form_hidden($atts[0][2], false);
	
	    echo form_checkbox($atts[0][2],1 , (isset($row_data) ? $row_data->verified:NULL))."Been Verified!";
	
	    echo "</label>";
	
	    echo "<br>\n";
		
		/*
		 * Any Discrepenices
		 * 
		 */
		 
	
	    echo "<label class=\"checkbox\">\n";
	
	    echo form_hidden($atts[0][3], false);
	
	    echo form_checkbox($atts[0][3],1 , (isset($row_data) ? $row_data->discrepencies:NULL))."Any Discrepencies";
	
	    echo "</label>";
	
	    echo "<br>\n";
		
		echo form_label('Discrepency Description');
		
		echo form_textarea(array('name' => 'description', 'class' => $this->class, 'placeholder' => 'More Information..', 'value' => (isset($row_data) ? $row_data->description:NULL)));
		
		 echo "<br>\n";
?>