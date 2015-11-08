<div class="box">
	<div class="box-header with-border">
		 <h3 class="box-title">Machinery</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	<?php
    	
    		$modules = 'clientarea/machinery/modules/';
			
    		$this->load->view($modules.'menu');

    	?>
    	
    	<div class="table-responsive customers">
        	
            <table class="table table-striped table-hover">
            	
              <thead> 
              	
              	<?php $this->load->view($modules.'table_head'); ?>
                
              </thead>
              
              <tbody>
              	
              
              	<?php $this->load->view($modules.'table'); ?>
       
               
              </tbody>
              
            </table>

          </div>
          
          
          
    </div>
</div>

