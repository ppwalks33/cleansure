<!-- Main content -->
<section class="content">

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-home"></i> Welcome to Dashboard</h3>
    </div><!-- /.box-header -->
	<div class="box-body">
		<!-- Column 1 -->
    	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        	<h4>Getting started with Dashboard</h4>
         	<hr/>
         	<?php $this->load->view('clientarea/modules/dashboard-help-player.php') ?>
        </div>
        <!-- Column 1 END -->
       	<!-- Column 2 -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        	<h4>Select a 'How To' to learn more</h4>
         	<hr/>
         
		 	
         	<div class="row">
            	<!-- Column 2A -->
         		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
         
            		<!-- How to  -->
            		<div>
            			<img src="/help-topics/thumbnail.png" alt="thumbnail" class="helpPic" />
         				<a href="#">How to use the Customer section</a>
            		</div>
        			<hr/>
            		<!-- How to END -->
                    
         		</div>
             	<!-- Column 2A END -->
             	<!-- Column 2B -->
         		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
         
            		<!-- How to  -->
            		<div>
            			<img src="/help-topics/thumbnail.png" alt="thumbnail" class="helpPic" />
         				<a href="#">How to use the Customer section</a>
            		</div>
        			<hr/>
            		<!-- How to END -->
         		</div>
             <!-- Column 2B END -->
            </div>
         
         
  
       </div>
        <!-- Column 2 END -->
		
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        	<h4>Used on one of the section buttons below to get started</h4>
         	<hr/>
            <a href="/clientarea/customers/" class="btn btn-app" style="background:#cece1d; color:#FFF;"><i class="fa fa-briefcase"></i> <span>Customers</span></a>
            <a href="/clientarea/work_orders/" class="btn btn-app" style="background:#7d38af; color:#FFF;"><i class="fa fa-bullhorn"></i> <span>WO's</span></a>
            <a href="/clientarea/specifications/" class="btn btn-app" style="background:#de49ce; color:#FFF;"><i class='fa fa-tags'></i> <span>Specifications</span></a>
            <a href="/clientarea/machinery/" class="btn btn-app" style="background:#4fdec8; color:#FFF;"><i class='fa fa-cog'></i> <span>Machinery</span></a>
            <a href="/clientarea/stores/" class="btn btn-app" style="background:#e0862e; color:#FFF;"><i class='fa fa-bar-chart-o'></i> <span>Stores</span></a>
            <a href="/clientarea/suppliers/" class="btn btn-app" style="background:#5fbfde; color:#FFF;"><i class='fa fa-shopping-cart'></i> <span>Suppliers</span></a>
            
            <!-- MANAGE TEAM -->
            <a href="/clientarea/schedules/all/<?php echo date("Y"); ?>/<?php echo date("m"); ?>" class="btn btn-app" style="background:#6262da; color:#FFF;"><i class='fa fa-calendar-o'></i> <span>Schedules</span></a>
            <a href="/clientarea/staff/" class="btn btn-app" style="background:#d25050; color:#FFF;"><i class='fa fa-users'></i> <span>Work Force</span></a>
			<a href="/clientarea/subcontractors/" class="btn btn-app" style="background:#6dbe64; color:#FFF;"><i class='fa fa-link'></i> <span>Subcontractors</span></a>
			<a href="/clientarea/contact_book/" class="btn btn-app" style="background:#404040; color:#FFF;"><i class='fa fa-book'></i> <span>Contacts</span></a>
            
            <!-- ADMIN CONTROL -->
            <a href="/clientarea/accounts/" class="btn btn-app" style="background:#e67b7b; color:#FFF;"><i class='glyphicon glyphicon-user'></i> <span>User Accounts</span></a>
            
            <!-- Notifications -->
			<a href="/clientarea/messages/1" class="btn btn-app" style="background:#00A65A; color:#FFF;"><i class='fa fa-envelope'></i> <span>Emails</span></a>
            <a href="/clientarea/messages/1" class="btn btn-app" style="background:#F39C12; color:#FFF;"><i class='fa fa-bell'></i> <span>Notifications</span></a>
        </div>


	</div>
</div>




	
    
    
</section><!-- /.content -->	
		
		
		
		
		
		
		
		
		
		
		
	
		
		
		