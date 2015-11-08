<div id="alert"></div>
<?php

   echo form_upload(array('name' => 'file', 'class' => 'file'))."<br>\n";
   
   echo sprintf($this->lang->line('h4'), 'Please Select a Folder');
   
   echo "<div class=\"radio\">\n<label>";
   
   echo form_radio('path', '0^'.$main_path, true)."<span class=\"glyphicon glyphicon-folder-open\"></span>&nbsp;&nbsp;&nbsp;My Documents";
   
   echo "</label>\n</div>\n";
   
   if(is_array($folders))
   
   {
   
     foreach($folders as $f)
	 
	 {
	 	
		echo "<div class=\"radio\">\n<label>";
		
		echo form_radio('path',$f['id'].'^'.$f['path'].'/')."--- <span class=\"glyphicon glyphicon-folder-open\"></span>&nbsp;&nbsp;&nbsp;".$f['folder_name'];
		
		echo "</label>\n</div>\n";
		
	 }
	 
   }

?>
