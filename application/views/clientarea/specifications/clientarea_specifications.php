
<?php 

	
	//echo sprintf($this->lang->line('tag_heading'), 'Create a Specification of Work'); 
	
	?>
<?php
/*
<div id="message">

		<?php  if ($this->session->flashdata('warning') ) 

			{
 		
		
 				echo "<div class=\"alert alert-warning\" role=\"alert\">
		 
		    		 <span class=\"glyphicon glyphicon-info-sign\"></span>".$this->session->flashdata('warning')."
		 			
		 			</div>";
			
						} elseif($this->session->flashdata('info')) {
				
				echo "<div class=\"alert alert-info\" role=\"alert\">
						
						<span class=\"glyphicon glyphicon-question-sign\"></span>".$this->session->flashdata('info')."
   				
   								
					</div>";	
			}

		?>

</div>
*/
?>

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Create a Specification of Work</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
           <?php $this->load->view($modules.'site_select'); ?>
    <?php 
    
    		$this->load->view($modules.'menu');
			
			echo "<div class=\"row\">\n";
			
			echo "<div class=\"col-xs-12 col-md-2 pull-right\">";
			
			echo anchor('#','Save Specification', array('class' => 'btn btn-success pull-right', 'id' => 'specSave', 'data-name' => ''))."\n";
			
			echo "</div>\n";
			
			echo "<div class=\"col-xs-12 col-md-3 pull-right\">";
			
					echo "<span id=\"spec\">Specification Name".form_input(array('id' => 'spec_name', 'class' => 'form-control', 'placeholder' => 'Specification Name'))."</span>";
			
			echo "</div>\n";
			
			echo "</div>\n";
			
		//	echo "<br>\n<br>\n";
    			
    	?>
                
    </div>
</div>         


<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Specification of Work Detailsk</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
		<div class="panel-group" id="accordion">
			<?php $this->load->view($modules.'areas');?>
    
  		</div>
 	</div>
</div>