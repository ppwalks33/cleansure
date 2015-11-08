$(document).ready(function() {
		
	
	var compCheck = $('input.cust_dupe');
	
	var $type = $('div.company_info div.customer-contact-info input, div.company_info div.customer-contact-info select');
	
	var $companyAddress = $('div.company_info div.address input, div.company_info div.address select')
	
	var $company = $('div.company_info  input, div.company_info select');
				
	var $hideShow = $('div.site_info label.comp_postal, hr.comp_postal');
	
	var label = $('div.site_info label.cc_dupe span')
	
	var labelText = 'Company';	
	
	if($( "select[name='type'] option:selected" ).val() == "")
	{
		
		$company.prop("disabled", false);
		
		labelText = 'Customer';
	}
	
	else if($( "select[name='type'] option:selected" ).val() == false)
	
	{
		
		$('input#cust_cont_dupe').css({'visibility':'hidden'}).prop('disabled', true);
		
		$('input#cc_dupe').css({'visibility':'visible'}).prop('disabled', false);
		
		$company.prop("disabled", true);		
		
		labelText = 'Customer';
			
	}
	
	else
	{
		
		
		
		$company.prop("disabled", false);
		
		$('input#cust_cont_dupe').css({'visibility':'visible'}).prop('disabled', false);
		
		$('input#cc_dupe').css({'visibility':'hidden'}).prop('disabled', true);
		
	}
	
	label.text(labelText);	
	
	
	$('select.type').change(function(event) {
		
		  event.preventDefault();
		
				var type = $(this).val();
				
				var $type = $('div.company_info input, div.company_info select');
				
				var $hideShow = $('div.site_info label.comp_postal, hr.comp_postal');
				
				var label_text = $("select.type option[value='"+type+"']").text();
				
				$type.prop("disabled", false);
		
				if(type == false)
					
					{
						
						$type.prop("disabled", true);
						
						$type.each(function( index ) {
						  
						  $(this).removeClass('error');
							
							
						});
						
						$hideShow.fadeOut(2000, function(){
							
							$(this).css({'visibility':'hidden'});
							
						});	
						
					   $('input.cust_cont_dupe').css({'visibility':'hidden'}).prop("disabled", true); 
					
					   $('input.cc_dupe').css({'visibility':'visible'}).prop("disabled", false);
			
					
					}
					
					else
					
					{
						$type.prop("disabled", false);

						$hideShow.fadeIn(2000, function(){
							
							$(this).css({'visibility':'visible'});
							
						});	
						
					$('input.cust_cont_dupe').css({'visibility':'visible'}).prop("disabled", false);
					
					$('input.cc_dupe').css({'visibility':'hidden'}).prop("disabled", true);
						
					}
					
					
					
					if(label_text == 'Individual')
					
					{
						
						label_text = 'Customer';
					}
					
					var label = $('div.site_info label.cc_dupe span')
					
				
					
					label.text(label_text)
		
		return false;
	});
	
	
	
	 var cc_dupe = [
	
    	'input.cc_dupe',
    
     	'div.site_info div.cc_dupe input',
    
    	'div.contact-details input'
    
    	];
    	
     getData(cc_dupe);
	
	var cust_dupl = [
	
    		
    	'input.cust_cont_dupe',
    
     	'div.site_info div.cc_dupe input',
    
    	'div.customer-contact-info input'
    
    	];
    
   	
   	getData(cust_dupl); 
	
	
    
   var cont_array = [
	
    	'input.cust_dupe',
    
    	'div.customer-contact-info input',
    
    	'div.contact-details input'
    
    	];
    
    getData(cont_array);
    
    
    
    var cust_array = [
	
    	'input.comp_postal',
    
     	'div.site_info div.address input',
    
    	'div.company_info div.address input'
    
    	];
    
    getData(cust_array);
    
	
	});
	
	
$(document).on('click', '.siteEdit', function(e){
	
	e.preventDefault();
	
    var href = $(this).attr('href');
    
    
    
    $.get(href+'/'+true, function(data){
    	
    	
    	var obj = jQuery.parseJSON(data);
			
			$.each( obj, function( key, value ) {
							
				$('input[name="'+key+'"]').val(value);
							
					});		
					
			form_submit(href, false);
			
			
			
	});
	
	return false;
	
});

	
	
function getData(args)  {
	
	$(args[0]).change(function(event)  {	  
		       
	  if(this.checked) {	
	  	
		 	
		 $(args[2]).each(function(index) {
		   	
		   var data = $(this).val();
		   	
		   var name = $(this).attr('name');
		   		
		   return $(args[1]+'[name="'+name+'"]').val(data);	
		   
		   	});
		   
		  }
		  
		  else
		  
		  {
		  	
		  	$(args[1]).val('');
		  	
		  }	
		  	 
		 return false;
		 
		})
	
		}
