  var $this = $('#cleansureModel');
  
  var $submitBtn = $('input.submit');
  
  var target;
  
  $(document).ready(function()
 
 {
 	
 	$('a#specSave, #spec').hide();
 	
 	//Load the select plugin
 	
 	$('.selectpicker').selectpicker({'size': 15});
 	
 	//Listen to when the customers select changes
 	
 	$('select[name="customers"]').change(function(data) {
 		
 		//Get the company id
 		
 		var id = $(this).val();
 		
 		//Get the select list of sites for that company
 		
 		$.get('/clientarea/specifications/sites/'+id, function(data) 
 		
 		{
 			
 			//Have we got data?
 			
 			if(data)
 			
 			{
 				
 			//Load it over the previous select
 				
 			$('div#sites').html(data);
 			
 			//Attach the select picker to the dynamic content
 			
 			$('.selectpicker').selectpicker({'size': 15});		
 			
 			}
 			
 			//Now we need to listen for the change from the dynamic select...
 			
 			$('select[name="sites"]').change(function(data) {
 				
 				//Which site has been selected
 				
 				var site = $(this).val();
 				
 				//Get the class of the button underneath
 				
 				var $select = $('.selectComp');
 				
 				//Remove the disabled state then add a click function to it....
 				
 				$select.prop('disabled', false).click(function() {
 					
 					//Get the d0ocument url
 					
 					var $url =  document.URL.replace(/\/$/, '');
 					
 					//Remove any # values inside the url
 					
 					var curUrl = ($url.indexOf('#') !== -1 ? $url.substr(0,$url.indexOf('#')):$url);
 					
 					
 					   //We can now pass different types of data to this page so we need the correct url structure..
 					   
 					   curUrl = curUrl.split("/").splice(0, 6).join("/");
 					
 					
 					var delete_url = curUrl+'/delete/'+site;
 					
 					
 					var save_url   = curUrl+'/complete/'+site;
 					
 					//Disable the selects to lock the user into using the same site whilst creating spec
 				
 					$('div.compSelect select').prop('disabled', true);
 					
 					//Anchor to refresh the page
 					
 					$('a.reload').removeClass('disabled');
 					
 					//Split the url to find out which section we are in
 					
 					var url_segments = curUrl.split('/');
 					
 					//Declare var href
 					
 					var href;
 					
 					//If there are more segments than 5 then we are in the QA section..
 					
 					if(url_segments.length > 5)
 					
 					
 					{
 						
 						href = curUrl+'/'+site+'/'+id+'/1/';
 					}
 					
 					else
 					
 					{
 						
 						//We are in the specifications section...
 						
 						href =  curUrl+'/'+site;
 					}
 					
 					  //Add a usl to the "new site button" and remove the disabled state...
 					
 					   $('a.new_site').attr('href', href).removeClass('disabled');
 					
 					//Remove the disable class from delete button
 					
 					$('a.delete_area').attr('href',delete_url).removeClass('disabled');
 					
 					//
 					$('a#specSave').attr('href',save_url).removeClass('disabled');
 					
 					//Input spec name clear it..
 					
 					$('input#spec_name').val('');
 					
 					//send the sanatized url to the form submit function..

 					})});})})});
 					
 					
 $('a#specSave, a#specSaveRec').on('click', function() {
 	
 	var href = $(this).attr('href');
 	
 	var spec_name = $(this).attr('data-name');
 	
 	if(spec_name == "")
 	
 	{
 		
 		alert('Error, Please Add A Specification Name!');
 		
 		return false;
 	}
 	
 	$.post(href, {'saved':'1', 'spec_name':spec_name}, function(data) {
 	
 	
 		$('html, body').animate({ scrollTop: "460px" }, 1000);
 		
 		
 		$('div#message').hide()
 			
 						.html(data)
 							
 						.fadeIn(2000);
 						
 						
 		$('table#spec_table tbody tr td.temp, table#spec_table thead tr th.temp').fadeOut(2000).remove();
 		
 		$('input#spec_name').val('');
 	
 	});
 	
 	return false;
 });
 
 //Add a name to the specification
 
 
 $(document).on('keyup', '#spec_name', function()
 
 {
 	
 	$('a#specSave').attr('data-name', $(this).val());
 	
 	return false;
 	
 })
 					
 					
 /*
  * Ajax Document loads 
  * 
  * 
  */
 
 $(document).on('click', 'a.confirm', function() {
 		
 		var $anchor = $(this);
 		
 		var href = $(this).attr('href');
 		
 		$(this).addClass('disabled');
 		
 		$.post(href, {'confirm':true}, function(data) {
 			
 			$('div#message').hide()
 			
 							.html(data)
 							
 							.animate({ scrollTop: "50px" }, 1000)
 							
 							.fadeIn(2000);
 			
 		});
 		
 		return false;
 		
 });
 
 
 $(document).on('click', 'a.delete_row', function() {
 		
 		var $anchor = $(this);
 				
 		var href = $(this).attr('href');
 		
 		var $target = $(this).attr('data-target');
 		
 		$.post(href, {'delete':true}, function() {
 			
 			$anchor.closest('tr').fadeOut(1000);
 			
 			$('table#spec_table th.'+$target+', table#spec_table td.'+$target).fadeOut(300, function() { $(this).remove(); });
 			
 		})
 		
 		return false;
 		
 	})
 					
