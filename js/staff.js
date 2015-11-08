 $(document).ready(function()
 
 {
 	//By default we need to disbale some inputs upon load
 	
 	$('div#medicalAddress input, div#medicalAddress select, div.finance input[type="text"], textarea[name="notes_dis"]').prop('disabled' , true)
 	
 	//Form checks 
 	
 	//Unlock form function calls
 	
 	removeDissabled('#financeOpen', 'div.finance input'); 
 	
 	var elements = ['health', 'disabilities']
 	
 	for(i=1;i<3;i++)
 	{
 		
 	n = i - 1;
 	
 	removeDissabled('input[name="'+elements[n]+'"]', 'div.notes'+i+' textarea')
 	
 	}
 	
 	
 	removeDissabled('input[name="contact_doc"]', 'div.medical-data input, div#medicalAddress input, div#medicalAddress select');
 	
 	removeDissabled('input[name="dbs_check"]', 'div.dbs-check select, div.dbs-check div.btn-group .btn');
 	
 	//Conviction checks
 	
 	$('select[name="conviction"]').change(function() {
 		
 		var target = $('textarea.comment');
 		
 		var options = $( "select[name='conviction'] option:selected" ).val();
 		
 		if(options == 0)
 		{
 		
 		  target.prop('disabled' , true)
 		
 		}
 		
 		else if(options == 1)
 		{
 			
 			 target.prop('disabled' , false)
 			
 		}
 	})
    
    $('input[name="startToday"]').change(function(){
    	
    	if(this.checked) {
    		
    		var todaysDate = $('input.todaysDate').val();
    		
    		$('input.datebutton-input').val(todaysDate);
    		
    		return false;
    	}
    	
    	return false;
    })
 
 });
 
 
 
 
 $(document).on('click', 'a.holiday_trigger', function(event) { 

 	
 	var location = $(this).attr('href');
 	
 	$('input[name="ids"]').remove();
 	
 	$.get(location, function(data) {
			
	    var obj = jQuery.parseJSON(data);
	    
	  	$('input[name="date[]"]').each(function( index ) { 
	  		
	  		$(this).val(obj[index]);
	  		
	  		});
	  		
	  	
	  		
	  	$('<input>').attr({type: 'hidden', name: 'ids',value: obj[2]+'#'+obj[3]}).appendTo('form');
 	
     });
 	
 	return false;
 	
 });
 
 $(document).on('click', 'a.approval', function(event) { 
 	
 	var counter = $(this).attr('data-counter');
 	
 	var location = $(this).attr('href');
 	
 	
 	var number = $('.'+counter).text();
 			
 	var total = parseInt(number) + 1; 
 			
 	$('.'+counter).text(total);
 	
 	$.post(location, function(data) {
 		
 		 var obj = jQuery.parseJSON(data);
 		 
 		  $this.modal('hide');
 		  
 		 window.location.reload;
 	});
 	
 	return false;
 	
 });
 
 
 function removeDissabled(element, target)
 
 {
 	
 	if($(element).prop('checked'))
 	
 	{
 		
 		$(target).each(function() {
 			
 			$(this).prop('disabled', false);
 			
 		});
 	}
 	
 	$(element).on("change", function(event) {
 		
 		if(this.checked) {
 		
 		$(target).each(function(index) {
 			
 			$(this).prop('disabled', status);
 			
 		});
 		
 		}
 		else
 		{
 		
 		$(target).prop('disabled', true);
 		
 		}
 		
 		return false;
 	});
 	
 }
