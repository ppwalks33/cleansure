<!-- Grey container Panel -->
<div class="box">
	<div class="box-header with-border">
		 <h3 class="box-title">Contacts</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	
		
   </div>
   
</div>

<!-- Custom Tabs -->
<div class="nav-tabs-custom">
	<!-- Tab Menu -->
	<?php
	/* test */
		echo '<ul class="nav nav-tabs">';
		
		$i = 0;
		
		foreach ($accordians as $ref => $glyph) {
			
			echo "<li ".($i==0?'class="active"':null).">".anchor('#tab_'.$i,ucwords($ref),array('title' => $ref, 'data-toggle' => 'tab'))."</li>";
		
		  $i++;
		}
		echo '</ul>';
		?>
	<!-- /.Tab Menu -->
    <!-- Tabs -->
    <div class="tab-content">
   	
   	<?php 
   	
   		$paths = array('contact_book/personal', 'customers/add', 'suppliers/add', 'staff/add'); 
	
		$i = 0;
		
		foreach ($accordians as $ref => $glyph) {
			
			echo "<div class=\"tab-pane".($i==0?' active"':'"')." id=\"tab_".$i."\">";
			
			 if(isset($contacts[$this->config->item($ref)]))
		
		        {
		
                 $this->load->view($modules.'menu', array('link' => $ref, 'path' => $paths[$i]));
				 
		         $this->load->view($modules.'table_body', array('modules' => $modules, 'ref' => $ref));
			
		         echo "</tbody>\n</table>\n</div>\n";
				 
				 //Pagination
				 
				 echo ${$ref};
		
		      }
		
		         else 
		
		      {
		      	

					
					$this->load->view($modules.'menu', array('link' => $ref, 'path' => $paths[$i]));
					
		
		      }
		
			
			echo "</div>";
		
		  $i++;
		}
		
		?>
       
	</div><!-- /.tab-content -->
</div><!-- nav-tabs-custom -->