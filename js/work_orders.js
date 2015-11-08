

$(document).ready(function() {
	
	$('.wisy').redactor({convertDivs: true,  buttons: ['formatting', 'bold', 'italic', 'deleted']});
	
	$('button.collapse-search').click(function(){
		
		$(this).find("span").removeClass('fa-minus fa-plus');
	})
	
	var $trigger = $('h4.panel-title a');
	
	    $trigger.addClass('disabled')
	
	$('select[name="customers"]').change(function(data) {
 		
 		//Get the company id
 		
 		var id = $(this).val();
 		
 		var purchase_order = $(this).attr('data-target');
 		
 		
 		$('input[name="comp_id"]').val(id);
 		
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
 			
 			$('select[name="sites"]').change(function(data) {
 				
 				//Which site has been selected
 				
 				var site = $(this).val();
 				
 				
 				$('input[name="site_id"]').val(site);
 				
 				//Get the class of the button underneath
 				
 				var $select = $('.selectComp');
 				
 				//Remove the disabled state then add a click function to it....
 				
 				$select.prop('disabled', false).click(function() {
 					
 					
 				
 					$('div.compSelect select').prop('disabled', true);
 					
 					//Anchor to refresh the page
 					
 					$('a.reload').removeClass('disabled');
 					
 					if(purchase_order == 'purchase_order')
 					
 					{
 						
 						p_order(id,site);
 						
 						return false;
 						
 					}
 					
 					
 					$trigger.trigger('click');
 					
 					$.get('/clientarea/work_orders/sci_check/'+site, function(data) {
 						
 						
 						$('div#specMessage').html(data);
 						
 						$('div#specMessage div.alert-danger').append('<a href="/clientarea/specifications" title="Create A New Specification" class="btn btn-default flash-btn pull-right">Create Specification</a>')
 						
 						
 					})
 					

 					})})	
 			
 			}
	
	
	   });
	
	return false;
	
	});
	
	
	$(document).on("click", "a.conStaff", function(event)
	
	{
		
   		 event.preventDefault();
    
   			 var staffIDs = $("input[name='staff_id[]']:checkbox:checked").map(function(){
    	
      			return $(this).val();
      
    		}).get(); 
    
   
    	$.post('/clientarea/work_orders/job_times', {staff_ids:staffIDs}, function(data) {
    	
    	
    			$('div#times').html(data);
    			
    			 $('.timepicker').timepicker({defaultTime:'06:00 AM' });
  
  				})
    
    
			});
	
});

function p_order(comp_id, site_id)
{
	 $('div.loader').html('<p><img src="/img/ajax-loader.gif" alt"loading"></p>')
	setTimeout(function(){
	//get the form 
	$.get('/clientarea/work_orders/get_order_form/'+comp_id+'/'+site_id, function(data){
		//show the sub button
		$('div.sub').removeClass('hidden');
		//clear the loader
		$('div.loader').html('');
		//split the return data into array
		var views = data.split('<div class="break"></div>');
		//create another instance of the counter
		var n;
		//start the for loop on the arr
		for(i=0;i<views.length;i++)
		{
			//Increment the counter
			n = i + 1;
			//load the data into the views
			$('div.p_o'+n).html(views[i]);
			//run a check
			if(i==1)
			{
				//Append data
				$('div.p_o'+n+' select').prop('disabled', true);	
			}
			
		}
		//Apply the selectpicker 
		$('.selectpicker').selectpicker();
		//Apply the editor
		$('.wisy').redactor();
		//Change on the radio to enable either side of the form
		$('input[name="order_type"]').on('change',function(){
			//which div are we unlocking
			var div = $(this).val();
			//remove any disable states
			$('div.area select').prop('disabled', true);
			//Reset the select boxes..
			$('div.area select').prop('selectedIndex',0);
			//Reset select picker plugin
			$('ul.selectpicker li:first-child').addClass('selected');
			//Reset the text...
			$('button.selectpicker span.filter-option').text('Select One...').attr('title', '');
			//Remove the final disabled states...
			$('ul.selectpicker li').removeClass('disabled');
			//unlock the button
			$('button.btn').removeClass('disabled');
			//unlock selects
			$('div.p_o'+div+' select').prop('disabled', false);
		})
		
		
		//stop timeout...
	})}
	           
	           
	           
	           ,3000);
	
	
}


