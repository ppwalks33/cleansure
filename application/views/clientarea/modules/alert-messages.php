<li class="dropdown messages-menu hidden-xs internal_messages">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope"></i>
                  <span class="label label-success messageCount"><?php echo ($data->messageCount != false ? $data->messageCount:'0') ?></span>
                </a>
                <ul class="dropdown-menu">
                	
                  <li class="header"><?php echo ($data->messageCount != false ? 'You have <span class="messageCount">'.$data->messageCount.'</span> messages':'0 Messages') ?> </li>
                 
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <!--- We append here with jquery... -->
                    </ul><!-- /.menu -->
                  </li>
                  <li class="footer"><?php echo anchor('clientarea/messages/'.$this->data['data']->user_id, 
    	  
    	  					'See All Messages',   	  					
    	  					
    	  					array('title' => 'See All Message')
							
							);  ?></li>
                </ul>
              </li>