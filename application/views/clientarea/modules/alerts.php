<ul class="timeline">

    <!-- timeline time label -->
    <li class="time-label">
        <span class="bg-red">
            10 Feb. 2014
        </span>
    </li>
    <!-- /.timeline-label -->

    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-envelope bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

            <h3 class="timeline-header no-border"><a href="#">Support Team</a> ...</h3>


            <div class='timeline-footer'>
                <a class="btn btn-danger btn-xs">button goes here</a>
            </div>
        </div>
    </li>
    <!-- END timeline item -->

    ...

</ul>



<?php


$headings = array('Event', 'Date &amp; Time', 'Actions');

//If we are in main view then we need add to the table headings

if($extras == true)

{
	
	array_unshift($headings, "Mark");
	
	echo sprintf($this->lang->line('h2'), 'System Alerts');
	
	echo form_open('#', array('class' => 'alerts'));
	
}

else {
	
	echo "<strong>Only last 50 Alerts Shown...</strong><br><br>";
}
	
	echo "<div class=\"table-responsive\">\n<table class=\"table table-striped table-hover alerts\">\n<thead>\n<tr>\n";
	
	for($i=0;$i<count($headings);$i++)
	
	{
		
		echo "<th>".$headings[$i]."</th>\n";
		
	}	 
	
	echo "</tr></thead>\n<tbody>\n";
	
	if(isset($alerts) && is_array($alerts))
	
	{
	
	foreach($alerts as $a)
	
	{
		
		$unique = uniqid();
		
		echo "<tr id=\"".$unique."\">\n";
		
		if($extras == true)

			{
				
				$fields = array('name' => 'id[]', 'class' => 'markIt', 'value' => $a['id']);
				
				
				
				echo "<td>".form_checkbox($fields)."\n".
				
							form_hidden('logs_id[]', $a['logs_id'])."\n";
				
			}
			

		
		echo "<td>".$a['event']."</td>\n";
		
		echo "<td>".$a['time']."</td>\n";
		
		echo "<td>
		
					".anchor('clientarea/remove_alert/'.$a['id'].'/'.$a['logs_id'], 
					
							 '<span class="label label-default google-maps"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</span>',
							 
							 array('class' => 'remove', 'data-target' => $unique, 'data-counter' => 'alertCounter'))."				
			
			</td>\n";
		
		
		echo "</tr>";
		
	}
	
	}
	
	else {
		
		echo "<tr><td>No More Alerts!</td><td></td><td></td><tr>";
		
	}
	
	echo "</tbody>\n</table>\n</div>\n";
	
	echo "<br><br>\n";
	
	if(isset($alerts) && is_array($alerts) && $extras == false)
	
	{
	
	  echo anchor('clientarea/alerts', 'View All Alerts', array('class' => 'btn btn-default'));
	  
	}
	
	else 
	
	{
		
		
		echo anchor('#', 
		
					'<span class="glyphicon glyphicon-plus"></span>&nbsp;Mark All',
					
					array('class' =>'btn btn-default markAll', 'data-mark' => true)
					
					);
					
		echo "&nbsp;&nbsp;&nbsp";
					
		echo anchor('#', 
		
					'<span class="glyphicon glyphicon-minus"></span>&nbsp;Unmark',
					
					array('class' =>'btn btn-default markAll', 'data-mark' => false)
					
					);
					
		echo "&nbsp;&nbsp;&nbsp";
					
		$submit = array('class' => 'alertSubmit btn btn-default', 'value' => 'Remove Selected');
					
		echo form_submit($submit);
		
		echo form_close();
		
	}
		 
?>
