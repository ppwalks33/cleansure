<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Cleansure Folders controller
 * 
 * ClientArea controller is not to be edited or used by unauthorised personel and Gofish Web Desisgn
 * hold full copyright to the code and mainainance of the cleansure system.
 * 
 *  @category   Folders
 *  @package    ClientArea
 *  @author     Original Author contact@gofishwebdesign.com
 *  @copyright  2015 Gofish Web Design
 *  @version    Release: Code Version 1.1
 * 
 */

class Folders extends Clientarea_Controller {
	
	/*
	 * Private varaible fields
	 * Store the  fields that need validating
	 * 
	 */ 
	
	Private $fields = array();
	
	/*
	 * Private varaible errors
	 * Store the errors that coorespond to fields array
	 * 
	 */ 
	
	Private $errors = array();
	
	/*
	 * Private varaible password
	 * Detect if we need to use a password..
	 * 
	 */
	
	
	Private $password = false;
	
	
	//Class constructor
	Public function __construct(){
		
        parent::__construct();	
		
		$this->load->model(array('folder_model', 'auth_model'));
		
		$this->posts = $this->input->post(NULL, TRUE);
		
	}
	

	

/*
 * Function to create a folder structure
 * 
 */ 
	
Public function create_folder($company_id)

{
	
	/*
	 * Are we posting?
	 */ 
	
	if($this->posts)
	
	 {
	 	
		//Create the erorrs array
	 	
		$this->fields = array('title');
		
		$this->errors = array('required');
		
		/*
		 * Are we needing a password
		 * 
		 */ 
		
			if(!empty($this->posts['password']))
		
				{
					
					array_push($this->fields, 'password', 'password_confirm');
					
					array_push($this->errors, 'required|matches[password_confirm]|alpha_numeric', 'required|matches[password]|alpha_numeric');
					
					$this->password = true;
			
				}
				
		         //run the form validation
				
				 $this->runValidator($this->fields, $this->errors);
				 
				 
				 //Is it Valid?
				 if ($this->form_validation->run() == FALSE)
				
				  {
				  	
					
						//show the form and send the parameters of the failed fields
				  		echo json_encode($this->form_validation->error_array());	
						
						return false;
				  }
				  
				 else
				 	
			      {
			      	
			      	
						if($this->password == true)
						
						{
							
							//Get the encrypted password 
					        $pass = $this->Auth_model->hash_password($this->posts['password']);
					
					        //Add some salt to the mix
					        $salt = $this->Auth_model->salt();
							
							//Create an array then add them to the table
					        $hash_id = $this->folder_model->insert_return(array('hash' =>  $pass, 'salt' => $salt), 'md5');
							
						}
		
		
						     $data = $this->folder_model->get_row('company', 'id', $company_id);
		
							$path = array(
				
							 				$this->data['data']->company_name, 
							 
							 				$data->company_name);
							 
							$dir = $this->uploader->create_path($path).'/files/'.$this->posts['title'];	
				
		      
			  				 if($this->uploader->folder_exists($dir) == false)
		
								{
					
									$folderArray = array(
					
														'title' => $this->posts['title'],
														
														'root'  => $company_id, 
										
														'type' => true, 
										
														'file' => $dir,
														
														'md5_id' => ($this->password == true ? $hash_id:false));
				
				 					$folder_id = $this->folder_model->insert_return($folderArray, 'files');
					
									$cusFolders = array(
					
														'company_id' => $company_id, 
										
														'user_id' => $this->data['data']->user_id, 
										
														'folder_id' => $folder_id);
										
									$this->folder_model->insert($cusFolders, 'customer_folders');
					
				  					$this->uploader->create_dir($dir, false);
			
					
		       					}
				
				
				echo json_encode(array('message' => 'Folder Created'));
				
				return false;
				
			}
		
	 }
	

	
	$this->load->view('clientarea/modules/create_folder', $this->data);
	
}

Public function upload_files($company_id=false)

{
	
	if(!empty($this->posts))
	
	{
		
		if(empty($_FILES ) > 0)
		
		{
			
			$this->error_message();
			
			
		}
		
		else 
		
		{
			
			$this->process_files($company_id, $_FILES);
			
		}	
		
		return false;
	}
	
	$this->data['folders'] = $this->folder_model->get_folders($company_id);
	
	$this->data['main_path'] = $this->uploader->create_path(array(
	
															      $this->data['data']->company_name,
															
															      $this->data['folders'][0]['company_name'],
															      
																  'files'
	
															      )
																  
															).'/';
	
	$this->load->view('clientarea/modules/upload', $this->data);
	
}

Public function lock($folder_id, $ajax=false)

{
	
	if($this->posts)
	
	 {
	 	
		
	 	
		$this->fields = array('password');
		
		$this->errors = array('required|folder_password_check['.$folder_id.']');
		
		$this->runValidator($this->fields, $this->errors);
				 
				 
				 //Is it Valid?
				 if ($this->form_validation->run() == FALSE)
				
				  {
				  	   
					 if($ajax == true)
					 
					 {
					 	
						return $this->form_validation->error_array();
						
					 }
						//show the form and send the parameters of the failed fields
				  		echo json_encode($this->form_validation->error_array());	
						
						return false;
				  }
				  
				 else
				 	
			      {
			      	
					if($ajax == true)
					 
					 {
					 	
						return array('unlock' => 'Folder Has Now been Unlocked.');
						
					 }
			      	   
					   echo json_encode(array('unlock' => '<strong>Folder Has Now been Unlocked.</strong>'));
			      	
				  }
		
		return false;
		
		
	 }
	
	$this->load->view('clientarea/folders/folder_password', $this->data);
}


Public function delete( $type , $id , $locked=false)

{
	
	if(!empty($this->posts))
	
	{
		
		if($type == true)
		
		{
				
        	$this->uploader->delete_folder($this->posts['path']);
		
			$where = array('id', 'parent_id');
		
			foreach($where as $w)
		
			{
			
			$this->folder_model->delete($id, $w, 'files');
			
			}
			
			$this->folder_model()
		
			return false;
		
         }
		
	}
	
	$this->load->view('clientarea/folders/confirm_delete', array('locked' => $locked));
	
}

/*
 * 
 * Validate That we a have a file;
 * 
 */

Public function error_message()

{
	
	$this->data['warning'] = "Please Upload A File First";
	
    echo json_encode(array('error' => $this->load->view('clientarea/modules/flashmessagewarning', $this->data, true)));
	
	return false;
}

/*
 * 
 * Function to process the files into relavant folders...
 */

Private function process_files($company_id, $files)

{
	//Does the file currently exist in that folder
	
	if($this->uploader->has_file($this->posts['path'].$files['file']['name']))
	
	{
		//return true if the file exists
		
		$exists = true;
		
	}
	
	else
		
	{
		//The file does not exist, return false
		
		 $exists = false;	
	}
	
	//We may want overwrite the current file so we allow the file to be uploaded
	
	$data =  $this->uploader->upload_it($this->posts['path'], $files, $company_id);
	
	//The file did not previously exist, 
	
	if($exists == false)
	
	{
	
	   //We add an entry into the db
	   
	   $this->folder_model->insert($data, 'files');
	   
	}
	
	//Return the confirmation message
	
	echo json_encode(array('message' => 'File Has been uploaded!'));
	
}

}