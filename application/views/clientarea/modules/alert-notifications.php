
<?php  if($data->user_type <= 5) { ?>
<!-- Notifications Menu -->
<li class="dropdown notifications-menu hidden-xs">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell"></i>
                  <span class="label label-warning"><?php echo ($data->alertCount != false ? $data->alertCount:'0'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo ($data->alertCount != false ? $data->alertCount:'0'); ?> notifications</li>
                  
                  <li class="footer"><a href="/clientarea/alerts/">View all</a></li>
                </ul>
              </li><!-- /.Notifications Menu -->
              
<?php } ?>