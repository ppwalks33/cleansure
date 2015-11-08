//Our model to be used sitewide...
var $this = $('#cleansureModel');
//Sitewide global initiation file#

 $(document).ready(function()
 
 {
 	
 	$.get('/clientarea/messages/'+user_id, function(data){
 		
 		//Run it through the message function
 		messages_alerts(data);
 		
 		return false;
 	});
 	
 	
 //	$('.selectpicker').selectpicker({'size': 15});
 	
 	$('.datepicker').datepicker({'size': 15});
 	
 	datepicker();
 	
 	$('a.addressFinder').click(function(e){
 		
 		
 			$('div.address').each(function(index)
 		
 				{
 			
 			
 					$(this).removeClass('active');
 					
 		
 				});
 		
 		var target = $(this).parent().addClass('active');
		
		$('h3.modal-title').text('Address Finder');
		
		$.get('/register/address_finder', function(data){
			
		$this.find('div.modal-body').html(data);
			
		$('form.form').addClass('postcodeFinder');
		
		$this.modal('show');

		$('form.postcodeFinder').on("submit", function() {
			
			$.post('/register/address_finder/', $(this).serialize(), function(data) {
				
				var obj = jQuery.parseJSON( data );
				
				$('div.active input').val('');
				
				if(obj.house_name == "") {
				
						$('div.active input[name^="address_line_1"]').val(obj.house_number+'  '+obj.street);
						
					}
					
					else
					{
						
						$('div.active input[name^="address_line_1"]').val(obj.house_name);
						
						$('div.active input[name^="address_line_2"]').val(obj.house_number+'  '+obj.street);
						
					}
				
				
						$('div.active input[name^="city"]').val(obj.town);
				
				
						$('div.active input[name^="postcode"]').val(obj.postcode);
				
						$('div.active select[name^="county"] option')
    
    							.filter(function() { return $.trim( $(this).text() ) == obj.region; })
    
    							.attr('selected',true);
    				
    								$('div.active div.open ul.selectpicker li:contains('+obj.region+')').addClass('selected');
				
									$('div.active .bootstrap-select .filter-option').text(obj.region);
				
							});
				
				
			//	$('form').unbind('submit');
					
				$this.modal('hide');
			
			return false;
			
			});
			
			
		
		});
		
		return false;
		
	});
	
	$('form.customer_form').submit(function(e) {
		
		e.preventDefault();
		
		var redirect = $(this).attr('data-after');
		
		$('form.customer_form input').removeClass('error');
		
		$.post($(this).attr('action'), $(this).serialize(), function(data) {
			
			var obj = jQuery.parseJSON(data);
			
			$.each( obj, function( key, value ) 
						
						{
							
						
						$('html, body').animate({ scrollTop: "460px" }, 1000);
							
						if(key == 'message')
							
							{
								
								
								$('div#'+key)
								
									.hide()
											
									.html(message(value, 'success'))
											
									.fadeIn(2000);
									
									if(typeof redirect != '')
									{
										$this.animate({ scrollTop: "50px" }, 1000);
										
										setTimeout(function(){
											
											window.location.href = redirect;
												
										}, 3000);
									}
														
							   }
							
							else
							
							{
								
							if(key == 'warning') {
								
								$('div#message')
								
									.hide()
											
									.html(value)
											
									.fadeIn(2000);
							}
							
							if(!$('input[name="'+key+'"]').is(':disabled'))
							
							{
							
							$('input[name="'+key+'"], div.'+key.replace('[]', '')+' button')
							
							.addClass('error')
							
							.attr('placeholder', value);
							
							}
							
							}
							
						});
						
						return false;
			
		});
		
		
		return false;
	});
	
	//Stops double submission using the model
	
	$this.on('hidden.bs.modal', function () {
		
    //Clear the submit binder
 		
 		$('form.form').unbind('submit');
 		
   
    })
 	
	
 	
    
    /*
     * Jquery to call the address finder
     * 
     * 
     */
    
    $(document).on('click', 'a.map',function() {
		
		var target = $(this).attr('href');
    	
    	var glyph  = $(this).attr('data-glyph');
    	
    	var title  = $(this).attr('data-title');
    	
    	var header = $(this).attr('title');
      	
    	$('h3.modal-title').html('<span class="glyphicon glyphicon-'+glyph+'"></span>&nbsp;&nbsp;<strong><span style="color:#1469eb;">G</span><span style="color:#db4632;">o</span><span style="color:#ffba02;">o</span><span style="color:#1469eb;">g</span><span style="color:#009a57;">l</span><span style="color:#db4632;">e</span></strong>&nbsp;Maps');
		
		$.get(target, function(data){
		
		$this.find('div.modal-body').html(data);
    		
    	$this.modal('show');
    	
    	return false;
    	
    	
    	
    
	});
	
	return false;
		
	});
	
 	
 	});
 	
 	
 	function form_submit(target, reload,scroll)
 	
 	{
 		
 		$('form').submit(function(e){			
    			
    	e.preventDefault();
    			
    	$('input , select').removeClass('error');
    			
    	$.post(target, $(this).serialize(), function(data) {
			
	    var obj = jQuery.parseJSON(data);
			      
			      $.each( obj, function( key, value ) 
						
						{
			      
			             if(key == 'message')
							
							{
								
								
								
								if(reload == true)
								
								{
									
								$this.modal('hide');
								
								location.reload();
								
								}
								
								else
								
								{
									
								$('div#modalMessage').hide()
								
												.html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span>&nbsp;'+value+'</div>')
												
												.fadeIn(2000);
								
								setTimeout(function(){
									
									 $this.modal('hide');
									
								}, 4000);
												
							   
							    
							   }
							}
							
							else
							
							{
								
							if ( !$('input[name="'+key+'"]').is(':disabled') ) 
							
							   {  
							   	
							   	if(scroll == true)
							   			
							   			{
							   				
							   				$this.animate({ scrollTop: "50px" }, 1000);
							   				
							   			}
			      
			                  		$('input[name="'+key+'"]')
							
							     							.addClass('error')
							 
							   								.attr('placeholder', value);
							   								
							   								
							   		$('span.error-text').html(value);
							   
							  	}
							   
							  }
							  
					     });
					     
					     
					     return false; 		
			      
			      });
			      
			      return true; 		
    		
    			
    		});
    		
 		
 		
 	}
 	
 	function datepicker()
 	
 	{
 		//Datepicker initiation
 		
 		
 		$(document).on('click', 'a.datebutton', function(event) { 
 	    	
 	    var selected = $(this).closest('.row').find('.datepicker');
    	
    	$(selected).datepicker( "show" );
    	
    	$('input[name="startToday"]').prop('checked', false);
    	
    	return false;
    	
    });
    
 	}
 	
 	$(document).on('click', 'a.delete', function(event) { 
 		
 		var $target = $(this).attr('data-id');
 		
 		var address = $(this).attr('href');
 		
 		var counter = $(this).attr('data-counter');
 		
 		$.post(address, function(){
 			
 			$('table tr#'+$.trim($target)).fadeOut(2000);
 			
 			if(counter != '')
 		
 		        {
 			
 			      var number = $('.'+counter).text();
 			
 			      var total = parseInt(number) + 1; 
 			
 			      $('.'+counter).text(total);
 			      
 			     }
			
 		})
 		
 		
 		
 		return false;
 	});
 	
 	function message(str,type)
 	{
 		
 		return '<div class="alert alert-'+type+'" role="alert">'+str+'</div>'
 	}
 	
 	//Message alert functions in real time..
 	
 	function messages_alerts(data){
 		
 		var obj = jQuery.parseJSON(data);
 		
 		if ( typeof obj.message_id !== 'undefined' ) {
 			
 		var count = obj.message_id.length;

 		var elem ='';
			      
			   for(i=0;i<obj.message_id.length;i++) {
			   	
			   	 elem += '<li><a href="/clientarea/messages/read/'+obj.message_id[i]+'"><div class="pull-left"><img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image"/></div>';
							
				 elem += '<h4>'+obj.from[i]+'</h4>';
							
				 elem += '<p>'+obj.message_title[i]+'</p>';
							
				elem += '</a></li>';
							
						}
	
		$('li.internal_messages ul.menu').html(elem);
		
		$('li.internal_messages span.messageCount').html(count);
		
		} else {
		
		$('li.internal_messages span.messageCount').html('0');
		
		}
		
		return false;
 		
 	}