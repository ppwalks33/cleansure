/**
 * Cleansure Jquery form scripts
 * 
 * @author Cleansure
 * 
 * @param add stock..
 */

$(document).ready(function(){
	
	//Equal heights
	
	$('.header').matchHeight();
	
	/*
	 * Submit handler
	 * 
	 * This is available at dom ready..
	 * 
	 */
	
	$('input.process_order').prop('disabled', false);
	
	/*
	 * Save order submit handler
	 * 
	 */
	
	$('a.save_order').click(function(){
		
		
		var order_id = $(this).attr('data-order');
		
		var href = $(this).attr('href');
		
		var $anchor = $(this);
		
		$.get('/clientarea/stores/save_order_form/'+order_id, function(html){
  			
  			/*
  			 * Set the modal up..
  			 * 
  			 */
  			
  			$('h1.modal-title').html("<span class='glyphicon glyphicon-alert'></span>&nbsp;&nbsp;Save This Order For Later Use!");
				
			$('div.modal-body').html(html);
				
			$this.modal('show');
			
			$('form.form').attr('action', href);
			
			$('input[type="submit"]').attr('name', 'submit');
			
			
			$('input[name="submit"]').click(function(data){
				
				var $form = $(this).closest('form');
				
				$.post(href, $form.serialize(), function(){
					
					$('div.modal-body').prepend('<div id="message"></div>');
				
				    $('div#message').html(confirm_message('<p>This order has now been saved'))
				
								.hide()
								
								.fadeIn(2000);
				
				            setTimeout(function() {
      
							$this.modal('hide');
							
							$anchor.html('<span class="glyphicon glyphicon-floppy-saved"></span>').addClass('saved');

						}, 3000);
					
					
				})
				
				

				return false;
				
			});
			
			
			
		});
		
		
		return false;
	})
	
	/*
	 * Update stock submit handler
	 * 
	 */
	
	$("input.update_stock").on('click', function() {
		
		/*
		 * All the needed variables
		 * 
		 */
		
		var $submit = $(this);
		
		var $form = $submit.closest('form');
		
		var location = $form.attr('action');
  
  		var formData = $form.serializeArray();
  		
  		var target  = $submit.attr('data-target');
  		
  		/*
  		 * Push some additonal data into the post array
  		 * 
  		 */
  		
  		formData.push({ name: this.name, value: this.value });
  		
  		/*
  		 * Get the confirmation modal
  		 * 
  		 */
  		
  		$.get('/clientarea/stores/confirm/', function(html){
  			
  			/*
  			 * Set the modal up..
  			 * 
  			 */
  			
  			$('h1.modal-title').html("<span class='glyphicon glyphicon-alert'></span>&nbsp;&nbsp;Please Confirm Order!");
				
			$('div.modal-body').html(html);
				        
			$('div.modal-footer').hide();
				
			$this.modal('show');
			
			/*
			 * If we confirm we then continue to update the order
			 * 
			 * On;y at this point we will post out to server
			 * 
			 */
  		
  		    	$('a.confirmOrder').click(function(){
  		    		
  		    		//Hide the modal
  		    		
  		    			$this.modal('hide');
  		    			
  		    			//Post the data
  		    	
  		    			$.post(location, formData,function(data){
  		    				
  		    		   //Get the returned json array from the server
  			
  						var obj = jQuery.parseJSON(data);
  						
  						//Update the dom elements with the returned data
  						
  						  $('span#s'+target).text(obj.qty);
						  
						  //Update the hidden input & data attributes
						  
						  $('input#q'+target).val(obj.qty);
						  
						  //In case we have previously locked the submit remove it..
						  
						  $('input#c'+target).attr('data-stock', obj.qty).prop('disabled', false);
  			
  		  				})
  		  			
  		  		   return false;
  		  		   
  		   		})	
  		
  		})
		
		return false;
	});
	
	$('a.confirmDeleteOrder').click(function() {
		
		var url = $(this).attr('url');
		
		var order_id = $(this).attr('data-order');
		
		$.get('/clientarea/stores/confirm_delete_order/'+order_id, function(data){
  			
  			/*
  			 * Set the modal up..
  			 * 
  			 */
  			
  			$('h1.modal-title').html("<span class='glyphicon glyphicon-alert'></span>&nbsp;&nbsp;Please Confirm You Wish To Delete The Order!");
				
			$('div.modal-body').html(data);
				        
			$('div.modal-footer').hide();
			
			$('div.modal-header h1').html('&nbsp;&nbsp;');
				
			$this.modal('show');
			
			//confirm_delete();
			
		});
		
		return false;
	});
	
});

