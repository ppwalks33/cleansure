  
  <?php 
  
  	$arr = array(
  
  						array('name' => 'job_title', 'class' => $class, 'placeHolder' => 'Job Title', 'value' => (isset($row_data) ? $row_data->job_title:NULL)),
  						
						array('name' => 'job_position', 'class' => $class, 'placeHolder' => 'Job Position', 'value' => (isset($row_data) ? $row_data->job_position:NULL)),
						
						array('Part Time', 'Full Time'),
						
						array('name' => 'ni_number', 'class' => $class, 'placeHolder' => 'National Insurance Number', 'value' => (isset($row_data) ? $row_data->ni_number:NULL)),
						
						array('No', 'Yes'),
						
						
  
                   );
				   
 
				   
   for($i=0;$i<3;$i++)
   
   {
	   
	echo "<div class=\"form-group\">";
   	
	echo ($i<2 ? 
		 
		  form_label($arr[$i]['placeHolder']).
		  form_input($arr[$i])
		  
		  :
		  form_label('Part/Full Time').
		  form_dropdown('employment_basis',$arr[$i], (isset($row_data) ? $row_data->employment_basis:false), "class='".$class."'"))."";
	
	echo "</div>";
	
	
   }
   
   echo "<div class=\"form-group\">";
   
   echo form_label($arr[3]['placeHolder']);
   
   echo form_input($arr[3])."\n";
   
   echo "</div>\n";
   
   echo '<div class="marginBottom">';
   
   echo form_textarea(array('placeholder' => 'More Information...', 'class' => $class, 'rows' => 3, 'name' => 'description', 'value' => (isset($row_data) ? $row_data->description:NULL) ));
   
   echo '</div>';
   
   $checks = array('first_job', 'only_job','bank_hol_ent', 'hol_ent', 'p45');
   
   $n=0;
   
   foreach ($checks as $c)
   
   {
   	
	echo form_hidden($c, 0);
	
	echo '<div class="form-group">';
   	
	echo "<label class=\"checkbox\">\n";
	
	echo form_checkbox($c, 1 , (isset($row_data) ? $row_data->$c:($n>1&&$n<4?true:false))).$this->lang->line($c)."\n";
	
	echo "</label>\n";
	
	echo '</div>';
	
	$n++;
	
   }
   
     echo "<h4>Work Wear</h4>";
	 
	 echo form_dropdown('workwear',$arr[4], (isset($row_data) ? $row_data->workwear:NULL), "class='".$class."'")."\n";
	 
	 
	 echo form_textarea(array('placeholder' => 'What? How Many? When?', 'class' => $class, 'rows' => 3, 'name' => 'workwear_info', 'value' => (isset($row_data) ? $row_data->workwear_info:NULL)))."\n";
	 
  ?>
  
       