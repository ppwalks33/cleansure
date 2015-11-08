<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//set_error_handler("exception_error_handler");

/*
 * Upload & folder organisation Class for Cleansure
 * 
 * Author: Paul Stevenson
 * 
 * Copyright: GoFishwebdesign
 * 
 * Version 1.0
 * 
 */
 
class Uploader

{
	//Private prefix;
	
	Private $ext = '_dir';
	
	//Uploads Path
	
	Private $path = './uploads/';
	
	
	Public function __construct()
	
	{
		/*
		 * Load the directory helper
		 * 
		 */
		  
		$this->load->helper('directory');
		
		$this->load->library('auth');
		
	}
	
	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 *
	 */
	 
	Public function __get($var)
	
	{
		
		return get_instance()->$var;
		
	}
	
	/*
	 * Raw Upload function
	 */ 
	
	Public function upload_it($path, $files, $company_id)
	
	{
		
		$newPath = explode('^', $path);
		
		return array(
		                'root' => $company_id,
				     
						'parent_id'  => $newPath[0],
						
						'file'       => $this->upload_files($files, $this->path.$newPath[1], false)
						
					);
	}
	
	//Check whether a file exists before we insert a record
	
	Public function has_file($path)
	
	{
		
		//Remove any attachements to the string and form the correct path
		
		$myPath = $this->path.str_replace('^','',strstr($path, '^')); 
		
		//Does the file exist?
		
		if (file_exists($myPath)) {
			
    			 return true;

			    } 
    			
    			return false;
		
		
	}
	
	/*
	 * Function to check if folder exists 
	 * 
	 * folder structure created
	 * 
	 */
	 
	Public function folder_exists($folder)
	
	{
		if(!is_dir($this->path.$folder))
		
		{
			
			return false;
			
		 } 
		
		 return true;
		
	 }
	
	/*
	 * Sort Foders for QA section to make sure we only look through the correct folders
	 * 
	 */ 
	
	Public function sort_folders($folders)
	
	{
		
		if(isset($folders) && count($folders) > 0)
		
		{
			
			$mydirs = array();
			
			
			foreach($folders as $key => $file)
			
			{
				
				
				
				if(strlen($key) > 4 && count($file) > 1)
				
				{
					
					
					$mydirs[$key] = $file;
					
				}	
				
			}
			
			return $mydirs;
			
		}
	}
	
	/*
	 * Function to create directories
	 * 
	 */ 
	
	Public function create_dir($folder, $subFiles=false)
	
	{
		
		if($subFiles == true)
		
		{
			
			$this->new_folder($folder);
			
			$dirs = array('files', 'images', 'qa');
			
			foreach($dirs as $d)
			
			{
				
				$this->new_folder($folder.'/'.$d);
				
			}
			
			return true;
			
		}
		
		return $this->new_folder($folder);
		
	}
	
	/**
	 * 
	 *@param array 
	 *
	 * Automatically create the path from an array
	 * 
	 * of paremeters
	 * 
	 */
	  
	Public function create_path($array)
	
	{
			if(is_array($array))
			
			{
		
			  $path = '';
		
			   foreach($array as $a)
			
			     {
			   
					  
				  $path .= remove_punctuation($a).'/';
				
			    }
			
			   return substr($path, 0, -1);
			   
			}
			
			return false;
		
	}

	/*
	 * Function for the QA section, create a folder with site_is 
	 * 
	 * and todays date with strtotime so we can retrieve via date order
	 * 
	 */ 
	
	Public function dated_dir($files, $path, $id=NULL)
	
	{
		//Folder name with todays date
		
		$folder_name = ($id != NULL ? $id.'_'.strtotime(date("d-m-Y")):strtotime(date("d-m-Y")));
		
		//Do we have one?, if not create one...
		
		$this->new_folder($path.$folder_name);
		
	    return $this->upload_files($files, $this->path.$path.$folder_name.'/');
		
	}
	
