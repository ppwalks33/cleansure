<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CleanSure Ltd">
    <meta name="author" content="CleanSure Ltd">
	<meta name="robots" content="noindex,nofollow"/> 
    <link rel="shortcut icon" href="/ico/favicon.ico">
    <title>Login - CleanSure</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/AdminLTE.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">
   
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body>
<div class="topBrowserLine"></div>
	<video autoplay loop poster="/video/video.jpg" id="bgvid">
		<!-- <source src="/video/000012015465_HDHTML5Video.mp4" type="video/webm"> -->
		<source src="/video/000012015465_HDHTML5Video.mp4" type="video/mp4">
	</video>
    <div class="container">
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xs-offset-1 col-sm-offset-3 col-md-offset-0 col-lg-offset-0">
				<div class="logoContainer"><a href="/"><img src="/images/logo.png" class="loginLogoImg" alt="" /></a></div>
				
			</div>
		</div>
		
		<div class="row topPad">
			<div class="col-xs-10 col-sm-6 col-md-4 col-lg-4 col-xs-offset-1 col-sm-offset-3 col-md-offset-4 col-lg-offset-4">
				<?php echo form_open('/clientarea/login/', array('role' => 'form'));  ?>	
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Login</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						
				
						<?php 

			
			if ($this->session->flashdata('message')) 
      
      {
 	
		 echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
		 
					
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
					<strong>Error!</strong> " .$this->session->flashdata('message').
		 			
				"</div>"; 
	     
	         echo $this->session->flashdata('message');
	  }
			echo '<div class="form-group"><label for="username">UserName</label>';
			echo form_input($username);
			echo '</div>';
			echo '<div class="form-group"><label for="password">UserName</label>';
			echo form_input($password);
			echo '</div>';
      		
      		
      	?>
        
        <label class="checkbox">
        	
          <input type="checkbox" value="remember-me">&nbsp;Remember Me?
          
        </label>
        
    		<button class="btn btn-lg btn-primary btn-success btn-block" type="submit">Login</button>
    		

					</div><!-- /.box-body -->
					<div class="box-footer">
					<p>
        	
        	<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;&nbsp;<a href="/nimda/reset-password.php">Forgotten Password?</a>
        	
        </p>
					</div><!-- box-footer -->
				</div><!-- /.box -->
			<?php echo form_close(); ?>	
			</div>
		</div>


    </div>
	
	
<?php /* $this->load->view('modules/footer'); */ ?>

<footer class="footer hidden-xs">
      <div class="container">
		<class="row">
			<div class="col-md-12"><p class="login-footer text-center">Copyright <span class="glyphicon glyphicon-copyright-mark"></span> <?php echo date("Y"); ?>. <a href="http://www.cleansure.com/" title="CleanSure Ltd">CleanSure Ltd</a>. All Rights Reserved.</p></div>
		</div>
      </div>
 </footer>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/js/ie10-viewport-bug-workaround.js"></script>	
  </body>
</html>