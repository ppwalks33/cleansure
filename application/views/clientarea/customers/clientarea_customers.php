  <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Customer overview</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                 <?php 

	$folder = "clientarea/customers/modules/";

	// echo $this->lang->line('customer_header'); 
	
	?>
                 
                 <?php 
 	
 	if($data->$prefix < 2 || $data->user_type == 1)
		
		{
 	
 		echo $this->load->view($folder.'menu'); 
			
		}
 			
 	?>


  <?php	/* echo $this->cleansure->lang_header(array('val' => 1, 'glyph' => 'eye-close', 'title' => "Hide / Show"),  'i_header', 1); */ ?>
    
  
      <?php $this->load->view($folder.'table_body', array('pageData' => $pageData)); ?>
    
                 
                </div><!-- /.box-body -->
                
              </div><!-- /. box -->







<br>

<div id="message">

		<?php if ($this->session->flashdata('info')) 

			{
 		
				$this->load->view('clientarea/modules/flashmessageinfo');
 			
			}

		?>

</div>

 	