<div class="box box-green">
	<div class="box-header no-border">
    	<h3 class="box-title">Our Suppliers </h3>
         <div class='box-tools'>
          	<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
          </div>
    </div>
    <div class="box-body no-padding">
    	<ul class="nav nav-pills nav-stacked mailMenu">
					
                    
                    <!-- Rememeber to change the active state to show which section your in -->
                    <li class="active">
                    	<a href="/clientarea/stores/stock/">
                    		<i class="fa fa-bar-chart-o"></i> View All
                    		
                    	</a>
                    </li>
                        
<?php 

		if(isset($suppliers))
				
				{
					
					sort($suppliers);
					
					foreach($suppliers as $s)
					
					{
					
					echo "<li>"
					
					.anchor('/clientarea/stores/sort_by/1/'.$s[1], '<i class="fa fa-shopping-cart"></i> '.ucwords($s[0]).'<span class="label label-success pull-right">3</span>', array('class' => '', 'title' => 'View All Products By '.ucwords($s[0])))."\n
					        
					       
							</li>";
							
					}
				}
				
			
				

				
?>

                  
                    </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->






<?php 
/*

		echo sprintf($this->lang->line('h4'), 'Our Suppliers'); 
		
		
		
				
		if(isset($suppliers))
				
				{
					
					sort($suppliers);
					
					foreach($suppliers as $s)
					
					{
					
					echo ""
					
					.anchor('/clientarea/stores/sort_by/1/'.$s[1], '<span class="fa fa-shopping-cart"></span>&nbsp;'.ucwords($s[0]), array('class' => 'btn btn-success btn-sm bottomPadBtn btn-block', 'title' => 'View All Products By '.ucwords($s[0])))."\n
					        
					       
							";
							
					}
				}
				
			
				
				echo anchor('clientarea/stores/stock/', 'View All', array('class' => 'btn btn-default', 'title' => 'View All Products', 'style' => 'width:100%;'));
*/				
?>
				