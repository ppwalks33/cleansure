$('a.markAll').on('click', function()

{
	
	var marked = $(this).attr('data-mark')
 	
	$('input.markIt').prop('checked', marked);
	
	return false;
});

//Delete function

$('form.alerts').on('submit', function() {
	
	//Create a var for checkboxes
	
	var checkboxes = $('input[name="id[]"]');
	
	//Initiate ids array
	
	var ids = [];
	
	//Initiate logs_id array
	
	var log_ids = [];
	
	//Create a log var
	
	var log; 
	
	//Loop the checkboxes
	
	$.each(checkboxes, function(){
		
		//Lets find the ones that have been checked
		
		if($(this).prop('checked') == true)
		
		{
			
		  //Get the nearest row and start the fade
		
		  $(this).closest('tr').fadeOut(2000, function() { $(this).remove(); } );
		  
		  //Push the value of the checkbox into the array
		  
		  ids.push($(this).val());
		  
		  //Get the value of the corresponding hidden input
		  
		  log = $(this).next('input[name="logs_id[]"]').val();
		  
		  //Push that into an array also
		  
		  log_ids.push(log);
		  
		 }
		
	 });
	 
	//How many are we deleting? Lets count them!
	 
	var number = ids.length;
	
	//Get the current amount of alerts
	
	var currentTotal = $('span.alertCounter').text();
	
	//Create a new total 
	
	var total = parseInt(currentTotal) - number; 
	
	//Update the alerts counter span
	
	$('span.alertCounter').text(total)
	
	 //Post of the 2 arrays to the server
	 
			$.post('/clientarea/remove_alert', {'ids':ids, 'log_ids':log_ids}, function(){
		
		
		//All Done!
		
			return false;
	
			});

	//Return false on the click handler...
	
	return false;
	
	
});
