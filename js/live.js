 // jQuery plugin to prevent double submission of forms
 
jQuery.fn.preventDoubleSubmission = function() {
	
  $(this).on('submit',function(e) {
  	
    var $form = $(this);

    if ($form.data('submitted') === true) {
    	
      // Previously submitted - don't submit again
      e.preventDefault();
      
      return false;
      
    } else {
    	
      // Mark it so that the next submit can be ignored
      $form.data('submitted', true);
      
    }
    
  });

  // Keep chainability
  return this;
  
};

 $('a.trigger').on("click",function(){
 	

 	
 	$(this).prop('disabled', true);
    	
    	var href = $(this).attr('href');
    	
    	var glyph  = $(this).attr('data-glyph');
    	
    	var title  = $(this).attr('data-title');
    	
    	var dismiss  = $(this).attr('data-dismiss');
    	
    	var action = $(this).attr('data-action');
    	
    	var func = $(this).attr('data-function');
    	
    	var header = $(this).attr('title');
    	
    	$('h3.modal-title').text(title);
    	
    	if(permission > 1 || dismiss == 1)
    	
    	{
    		
    		$('div.modal-footer').hide();
    		
    	}
    	
    	else
    	
    	{
    		
    		$('div.modal-footer').show();
    	}
    	
    	$.get(href, function(data) {
    		
    		$this.find('div.modal-body').html(data);
    			
    		   				
               $('.wisy').redactor({convertDivs: true,  buttons: ['formatting', 'bold', 'italic', 'deleted']});
               
    		$('.todaysDate').datepicker();
    		
    		$('a#addressFinder').remove();

    		$this.modal('show');
    		
    		if(action == false) { 
    			
    			
    		
    		if ( $.isFunction(window.form_submit) ) {
    			
    		
    			
    			if(func == '3')
    			
    			{
    				
    				 upload_files(href);
    				 
    				 return  false;
    				
    			}
    			
    		
    			
    				  datepicker();
    		
    		          form_submit(href, true, true);
    		           
    		       }
    		         
    		   else if ( $.isFunction(window.spec_form_submit ) ) 
    		         
    		       {
    		  
    		          	switch (func) { 
        
        					case '1': 
        					
        					var  element = 'table.taskstable tr.bathroom, div#toilets';
        					
        					var  disElem = 'div#accordion1 h4.panel-title a';
        					
        						$(disElem).addClass('disabled');
        						
        						disableElement('.sci', disElem);
        					
        						$(element).hide();
    		        			
    		        			classChange('select.type', 'table.taskstable tr.bathroom, div#toilets');
    		        			
    		        			spec_form_submit(href);
    		        			
    		        		 break;  

        						case '2':
        						
        						score(href);
        						
    		        	
    		        	return false;
    		        	
    		        	}
    		         	
    		         }
    		     
    		     } 
    		   
    		     
    		     return false;
    		
    	     });
    	
    	return false;
    });
    
    
   function clickHandlerA() 
   
 {
 	 
   $('a.trigger').unbind('click');
  
   $('a.trigger').bind('click', clickHandlerA);
}
    
  /*
   * Delete function
   * 
   */
 
 $(document).on('click', 'a.remove', function(){
 	
 	var href = $(this).attr('href');
 	
 	var target = $(this).attr('data-target');
 	
 	var counter = $(this).attr('data-counter');
 	
 	$.post(href, {'delete':true}, function(){
 		
 		$('table.alerts tr#'+target).fadeOut(2000, function() { $(this).remove(); });
 		
 		if(counter != '')
 		
 		{
 			
 			var number = $('.'+counter).text();
 			
 			var total = parseInt(number) - 1; 
 			
 			var rowCount = $this.find('table tbody tr').length;
 			
 			//alert(rowCount);
 			
 			$('.'+counter).text(total);
 			
 			if(rowCount == 1)
 			
 			{
 				
 				$('.'+counter).remove();
 				
 				$('table.alerts tbody').html('<tr><td><b>No More Records</b></td><td></td><td></td><tr>');
 				
 			}
 		}
 	});
 	
 	return false;
 	
 });
 
 
 /**
  *Delete Process for removing table rows..
  * 
  *  
  */
 
 $('a.delete_row').on('click', function()  {
 		
 	var header = $(this).attr('title');
 	
 	var href = $(this).attr("data-url");
     	
    $('h3.modal-title').text(header);
   
    $('.modal-body').html('<p><strong>'+$(this).attr('data-prompt')+'</strong></p>'+delete_button(href));
    
    
        
 	$this.modal('show');
 	
 		$('a.confirm').click(function() {
 			
 			$.post(href, {'delete':'1'}, function(){
 				
 				location.reload();
 				
 			});
 			
 			
 			return false;
 		})
 	
 	return false;
 	
 });
 
 
 function delete_button(href)
 
 {
 	
 	return "<a href='"+href+"' title='Confirm Delete?' class='btn btn-danger topPadBtn confirm'><span class='fa fa-trash'></span> Confirm Delete?</a>";
 	
 }
 
 /*
  * Will be used throughout the build to convert strings
  * 
  */   

function stringToRef(str)

{
   
    var $slug = '';
    
    var trimmed = $.trim(str);
    
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    
    replace(/-+/g, '-').
    
    replace(/^-|-$/g, '');
    
    return $slug.toLowerCase();

        
        
}