/*
 * Ajax cart, dom to listen when we process
 * 
 * orders...
 * 
 */

$(document).on('click', 'input.process_order', function() {
	
	/*
	 * Create some useful vars...
	 * 
	 */
	
	//alert('here'); return false;
	
	var $submit = $(this);
	
	var $form  = $submit.closest('form');
	
	var location  = $form.attr('action');
	
	var process = false;
	
	var cartExists = $(this).attr('data-cart');
	
	var order_id = $(this).attr('data-order');
	
	if(cartExists == true)
	
	{
		
		process_order(order_id, $form.serialize());
		
		return false;
		
	}
	
	/*
	 * Get the customers for this account
	 * 
	 */
	
	$.get('/clientarea/stores/customers/1/', function(data) {
		
		/*
		 * Get the dropdown and put it into the form
		 * 
		 */
		
		dropdown('company', data);
		
		/*
		 * Disable the submit button temp
		 * 
		 */
		
		$('input.process_order').prop('disabled', true);
		
		/*
		 * Create a listener for the appended select
		 * 
		 * to change
		 * 
		 */
		
		$('select[name="customers"]').change(function() {
			
			//Create a var for the customer id
			
			var customer = $(this).val();
			
			/*
			 * Quick Validation to check we got an
			 * 
			 * Integer back from the select
			 * 
			 */
			
			if(customer.match(/\d+/))
			
			{
				
				/*
				 * Yes we have an integer so we now load the sites dropdown
				 * 
				 */
			
			   $.get('/clientarea/specifications/sites/'+customer, function(data){
			   	
			   	/*
			   	 * Get the dropdown
			   	 * 
			   	 */
			   	
			    dropdown('site', data);
			    
			    /*
			     * Create a listener flor the sites select
			     * 
			     * to change
			     * 
			     */
			    
			    $('select[name="sites"]').change(function() {
			    	
			    //Create a var for site_id
							  
			   	  var site_id = $(this).val();
			   	  
			   	  /*
			   	   * Once again have we got an integer
			   	   * 
			   	   */
			   	
			   	   if(site_id.match(/\d+/))
			
			        {
			        	
			          /*
			           * Right we got all the data we need
			           * 
			           * We need to add another click event
			           * 
			           * first we need to switch the classes round 
			           * 
			           * 
			           */
			          
			          
			          
			          $('input.process_order').prop('disabled', false)
			          
			          						  .addClass('process')
			          						  
			          						  .removeClass('process_order');
			          						  
			          	/*
			          	 * Final Process Order event
			          	 * 
			          	 */
			          
			          $('input.process').click(function(){
			          	
			          	/*
			          	 * Post the form data
			          	 * 
			          	 */
			          	
			          	$.post('/clientarea/stores/process_order/'+customer+'/'+site_id ,$form.serialize(), function(data) {
			          		
			          		/*
			          		 * We need to add one to the alerts counter
			          		 * 
			          		 * Get the span tag
			          		 * 
			          		 */
			          		
			          		var alertCounter = $('span.alertCounter');
			          		
			          		/*
			          		 * Get the value of the alert and add 1
			          		 * 
			          		 */
			          		
			          		var updatedCounter = parseInt(alertCounter.text()) + 1;
			          		
			          		/*
			          		 * Update the span tag
			          		 * 
			          		 */
			          		
			          		   alertCounter.text(updatedCounter);
			          		
			          		
			          	/*
			          	 * Switch the class round
			          	 * 
			          	 */
			          		
			              $('input.process_order').addClass('process_order')
			              
			                                      .removeClass('process');
			                                      
			          		/*
			          		 * Fade The table out and show the confirmation message
			          		 * 
			          		 */
			          		
			          		$('div#basket').fadeOut(2000)
			          		
			          							 .html('<h4><span class="glyphicon glyphicon-ok"></span>&nbsp;Order Processed<h4><br><br><a href="/clientarea/stores/" title="Go Back To Stores" class="btn btn-default btn-lg btn-block"><span class="glyphicon glyphicon-share-alt"></span>&nbsp;&nbsp;Back To Stores</a>')
			          								 
			          							 .fadeIn(2000);
			          		
		                  
		                })
		                
		                 return false;
			          	
			          	
			          })
			      	
			      	  
			      	
			      }
			      
			      })
			   	
			   })
			   
			 }
			 
			 return false;
		})
		
		
	})
	
	
	return false;
 	
})

