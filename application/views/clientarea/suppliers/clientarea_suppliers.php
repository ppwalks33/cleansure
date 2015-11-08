<div class="box">
	<div class="box-header with-border">
		 <h3 class="box-title">Suppliers</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	<?php
    		$modules = 'clientarea/suppliers/modules/'; 
			
    		$this->load->view($modules.'menu');
			
			
			/* Adding table */
			if(is_array($suppliers))
  
  {
  
  echo "<div class=\"table-responsive customers\">\n";
  
  echo "<table class=\"table table-striped table-hover\">\n";
  
  echo "<thead>\n";
  
  echo "<tr>\n";
  
  $headers = array('Supplier Name', 'Contact Name', 'Supplier Since', 'Supplier Contact Details', 'Supplier Address', 'Products / Services', 'Web Links','Actions');
  
  for($i=0;$i<8;$i++)
  
  {
  	
	echo "<th>".$headers[$i]."&nbsp;&nbsp;".anchor('#', '&nbsp;', array('title' => 'Sort '.$headers[$i]))."</th>\n";
	
  }
  
  echo "</tr>\n";
 
  echo "</thead>\n";
  
  echo "<tbody>\n";
  
  echo "<tr>\n";
  
 foreach ($suppliers as $s)
 
 {
  
  echo "<td>".$s['company_name']."&nbsp;<br><small>".$s['company_type']."</small></td>\n";
  
  //echo "<td><span class=\"glyphicon glyphicon-user\"></span>&nbsp;&nbsp;".anchor('mailto:'.$s['email_address'], $s['first_name'].'&nbsp;'.$s['last_name'], array('onClick' => 'return false;'))."</td>\n";
  echo "<td><span class=\"glyphicon glyphicon-user hideIcon\"></span> ".$s['first_name']." ".$s['last_name']."</td>\n";
  
  echo "<td><span class=\"glyphicon glyphicon-time hideIcon\"></span>&nbsp;&nbsp;".format_date($s['date'])."</td>\n";
  
 echo "<td>\n";
				
					foreach($contactfields as $cf)
				
				{
                		 
					// echo ($s[$cf] != false ? ucwords(strstr($cf, '_', true)).":  ".$s[$cf]."<br>":NULL);
					//echo "".ucwords(strstr($cf, '_', true));
                	//echo "".$s[$cf]."<br />";  
					
					if((ucwords(strstr($cf, '_', true))) == 'Email') {
						
						echo ''.ucwords(strstr($cf, '_', true)).': ';
						echo anchor('mailto:'.$s[$cf], '<strong>'.$s[$cf].'</strong>');
						// echo 'xxx';
					} 
					else
					{
						echo ($s[$cf] != false ? ucwords(strstr($cf, '_', true)).":  <strong>".$s[$cf]."</strong><br />":NULL);
					}
				}
				
  echo "</td>\n";
  
 echo "<td>\n";
				
				foreach($addressfields as $af)
				
				{
                
                		 
					 echo ($s[$af] != false ? $s[$af]."<br>":NULL);
                		  	  
				
				}
				
				echo "</td>\n";
				
  
 //  echo " <td><a href=\"#\" data-toggle=\"modal\" data-target=\"#sitesModal\"><span class=\"label label-default\">3</span></a>&nbsp;&nbsp;<a href=\"#\" data-toggle=\"modal\" data-target=\"#sitesModal\">View Sites???</a></td>\n";
  
  echo " <td>
  
  				".($s['productCount'] > 0 ? "<span class=\"label label-success blockBtn\">".$s['productCount']."</span>":'<span class="label label-danger blockBtn">0</span>')."
  				
  				
  				
  				
  				
  				".($s['productCount'] > 0 ? anchor('clientarea/suppliers/view_products/'.$s['c_id'], '<span class="fa fa-eye rightPadIcon"></span> View Products', array('class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-title' => 'View Products', 'data-action' => true, 'title' => 'View Products')):NULL)."
  				
  				
  		</td>\n";
  
  echo "<td>\n";
  
  				if($s['slugCount'] > 0)
				
				{
					
					echo "<span class=\"label label-success blockBtn\">".$s['slugCount']."</span>\n";
					
					echo anchor('clientarea/suppliers/view_links/'.$s['c_id'], '<span class="fa fa-eye rightPadIcon"></span> View Links', array('class' => 'trigger btn btn-primary btn-xs blockBtn', 'data-title' => 'View Links', 'data-action' => true, 'title' => 'View Links'))."\n";
					
				}
				
				else 
				
				{
					
					echo "<span class=\"label label-danger blockBtn\">0</span>\n";
					
				}
  
  echo "</td>\n";
  
  echo "<td>".anchor('/clientarea/suppliers/profile/'.$s['comp_id'], '<span class=\"glyphicon glyphicon-user\"></span> Edit Company Profile', array('title' => 'Go To '.$s['company_name']. 'Profile', 'class' => 'btn btn-success btn-xs blockBtn actionBtn'))."</td>\n";
  
  echo "</tr>\n";
  
  }
  
  echo "</tbody>\n</table>\n</div>\n";
  
  }

 else
 	
	{
		
		 echo anchor(current_url().'/insert', 'Please add a New Supplier to get started', array('class' => 'trigger btn btn-success btn-sm bottomPadBtn' , 'data-action' => false, 'data-glyph' => 'tag', 'data-title' => 'New Supplier')); 
	}
			
			
    	?>
    </div>
</div>    
    
