$(document).ready(function(){
	/*
	 * Function to expand and unlock folders
	 * 
	 * this will prompt user for password on locked attributes
	 */
	
	$('a.toggle_files').click(function() {
		
		var locked = $(this).attr('data-locked');
		
		var folder = $(this).attr('data-folder');
		
		var target = $(this).attr('data-target');
		
		var myClass = $(this).children().attr('class');
		
		var classArray = myClass.split('-');
		
		var span = $(this).children('span');
		
		var newClass;
		
		var href = '/clientarea/folders/lock/'+$.trim(folder);
		
		if(locked == true)
		
		{
			
			$.get(href, function(data) {
				
				$('h1.modal-title').html("<span class='glyphicon glyphicon-lock'></span>&nbsp;&nbsp; Folder Password");
				
				$this.find('div.modal-body').html(data);
				
				$('input.submit').val('Enter Folder');
				
				$this.modal('show');
				
				$('form').submit(function(e){			
    			
    	        e.preventDefault();

    	        $.post(href, $(this).serialize(), function(data) {
			
	               var obj = jQuery.parseJSON(data);
			      
			      $.each( obj, function( key, value ) 
						
						{
								
								if(key == 'password')
								
								{
			      
			                  		$('input[name="'+key+'"]')
							
							     							.addClass('error')
							 
							   								.attr('placeholder', value);
							   								
							   								
							   		$('span.error-text').html(value);
							   		
							   		return false;
							   		
							   	}
							   	
							   	else if(key == 'unlock')
							   	
							   	{
						
							   		
							   		$('ul.fileTree li ul li a#t'+folder).attr('data-locked', '0');
							   		
							   		$this.modal('hide');
							   		
							   	}
							   	
						}); // End each;
					     
					 }); // End Post
			      
                 }); // End form submit
                 
                 
				
			}); // End get
			
			return false;
			
		} // End if..
		
		switch(classArray[2])
		
		{
			case 'down':
			
			classArray[2] = 'up';
			
			break;
			
			case 'up':
			
			classArray[2] = 'down';
			
			break;
			
		}
		
		    newClass = classArray.join('-');
		    
		    span.removeClass(myClass).addClass(newClass);
			
			$('ul#'+target).slideToggle()
								
		
		return false;
	});
	
	/*
	 * Delete file/folder function
	 * 
	 */
	
	$('a.trash').click(function() {
		
		var href = $(this).attr('href');
		
		var title = $(this).attr('title');
		
		var target = $(this).attr('data-target');
		
		var type = $(this).attr('data-type');
		
		var path = $(this).attr('data-path');
		
		var locked = $(this).attr('data-locked');
		
		if(locked == true)
		
		{
		
		   href = href+'/'+parseInt(locked)+'/';
		   
		   
		  
		 }
		
		$.get(href, function(data) {
			
			$('h1.modal-title').html("<span class='glyphicon glyphicon-folder-closed'></span>&nbsp;&nbsp;"+title);
				
			$('div.modal-body').html(data);
				
			$this.modal('show');
			
			$('div.modal-footer').remove();
			
			if(locked == true)
			
			{
				
				$( "form" ).on('submit', function(e){
					
					e.preventDefault();

					
					$.post('/clientarea/folders/lock/'+$.trim(target),{'password':$('input[name="password"]').val()}, function(data) {
						
						
						  var obj = jQuery.parseJSON(data);
						  
						  if(obj.hasOwnProperty('password'))
						  
						  {
						  	
						  	$('input[name="password"]')
							
							     						.addClass('error')
							 
							   							.attr('placeholder', obj.password);
							   								
							   								
							   		$('span.error-text').html(obj.password);
							   		
							   		return false;
						  	
						  } else if(obj.hasOwnProperty('unlock'))
						  
						  {
						  	
						  	
						  }
					
					return false;	
						
					})
				})
				
				
			}
			
			$('a.confirm_delete').click(function(){
				
				$.post(href, {'path':path}, function(data) {
					
					$('ul.fileTree li#'+target).fadeOut(2000);
				
				          $this.modal('hide');
					
					return false;
				})
				
				return false;
				
			})
		});
		
		return false;
		
	});
	
});

function upload_files(href)

{
	
    var options = { 
	
				// The url we are posting to
   
   				 url:        href,
   
   				 success:function(data) { 
   				 	
   				 	var obj = jQuery.parseJSON( data );
        				
        				//Have we got an error rather than data
        				
        				if(obj.hasOwnProperty('error'))
        				
        				{
        					//Insert a message into the alert
        					
        					$('div#alert').hide()
        					
        								  .html(obj.error)
        								  
        								  .fadeIn(2000);
        					
        					return false;
        					
        				} else if(obj.hasOwnProperty('message'))
        				
        				{
        					
        					$this.modal('hide');
        					
        					location.reload();
        				}
        				
   				 						
   				 		return false;

    		     					} 
         					}; 
 		
 		//Load the options into the plugin..
 		  			
 		 $('form').ajaxForm(options);
 		
 	
}