/*
 * Document on events, below these are triggered from ajax 
 * 
 * inserted content to still use the animations
 * 
 * Below is the quantity functions
 * 
 */

$(document).on('click', 'input.submit', function() 
	
	{
		/*
		 * All the needed variables
		 * 
		 */
		
		var $submit = $(this);
		
		var $form = $submit.closest('form');
		
		var location = $form.attr('action');
  
  		var formData = $form.serializeArray();
  		
  		var stockLevel = $submit.attr('data-stock');
  		
  		var target = $submit.attr('data-target');
  		
  		 var currentVal = $('input#q'+target).val();
  		
  		//Create an array of form data
  		
  		var result = { };
  		
  		//Push some data into the array
  
  			formData.push({ name: this.name, value: this.value });
  			
  		//and some more...
  			
  			formData.push({ name:'target', value:target})
  			
  		//Get the length of the array and loop it..
  			
  			len = formData.length;
    
  			for (i=0; i<len; i++) {
  				
  				//Add the data to the form array
  
  				result[formData[i].name] = formData[i].value;

			}
			
			/*
			 * We need to run some checks 
			 * 
			 * Is the quantity we want more than whats in stock?
			 * 
			 */
			
			
  		
			if(parseInt(result['qty']) > parseInt(currentVal))
			
			{
				
				/*
				 * Yes, do nothing and show the user a warning!
				 * 
				 */
				
				$('h1.modal-title').html("<span class='glyphicon glyphicon-alert'></span>&nbsp;&nbsp;Warning!");
				
				$('div.modal-body').html('<strong>Not Enough Stock Available!</strong>');
				        
				$('div.modal-footer').hide();
				
				$this.modal('show');
				
				return false;
			}
				
			else
				
			{	
				
			/*
			 * No we have enough stock so continue..
			 * 
			 * remove any previous classes we appended
			 * 
			 * Then add the class back to the submitted form to identify it
			 */	
  			
  		    $('form.add_stock').removeClass('submitting');
  		
  		    $('input[name="qty"]').removeClass('error');
  		    
  		    $form.addClass('submitting');
  		    
  		    /*
  		     * Post the data
  		     * 
  		     */
  			 
            $.post(location, formData, function(data)
            
            {
            	
             /*
              * Get the json response
              * 
              */
          	
			  var obj = jQuery.parseJSON(data);
			  
			  /*
			   * Loop the response
			   * 
			   */
			
                $.each( obj, function( key, value ) 
						
			     {
			     	
			     	   /*
			     	    * Is it the view been sent back to reload the cart
			     	    * 
			     	    */
						
						if(key == 'view')
						
						{
							
						 /*
						  * Create a variable of the remaining stock
						  * 
						  */
							
						  var remaining = currentVal- result['qty'];
						  
						  //Update the span tag
						  
						  $('span#s'+target).text(remaining);
						  
						  //Update the hidden input
						  
						  $('input#q'+target).val(remaining);
						  
						  //Update the data attributes
						  
						  $submit.attr('data-stock', remaining);
						  
						  //Scroll the page to show the user confirmation
							
						  $('html, body').animate({ scrollTop: "460px" }, 1000);
						  
						  //Update the basket section with the html
							
						  $('div#basket').html(
								
							"<div class=\"alert alert-success added\" role=\"alert\">Successfuly Added!</div>"
								
								+value);
							
							//Wait 4 seconds then remove the confirmation...
									
							$('div.added').delay(4000).fadeOut(1000);
					}
			     
			     //We have form errors
							
				  if(!$('form.submitting input[name="'+key+'"]').is(':disabled'))
							
				  {
				  	
				  	/*
				  	 * Add the error class to the input
				  	 * 
				  	 */
							
				      $('form.submitting input[name="'+key+'"]')
							
							 .addClass('error')
							
							 .attr('placeholder', value);
							 
							 return false;
							
				        	}
					
							
						});
			
		        })
		
		   }
       
		return false;
	});
	