/*
 * Function to submit this form
 * 
 */

function spec_form_submit(target)
 	
 	{
 		
 		//Submit the form
 		
 		$('form').submit(function(e) { 
 			
 		
 		//Clear the submit binder
 		
 		$('form').unbind('submit');
 		
 		
 		//Disable the submit button
 		
 		$submitBtn.prop('disabled', true);
 			
 		//Run the prevention of double submission
 		
 		 e.preventDefault();
 		 
 		 e.stopImmediatePropagation();
    	
    	
    	//Remove any previous error states
    			
    	$('input , select').removeClass('error');
    	
    	//Post the form data
    			
    	     
			$.post(target, $(this).serialize(), function(data) {
    		
    	//Parse the json responce from the server
			
	   var obj = jQuery.parseJSON(data);
	    
	    //Start a counter
	    
	   var i=0;
			
			//Loop over the records
			      
			      $.each( obj, function( key, value ) 
						
						{
					
							 if(data.length < 100)
							
								{
					
									validate(key, data, value, target);
									
									return false;
									
								}
							
							else 
							
							{
								
								i++;
								
								
								$this.modal('hide');
								  
								 var $class = stringToRef(obj.area);  
								
								if(i == 1)
								
								{
									
									
								  $('table#spec_table thead tr').append('<th class="'+$class+' temp">'+value+'</th>');
	    	
	    	                      $('table#spec_table tbody tr#1').append('<td class="'+$class+' temp"></td>');
						
								}
 								
								else
								
								{
								
								if(i == 7 || i == 19)
								
								{
									
									$('table#spec_table tbody tr#'+i).append('<td class="'+$class+' temp"></td>');
									
									i++;
									
								}
								
							 		$('table#spec_table tbody tr#'+i).append('<td class="'+$class+' temp">'+(value != '' ? '<span class="label label-default">'+value+'</span> / Week':'<span class="glyphicon glyphicon-remove"></span> N/A') +'</td>');
							 	
							 		
							 	
							    }
							    
							    $submitBtn.prop('disabled', false);
							    
							    
							    $('a#specSave, #spec').fadeIn(2000);
							    
								
							}
							  
					     });
					     
return false; 		
			      
			      });			     
					     
			      
			      return false; 		
    		
    			
    		});
    		
 		
 		
 	}
 	
 	function score(target)
 	
 	{
 	
 		
      var options = { 
	
				// The url we are posting to
   
   				 url:        target,
   				 
   				// Run this function before we submit the form to validate 
   				 
   				 beforeSubmit: function()  { 
   				 	
   				// Set the status to true
   				 	
   				  var status = true;
   				  
   				 // Loop each input
                   
                	 $('input.score').each(function(data) {
                	 	
                // Move the value into a variable
                	 	
                	 var areaVal = Math.abs(parseInt(this.value));
                	 
                /*
                 * Check for the following...
                 * 
                 * Whole number?
                 * 
                 * Is the value greater than 4?
                 * 
                 * Is the value less than 1?
                 * 
                 */
                	 	
                	 	if(areaVal % 1 != 0 || areaVal > 4 || areaVal < 1)
                   		
                   		{
                   			
                   			/*
                   			 * If true to any of the above add an error class 
                   			 * 
                   			 * Set the status to false
                   			 * 
                   			 */
                   			
                   			$(this).addClass('error');
                   			
                   			$this.animate({ scrollTop: "50px" }, 1000);
                   			
                   			status = false;
                   		}
                   		
                   		else
                   		
                   		{
                   			
                   			/*
                   			 * Nope all ok so we remove the error on that input in the array
                   			 * 
                   			 */
                   			
                   			$(this).removeClass('error');
                   		}
                 	
                 	
                 });
                 
                 /*
                  * Check the status of the form and return true/ false...
                  * 
                  */
                 
                  if (status == false)
                   
                   {
                   	
                   	return false;
                   	
                   } 
                   
                   return true;
					
			},
			
			//We have uploaded, all clear on browser side
   
   				 success:function(data) { 
   				 	
   				 	//Parse the json response
        
        			var obj = jQuery.parseJSON( data );
        				
        				//Have we got an error rather than data
        				
        				if(obj.hasOwnProperty('error'))
        				
        				{
        					//Scroll to the top of the modal
        					
        					$this.animate({ scrollTop: "50px" }, 1000);
        					
        					//Insert a message into the alert
        					
        					$('div#alert').html(obj.error);
        					
        					return false;
        					
        				}
        				
        				else
        				
        				{
        					
        					//All good, we have score, insert the data into the correct div
        					
        					$('div#scores').hide()
									
										  .html(obj.html)
												   
										  .fadeIn(2000);
												   
							$this.modal('hide');
									
							return false;
        					
        					
        				}

    		     } 
         }; 
 		
 		  $('form').ajaxForm(options);
 		
 	}
 	
 	
 	function validate(key, data, value, target)
 	
 	{
 		
 		
		if ( !$('input[name="'+key+'"]').is(':disabled') ) 
							
			{  
							   	
			$this.animate({ scrollTop: "50px" }, 1000);
							   				
			$('input[name="'+key+'"]')
							
							     	  .addClass('error')
							 
							   		  .attr('placeholder', value);
							   						
			$submitBtn.prop('disabled', false);
							   		
			}
			
			if(value == "")
			
			{
			
			  score(target);
			  
			 }
			 
			 else
			  
			  {
			  	
			  	spec_form_submit(target);
			  	
			  }
			
			return false;
 		
 	}
 	
 	function classChange(element, target)
 	
 	{
 		
 		$(element).change(function(){
 			
 			if($(this).val() == '1')
 			
 			{
 				
 				$(target).fadeIn(2000);
 				
 			}
 			
 			else if($(this).val() != '1')
 			
 			{
 				
 				$(target).hide();
 				
 			}
 		})
 		
 	}
 	
 	function disableElement(element, target)
 	
 	{
 		
 		$(element).change(function() {
 			
 			if($(this).val() == '1')
 			
 			{
 				
 				$(target).removeClass('disabled');
 				
 				$target_elem = $('div.mySCI a[href="#collapse1"]');
 				 
                $target_elem.trigger('click');
                
                $('div#collapse2').removeClass('in');
 				
 				$('div#collapse2').addClass('collapse');
 				
 			}
 			
 			else if($(this).val() != '1')
 			
 			{
 				
 				$(target).addClass('disabled collapsed');
 				
 				$('div#collapse1').removeClass('in');
 				
 				$('div#collapse1').addClass('collapse');
 				
 				$target_elem = $('div.mySCI a[href="#collapse2"]');
 				 
                $target_elem.trigger('click');
 				
 				
 				
 				
 			}
 			
 		});
 		
 	}
 	
 	//To check if we are dealing with a whole number
 	
 	function isInt(n) {
 		
  		if( n % 1 === 0 )
  		
  		{
  		
  		  return true;
  		  
  		}
  		
  		return false;
	
	}

	