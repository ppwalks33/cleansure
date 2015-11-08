
var $this = $('#cleansureModel');

$(document).ready(function()

{
	
	$('.package').click(function() {
		
		var url = $(this).attr('data-package');
		
		var id = $(this).attr('data-id');
		
		$.get('/register/payment/'+url+'/'+id+'/', function(data) {
			
			var target = $('div#payment_form');
			
				target.hide().html(data).fadeIn(2000);
			
			
		})
		
		return false;
		
	});
	
	
});

