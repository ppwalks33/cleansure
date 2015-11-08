<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dashboard - CleanSure</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<meta name="description" content="CleanSure Ltd">
    <meta name="author" content="CleanSure Ltd">
	<meta name="robots" content="noindex,nofollow"/> 
    <link rel="shortcut icon" href="/ico/favicon.ico">
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="/css/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    
    <link href="/css/skins/skin-cleansure.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-green sidebar-mini">
  <div class="topBrowserLine"></div>
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="/clientarea/" class="logo hidden-xs">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="/images/mini-logo.png" alt="" /></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="/images/logo.png" class="img-responsive" alt="" /></span>
        </a>
		
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			  
              <!-- Alert Messages Menu -->
			  <?php $this->load->view('clientarea/modules/alert-messages.php') ?>
			  <!-- /.Alert Messages Menu -->

              <!-- Alert Notifications Menu -->
			  <?php $this->load->view('clientarea/modules/alert-notifications.php') ?>
			  <!-- /.Alert Notifications Menu -->
              
              <!-- Alert Tasks Menu -->
			  <?php /* $this->load->view('clientarea/modules/alert-tasks.php') */ ?>
              <!-- /.Alert Tasks Menu -->
                    
			  
			  <!-- Logout -->
			  <li>
                    <a href="/clientarea/logout/">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
			  <!-- /.Logout -->
            </ul>
          </div>
        </nav>
      </header>
      
	  
	  <?php $this->load->view('clientarea/modules/menu.php')?>
	  

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <?php $this->load->view($this->clientarea.'breadcrumbs'); ?>

        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-lg-12">
				
				<!-- PAGE -->
				 <?php $this->load->view($page); ?>
				
				</div>
			</div>
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php $this->load->view('clientarea/modules/footer.php') ?>
      
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
      
      <?php $this->load->view('modules/model'); ?>
      
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
   <!--  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="/js/app.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/js/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
     <script>
    	
    	 var user_type = <?php echo $data->user_type; ?>;
    	 
    	 var user_id = <?php echo $data->user_id; ?>;
    
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
    
    // for compose mail
    $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
      });
    
    </script>
  </body>
</html>
