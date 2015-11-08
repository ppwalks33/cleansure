<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
    <title>Dashboard - CleanSure</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="/css/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/redactor.css" rel="stylesheet">
    <link href="/css/dev.css" rel="stylesheet">
    <link href="/css/stylesheet.css" rel="stylesheet">
	<link href="/css/AdminLTE.css" rel="stylesheet">
    <?php
    if(in_array('datepicker', $this->js))
	
	{
		
		echo "<link href=\"/css/datepicker.css\" rel=\"stylesheet\">\n";
	}
	
	elseif(in_array('lightbox', $this->js))
	
	{
		
		echo "<link href=\"/css/lightbox.css\" rel=\"stylesheet\">\n";
		
	}
	
	?>
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    
   
    
  </head>
   <body>

    <?php $this->load->view('clientarea/modules/menu.php')?>

    <div class="container-fluid">
    	
      <div class="row">
      	
        <?php $this->load->view('clientarea/modules/sidebar.php')?>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	
          
          <div class="row">
          	
              <?php $this->load->view('clientarea/modules/header.php')?>
              
          </div>
            
          <br>
          
          <br>
          
          <?php $this->load->view($page); ?>
          
          
          <?php $this->load->view('clientarea/modules/footer.php') ?>

          
          
        </div>
        
      </div>
      
      <?php $this->load->view('/modules/model').'\n'; ?>
      
    </div>
    
    <script>
    	
    	 var user_type = <?php echo $data->user_type; ?>;
    
       <?php echo (isset($data->$prefix) ? 'var permission ='.$data->$prefix:'var permission = "";'); ?>;
    	
    </script>

    <?php echo $js; ?>
    
    <script type="text/javascript">
	
    
    $(document).ready(function(){
    	
      $('.popup').popover({trigger: 'hover','html':true})
       
       		 .click(function() {
        
        	$(this).popover('toggle');
        
      });
      
      <?php 
      
      	if($this->prefix == 'stores'): 
      	
			if($clear_temp == true) {
      	
      	?>
      
      $(document).ready(function(){
      	
      	clear_temp_table();	
      	
      });
      
      $(window).bind('beforeunload', function() {
		
		
		 	clear_temp_table();
	
		});
		
		function clear_temp_table()
		
		{
			
			$.get('/clientarea/stores/temp_stock/', function(data)
		 
				 {
		 	
		 			return true;
		 	
		 		})
		}
    	
    	<?php 

			}

 			endif; ?>
    	
    });
    
    </script>
    
     <script type="text/javascript">
    	
    	
	
    </script>
    
  </body>
</html>
