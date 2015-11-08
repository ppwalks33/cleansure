$(document).ready(function(){
	
	$('ul.pagination li a ').click(function() {
		
		var target = $(this).attr('href');
		
		var args = target.split('/');
		
		var $anchor = $(this);
		
		var $li = $('ul.pagination li');
		
		var $active = $('ul.pagination li.active');
		
		var count = $li.length;
		
		if(target != '#')
		
		{
			
		
		$.get(target, function(data) 
		
		{
			
			var $tbl = $('table#'+args[6]);
			
			$tbl.fadeOut(1000);
			
			$li.each(function(key, index)
			{
				
				if(key == 1)
				
				{
					
					$(this).find('a').attr('href', target.slice(0,-1)).removeClass('disabled');
				}
				
				
				
				$(this).removeClass('active');
				
				
				
				console.log($active.index());
				
				
				
			});
			
			$anchor.parent().addClass('active');
			
			$tbl.parent().hide().html(data).fadeIn(1000);
			
			switch($active.index()) {
				
				case 1:
				
				pagerClass($li, 'disabled');
				
				break;
				
			}
			
			
		})
		
		}
		
		return false;
		
	});
     
 	
 	});
 	
 	function pagerClass(target, c)
 	
 	{
 		
 		target.each(function(index, key) {
 			
 			$(this).removeClass(c);
 		})
 	}
 	

