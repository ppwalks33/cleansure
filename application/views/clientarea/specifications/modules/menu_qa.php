<nav class="navbar navbar-default site-control-navbar" role="navigation">
	
  <?php echo $this->lang->line('menu'); ?>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    	
      <ul class="nav navbar-nav navbar-right">
      	
        <li>
        	
        	<?php 

        	$path = (isset($site_id) ? 'clientarea/specifications/qa/'.$site_id.'/'.$company_id.'/1/'.$unique:'clientarea/specifications/add');
        	
        	echo anchor(base_url().$path, 
        	
        				'<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Score', 
        							
        				array( 'data-function' => '2', 'class' => 'new_site trigger '.($skip == false ? 'disabled':NULL) , 'data-action' => false, 'data-glyph' => 'tag', 'data-title' => 'New Quality Audit')); ?>
        	
        </li>
        
      </ul>
      
    </div>
    
  </div>
  
</nav>