$(document).on('keyup','input.cartQty', function(){
	
	/*
	 * All the required variables to manipulate the document
	 * 
	 * 
	 */
	
	var $input = $(this);
	
	var target = $input.attr('data-target');
	
	var qtyBefore = $input.attr('data-qty');
	
	var qty =   $input.val();
	
	var row = $input.attr('data-row');
	
	var currentStock = $('input#q'+target).val();
	
	var cartNum = $input.attr('data-order');
	
	var updatedQty;
	
	var difference;
	
	var updated;
	
	
	/*
	 * We are using a keyup function, so it does not trigger instantly we create a 1 second delay to allow the
	 * 
	 * the user to finish typing..
	 * 
	 */
	
     delay(function()  {
     	
     
     /*
      * Calculate the difference between the previous
      * 
      * quantity and the updated quantity
      * 
      * this will allow us to check if we are adding or subtracting..
      * 
      */
     	
     	
	  difference = qty - qtyBefore;
	  
	  /*
	   * Are we asking for more stock?
	   * 
	   */

      
      if(qty > parseInt(qtyBefore))
      
      {
      	
      	updatedQty = true;
      	
      	
      	 if(currentStock >= difference)
      	 
      	 {
      	 	/*
      	 	 * Is the stock left enough for the updated
      	 	 * 
      	 	 * order...
      	 	 * 
      	 	 */
      	 	
      	 	updated = currentStock - difference;
      	 	
      	 	$('input#q'+target).val(updated);
      	 	
      	 	$('span#s'+target).text(updated);
      	 	
      	 	$('input[name="'+cartNum+'[original_stock]"]').val(updated);
      	 	
      	 	$input.attr('data-qty', qty);
      	 	
      	 	
      	 	
      	 }
      	 
      	 else
      	 
      	 {
      	 	
      	 	/*
      	 	 * Not enoughn stock left
      	 	 * 
      	 	 * Show warning....
      	 	 * 
      	 	 */
      	 	
      	 	$('h1.modal-title').html("<span class='glyphicon glyphicon-alert'></span>&nbsp;&nbsp;Warning!");
				
			$('div.modal-body').html('<strong>Not Enough Stock Available!</strong>');
				        
			$('div.modal-footer').hide();
				
			$this.modal('show');
			
			$input.val(qtyBefore);
				
			return false;
      	 	
      	 }
      	
      	      	
      }
      
      /*
       * We are reducing the requested amount of
       * 
       * stock..
       * 
       */
      
      else if (qty < parseInt(qtyBefore))
      
      {
      	
      	
      	
      	updatedQty = false;
      	
      	/*
      	 * In case we don't want any of that stock set
      	 * 
      	 * it to 0 and remove it from the basket
      	 * 
      	 */
      	
      	if(qty == 0)
      	
      	{
      		$('input#q'+target).val(qtyBefore);
      	 	
      	 	$('span#s'+target).text(qtyBefore);
      	 	
      	 	$('input[name="'+cartNum+'[original_stock]"]').val(qtyBefore)
      	 	
      	 	$('tr#'+row).fadeOut(1500, function(){ $(this).remove(); })
      	 	
      	}
      	
      	/*
      	 * We are simply deducting stock so we need to get the level in stock
      	 * 
      	 * and add the difference to it to update the stock levels
      	 * 
      	 */
      	 		
      	 	updated = parseInt(currentStock)  + Math.abs(difference);
      	 	
      	 	/*
      	 	 * Update the relevent fields in the document 
      	 	 * 
      	 	 */
      	 	
      	 	$('input#q'+target).val(updated);
      	 	
      	 	$('span#s'+target).text(updated);
      	 	
      	 	$('input[name="'+cartNum+'[original_stock]"]').val(updated);
      	 	
      	 	$input.attr('data-qty', qty);
      	 	
      	
      }
      
     /*
      * Post of the request
      * 
      */
     
    $.post('/clientarea/stores/update_row/'+target, {'qty':qty, 'row_id':row, 'qty_before': qtyBefore},function(data){
    	
    	console.log(data);
    	
    });
    
    }, 1000 );
      
	
	return false;
})



