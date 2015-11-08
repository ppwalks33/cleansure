<div class="file-details">
	
	<p>Files:&nbsp;&nbsp;<span class="lead">52</span></p>
	
	<ul class="fileTree">
		
		<li class="folder"><p>My Documents</p></li>
		
		<li class="border">
			
			<ul class="fileTree">
				
				<?php 
				
					if(!empty($customer_data[0]->folder_name))
					
					{
						
						$rows = array('folder_name', 'path', 'locked', 'files', 'parent_id', 'file_id', 'folder_id');
						
						foreach($rows as $r)
						
						{
							
							${$r} = explode(',',$customer_data[0]->$r);
							
						}
						
						$c=0;
						
						for($i=0;$i<count($folder_name);$i++)
						
						{
			                $c++;
							
							echo "<li class=\"folder innerTree\" id=\"".trim($folder_id[$i])."\">\n";
							
							echo "<span class=\"inner-marker\">---</span>\n";
							
							echo "<span class=\"inner\">".$folder_name[$i]."</span>\n";
							
							echo anchor("#", "<span class=\"glyphicon glyphicon-chevron-down\"></span>", 
							
							array('id' => 't'.trim($folder_id[$i]), 'class' => 'toggle_files', 'data-folder' => trim($folder_id[$i]), 'data-target' => trim($c), 'data-status' => 'closed', 'data-locked' => (int)($locked[$i] > 0 ? true:false)));
							
							echo ($locked[$i] > 0 ? '<span class="locked glyphicon glyphicon-lock"></span>':NULL);
							
							echo anchor("/clientarea/folders/delete/1/".trim($folder_id[$i]),"<span class=\"glyphicon glyphicon-trash\"></span>\n", 
							
											array('class' => 'trash', 'title' => 'Delete '.$folder_name[$i],'data-locked' => (int)($locked[$i] > 0 ? true:false), 'data-target' => trim($folder_id[$i]),'data-type' => 'folder', 'data-path' => $path[$i]));
							
							echo "<ul id=\"".$c."\" class=\"dir_dropdown closed\">\n";
							
									for($n=0;$n<count($files);$n++)
									
									{
										
									if($parent_id[$n] == $folder_id[$i])
									
										{
				
											
											$ext = pathinfo($files[$n], PATHINFO_EXTENSION);
							
									  		echo "<li><span class=\"file-icon\" style=\"background-image:url(/images/file_icons/".$ext.".png)\"></span>&nbsp;&nbsp;\n";
									  
									  		echo anchor(substr($files[$n],1), basename($files[$n]));
											
											//echo "<span class=\"glyphicon glyphicon-trash\"></span>\n";
									  
									  		echo "</li>\n";
											
										}
									  
									}
							
							echo "</ul>\n";
							
							echo "<br style=\"clear:both\">\n";
							
							echo "</li>\n";
						}

						for($n=0;$n<count($files);$n++)
									
									{
									//echo $parent_id[$n];
									
									
									
									if(trim($parent_id[$n]) == false)
									
										{
				
											$ext = pathinfo($files[$n], PATHINFO_EXTENSION);
											
											if( $ext != '')
											
											{
							
									  		echo "<li class=\"level2\">
									  		
									  					<span class=\"inner-marker\">---</span>\n
									  		
									  					<span class=\"file-icon\" style=\"background-image:url(/images/file_icons/".$ext.".png)\">
									  					
									  				    </span>&nbsp;&nbsp;\n";
									  
									  		echo anchor(substr($files[$n],1), basename($files[$n]),array('class' => 'level1'));
									  
									  		echo "</li>\n";
											
											}
											
										}
									  
									}
						
						
					}
				
				?>        
			
			</ul>
			
		</li>
		
	</ul>
         
</div>
        
  <div class="btn-group pull-right">
        	
     <?php 	if($data->$prefix < 2 || $data->user_type == 1)
		
		  {

            
            echo anchor('clientarea/folders/upload_files/'.$customer_data[0]->company_id, 
            
            			'<span class="glyphicon glyphicon-paperclip"></span>&nbsp;&nbsp;Upload File',
						
						 array('class' => 'trigger btn btn-default', 'title' => 'Upload File', 'data-title' => 'Upload File', 'data-action' => false, 'data-function' => '3'));
            

            
            echo anchor('clientarea/folders/create_folder/'.$customer_data[0]->company_id, 
            
            			'<span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Create Folder',
						
						array('class' => 'trigger btn btn-default', 'title' => 'Create Customer Folder', 'data-title' => 'Create Folder', 'data-action' => false));
            
             } 
             
             ?>
              
        </div>