	/**
	 * @param $path = string
	 * 
	 * Public function to delete folders and files.
	 * 
	 */
	
	Public function delete_folder($path)
	
	{
		
		return $this->remove_folder($path);
	}
	
	/**
	 * @param files = array
	 * 
	 * @param path = string
	 * 
	 * Central upload function, can be single or multiple
	 * 
	 * We call the cl upload class to actually upload the files
	 * 
	 */ 
	
	
	Private function upload_files($files, $path, $allowed=true)
	
	{
		//Set the configuration for the class configs
		
		$config['upload_path'] = $path;
		
		if($allowed == true)
		
		{
		
		   $config['allowed_types'] = 'gif|jpg|jpeg|png';
		   
		   $config['max_size']	= '1024';
		   
		}
		
		else 
		
		{
			
			$config['allowed_types'] = '*';
			
			$config['max_size']	= '5000';
			
		}
		
		
		$config['overwrite'] =  true;
		
        $this->load->library('upload', $config);
		
		//Create an array to return from the function
				
		$myUploads = array();
		
		//Loop the files array being sent

		foreach ($files as $fieldname => $fileObject)  
		
			{
				
				
				//Check we have a valid file
   
   				 if (!empty($fileObject['name']))
    
    				{
    					
						//If we havn't been able to upload because params have not been met 
     
	   						 if (!$this->upload->do_upload($fieldname))
        
        						{
									
									//Return the error
									
									echo $this->upload->display_errors();
            
        
								}
        
        							else
       
	   							 {
	   							 	
									//All passed, lets upload...
									
									//we need the array position from the key, so explode at underscore
	   							 	
									$key = explode('_', $fieldname);
									
									//Put that key into the array to run comparison against area array
									
									
									
									if(count($key) < 2)
									
									{
										
										return $path.$fileObject['name'];
             						
             						   
									   
									}
									
									else 
									
									{
										
										$myUploads[(int)$key[1]] = $path.$fileObject['name'];
										
									}
									

       					
       							 }
    
							}
			
				}
			
			//Return the array of files
			
			return $myUploads;
		
	}
	
	
/**
 * @param $path = string
 * 
 * @param $folder_name = string
 * 
 * Create a folder quickly and easily...
 * 
 */
	
Private function new_folder($folder)

{
	
	if (!is_dir($this->path.$folder)) 
		
		{
			
			//Make the folder
			
			try {
			
			    mkdir($this->path.$folder, 0755, TRUE);
				
				copy($this->path.'index.html', $this->path.$folder.'/index.html');
			
				} 
				
				catch(ErrorException $ex) {
					
   				echo "Error: " . $ex->getMessage();

			}
			
		}
}

/*
 * Function to remove folder and the files within..
 */ 

Private function remove_folder($path)
{
	
	$path = $this->path.trim($path);
	
	
    if (is_dir($path) === true)
    {
        $files = new RecursiveIteratorIterator(
        		
        			new RecursiveDirectoryIterator($path), 
        			
        			RecursiveIteratorIterator::CHILD_FIRST);

        				foreach ($files as $file)
        				
        				{
            			
            			
           					 if (in_array($file->getBasename(), array('.', '..')) !== true)
            
            						{
                			
               					 if ($file->isDir() === true)
                
                					{
                    	
                    					rmdir($file->getPathName());
                					}

                					else if (($file->isFile() === true) || ($file->isLink() === true))
                
                					{
                    		
                   					 unlink($file->getPathname());
               
			   						 }
            
							}
        		
						}

        					return rmdir($path);
   					 }

    				else if ((is_file($path) === true) || (is_link($path) === true))
    
    				{
        			
       				 return unlink($path);
   				
					 }

    return false;
}

/*
 * Some custom error handling for directory creation
 * 
 */
	
Private	function exception_error_handler($errno, $errstr, $errfile, $errline ) 
	
	{
    		
   		 throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

	}

}

?>