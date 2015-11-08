
<section class="content">
          <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
            	
              <!-- Compose email Button -->	
              <a href="#" class="btn btn-success btn-block margin-bottom"><i class="fa fa-plus"></i> Compose</a>
              
          
              <!-- Side Bar Message Menu -->
              <div class="box box-green">
                <div class="box-header no-border">
                  <h3 class="box-title">Folders</h3>
                  <div class='box-tools'>
                    <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked mailMenu">
                  	
                  	
                  	<!-- Rememeber to change the active state to show which section your in -->
                    <li class="active">
                    	<a href="#">
                    		<i class="fa fa-inbox"></i> Inbox
                    		<!-- Only show if user has new mail --> 
                    		<span class="label label-success pull-right">3</span>
                    	</a>
                    </li>
                    <li>
                    	<a href="#">
                    		<i class="fa fa-envelope-o"></i> Sent
                    		</a>
                    </li>
                    
                    <?php
                    /* ----------------------- */
                    /* For latest developments */
                    /* ----------------------- */
                    /*
                    <li>
                    	<a href="#">
                    		<i class="fa fa-file-text-o"></i> Drafts
                    	</a>
                    </li>
                    <li>
                    	<a href="#">
                    		<i class="fa fa-filter"></i> Junk 
                    		<!-- Only show if user has spasm --> 
                    		<span class="label label-warning pull-right">65</span>
                    	</a>
                    </li>
					 */
					 ?>
                    	
					 
                    <li>
					 <a href="#">
                    		<i class="fa fa-trash-o"></i> Trash
                    		<!-- Only show if their are items in trash -->  
                    		<span class="label label-danger pull-right">12</span>
                    	</a>
                    </li>
                    
                    
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              <!-- /. Side Bar Message Menu -->
              
              
            
            </div><!-- /.col -->
            
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
            	
            	
             	<!-- Compose Message -->
            	<?php  $this->load->view('clientarea/messages/modules/compose_message.php');  ?>
            	
            	<!-- Message Table -->
            	<?php  $this->load->view('clientarea/messages/modules/messages_table.php');   ?>
            	
            </div><!-- /.col -->
            
            
          </div><!-- /.row -->
        </section><!-- /.content -->


