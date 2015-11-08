<?php



if($this->session->flashdata('info')) {
				
				echo "<div class=\"alert alert-info\" role=\"alert\">
						
						<span class=\"glyphicon glyphicon-question-sign\"></span>".$this->session->flashdata('info')."
   				
   								
					</div>";	
			}


	?>


<div class="box">
	<div class="box-header with-border">
    	<?php /* echo vsprintf($this->lang->line('h2_heading'), array('signal', (isset($delete) ? 'Deleted Orders':'Stores'))); */ ?>
        <h3 class="box-title">
		
		
		
		<?php  if(array('signal', (isset($delete) == 'Deleted Orders')))
				{ 
					echo '<span class="glyphicon glyphicon-search"></span> Search Stores Orders';	
				}
				else 
				{
				 echo '<span class="fa fa-trash"></span> Deleted Orders'; 
				}
				
				?>
        
        </h3>
        
        
    </div><!-- /.box-header -->
 	<div class="box-body">
            <?php
			if(!isset($delete))
	
	{

		$this->load->view('clientarea/stores/modules/search');

	}
	
else 
	
	{
		
		$this->load->view('clientarea/stores/modules/go_back');
		
	}
			?>
	</div>
    <?php if(!isset($delete)): ?>
	<div class="box-footer">
    	<div class="pull-right">
    <?php
	 echo anchor('/clientarea/stores/stock', '<span class="glyphicon glyphicon-plus"></span> Create New Order', array('class' => 'btn btn-success btn-sm rightPadBtn'))."\n";	
     
	 echo anchor('/clientarea/stores/view_saved_orders/', 
	 	
	 			'<span class="glyphicon glyphicon-floppy-disk"></span> View Saved Orders', 
	 			
	 			 array('class' => 'trigger btn btn-success btn-sm rightPadBtn', 'data-title' => 'Saved Orders', 'data-dismiss' => true, 'data-action' => false) 
				
				)."\n";
	 ?>
    </div>   
    </div>
	<?php endif; ?>
	
    
    
</div>


	
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Store Overview</h3>
    </div><!-- /.box-header -->
 	<div class="box-body">
	<?php /* echo $this->cleansure->lang_header('Hide / Show ','interactive_header', 1); */?>
	<?php  $this->load->view('clientarea/stores/modules/table_body'); ?>
	</div>
    
    
    
</div>
<?php 
/*
echo "<div class=\"panel-group\" id=\"accordion\">\n";
  
echo "<div class=\"panel panel-default\">\n";
  
echo $this->cleansure->lang_header('Hide / Show ','interactive_header', 1);
  
echo "<div id=\"collapse1\" class=\"panel-collapse collapse in\">\n";
  
echo "<div class=\"panel-body\">\n";

 $this->load->view('clientarea/stores/modules/table_body');
 
 echo "\n</div>\n</div>\n</div>\n</div>\n";
  
 */

?>