$(document).ready(function()

{
	var $input = $('#pat_tested');
	
	var $wrapper = $('div.MyDate');
	
	var $target = $('div.date1 input.datepicker')
	
	$wrapper.each(function(i) {
		
		if(i > 0)
		
		  {
		
		    var $class = 'date'+i;
		
		    $(this).addClass($class);
		    
		    $('div.'+$class+' input.datepicker').attr({name:'#', placeholder:'Disabled...'}).prop('disabled', true);
	     
		
		}
		
	})
	
	$input.change(function () {	
		
    if(this.checked) {	
    	
        $('div.date1 input.datepicker').attr({name:'date[]', placeholder:'dd/mm/yyyy'}).prop('disabled', false);
        
        return false;
    }
    
    else
    
    {
    	
    	$('div.date1 input.datepicker').attr({name:'#', placeholder:'Disabled...'}).prop('disabled', true);
	     
	    return false;
    	
    }
   
});
	
	
});

