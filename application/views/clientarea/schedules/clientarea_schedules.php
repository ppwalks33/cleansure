<div class="row">
	<div class="col-md-12">
		
		<!-- Grey Panel -->
		<div class="box">
			<div class="box-header with-border">
		 		<h3 class="box-title">Schedules</h3>
    		</div><!-- /.box-header -->
    		<div class="box-body">
				<?php $this->load->view($modules.'menu'); ?>
    		</div>
		</div>    			
	    <!-- /.Grey Panel -->
	
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		
		<!-- Blue Panel -->
		<div class="box box-primary">
			<div class="box-header with-border">
		 		<h3 class="box-title">Workload Calendar</h3>
    		</div><!-- /.box-header -->
    		<div class="box-body">
    			<?php 
    				
					echo $this->calendar->generate($this->uri->segment(4), $this->uri->segment(5), (isset($events) ? $events:NULL)); 
				?>
    		</div>
		</div>    			
	    <!-- /.Blue Panel -->
	
	</div>
	<div class="col-md-4">
		
		<?php 
		
			$this->load->view($modules.'today-schedules.php');
		
			// $this->load->view('clientarea/modules/dashboard-schedules.php') 
		
		?>
	</div>
	<div class="col-md-4">
		<?php 
		
			$this->load->view($modules.'tomorrow-schedules.php');
		?>
	</div>
	
</div>



<!-- Grey container Panel -->




<?php

  // echo sprintf($this->lang->line('brief_heading'), 'Our Schedule')."\n<br>\n"; 
  
  // $this->load->view($modules.'menu');

  // echo "<div class=\"row\">\n<div class=\"col-xs-12\">\n"; 

 //  echo $this->calendar->generate($this->uri->segment(4), $this->uri->segment(5), (isset($events) ? $events:NULL));
  
 //  echo "</div>\n</div>\n";
  
  ?>
  
 
