<nav class="navbar navbar-default site-control-navbar" role="navigation">
	
  <?php echo $this->lang->line('menu'); ?>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    	
      <ul class="nav navbar-nav navbar-right">
      	
        <li>
        	
        	<?php echo anchor((isset($tasks) ? base_url().'clientarea/specifications/'.$tasks[0]['site_id'].'/'.$tasks[0]['unique']:''), '<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Area', array('data-function' => '1', 'class' => 'new_site trigger '.(isset($tasks) ? '':'disabled') , 'data-action' => false, 'data-glyph' => 'tag', 'data-title' => 'New Area Details')); ?>
        	
        </li>
        
        <li>
        	
        	<?php echo anchor((isset($tasks) ? base_url().'clientarea/specifications/delete/'.$tasks[0]['site_id'].'/0/'.$tasks[0]['unique']:''), '<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Area', array('class' => 'delete_area trigger '.(isset($tasks) ? '':'disabled') , 'data-action' => false, 'data-glyph' => 'tag', 'data-title' => 'Delete Area')); ?>
        	
        </li>
        
      </ul>
      
      <?php if(isset($recent)) 
	  
	  {
	  	
		echo " <ul class=\"nav navbar-nav navbar-left\">\n";
		
		echo "<li><span>Recent Specifications >></span></li>\n";
		
			foreach($recent as $link)
			
			{
				
				echo "<li>".anchor('clientarea/specifications/recent/'.$link['site_id'].'/'.$link['unique'].'/', $link['company_name'].' - '.$link['site_name'])."</li>\n";
				
			}
		
		
		echo "</ul>\n";
		
	  }
      
	  ?>
      
    </div>
    
  </div>
  
</nav>