/*
 * Listener for removing stock from the basket
 * 
 */

$(document).on('click', 'a.removeRow', function(){
	
	/*
	 * Get the target row
	 * 
	 * 
	 * And some other data
	 */
	
	var target = $(this).attr('data-target');
	
	var qty = $('tr#'+target+' input.cartQty').val();
	
	var id = $(this).attr('data-id');
	
	var currentStock = $('input#q'+id).val();
	
	var updatedStock = parseInt(qty) + parseInt(currentStock);
	
	/*
	 * Update the quantity with a 0;
	 * 
	 */
	
	$.post('/clientarea/stores/update_row/', {'row_id':target, 'qty':'0'}, function(){
		
		$('input#q'+id).val(updatedStock);
		
		$('input[name="original_stock"]').val(updatedStock);
		
		$('span#s'+id).text(updatedStock);
		
		$('tr#'+target).fadeOut(1500, function(){ $(this).remove(); });
		
	});
	
	return false;
	
})

/*
 * Function to empty the checkout completely..
 * 
 */

$(document).on('click', 'a.empty', function()

{
	
	var updateCart = $(this).attr('data-cart');
	
	var orderId    = $(this).attr('data-order');
	
	if(updateCart > 0)
	
	{
		
		$.get('/clientarea/stores/delete_order/'+orderId, function(html){
  			
  			/*
  			 * Set the modal up..
  			 * 
  			 */
  			
  			$('h1.modal-title').html("<span class='glyphicon glyphicon-alert'></span>&nbsp;&nbsp;Please Confirm You Wish To Delete The Order!");
				
			$('div.modal-body').html(html);
				        
			$('div.modal-footer').hide();
				
			$this.modal('show');
			
			/*
			 * If we confirm we then continue to update the order
			 * 
			 * On;y at this point we will post out to server
			 * 
			 */
  		
  		    	confirm_delete();

  		    		
  		    		//Hide the modal
  		    		
  		    			$this.modal('hide');
  		    			
  		    			//Post the data
  		    	
  		    			
  		  			
  		  		  
  		
  		})
		
	}
	
	return false;
	
})

//Script functions here

/*
 * Create a delay for the key up functions
 * 
 * so the user can finish typing before we update the 
 * 
 * screen...
 * 
 */

var delay = (function()

{
 
 var timer = 0;
  
 return function(callback, ms)
 
 {
    clearTimeout (timer);
    
    timer = setTimeout(callback, ms);
    
  };
  
})();

function dropdown(name, data)

{
	
	$('div#'+name+'Select').hide()
						
							  .html(data)
							  
							  .fadeIn(2000);
							  
	$('.selectpicker').selectpicker({'size': 15});
}

function process_order(order_id, formData)

{
	
	$.post('/clientarea/stores/update_order/'+order_id, formData, function(){
		
		window.location.replace("/clientarea/stores/");
		
	})
	
	return false;
}

function confirm_message(str)

{
	
	return '<div class="alert alert-success" role="alert">'+str+'</div>'
}

function confirm_delete()

{
	
	$('a.confirmDelete').click(function(data){
  		    		
  		    		
		            $.post($(this).attr('href'), {'data':true}, function(data){
		             	
		             var obj = jQuery.parseJSON(data);
    	 
    					$.each( obj, function( key, value ) 
						
			     			{
			     	
			     				
    	 			
    	 						if(key == 'basket')
    	 			
    	 						{
    	 			
    	 	         				 $('div#basket').html(obj.basket);
    	 	          
    	 	       				  }
    	 	       				  
    	 	       				  else if(key == 'redirect')
    	 	       				  
    	 	       				  {
    	 	       				  	
    	 	       				  	window.location.replace("/clientarea/stores/");
    	 	       				  }
    	 	         
    	 	     			 });
    	 	     			 
    	 	     			 
		             	return false
		             	
		             })
 return false;
  		  		   
  		   		})	
  		   	}
