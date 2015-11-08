
<?php
	
	echo "<div class=\"row\">\n<div class=\"col-xs-12 col-lg-8\">\n";
	
	echo sprintf($this->lang->line('envelope_heading'), $mess->message_title);
	
	
	echo "<br>\n";
	
	echo $mess->message."\n";
	
	echo "<hr>\n";
	
	echo "<span> <strong>Sent</strong>&nbsp;".format_date($mess->date)."&nbsp;&nbsp;&nbsp;".(isset($mess->inbox) ? "<strong>From:</strong>&nbsp;".$mess->first_name."&nbsp;".$mess->last_name:NULL)."</span>\n<br>\n<br>\n";
	
	
	if(isset($mess->inbox))
	
	{
	
	echo sprintf($this->lang->line('h4'), 'Reply To '.$mess->first_name."&nbsp;".$mess->last_name)."\n";
	
	
		echo form_open('clientarea/messages/reply', array('class' => 'reply customer_form'));
		
		echo form_hidden('reciptent_id', $mess->sender);
		
		echo form_input(array('name' => 'title', 'class' => $class, 'placeholder' => 'Message Title...'));
		
		echo form_textarea(array('name' => 'message', 'class' => 'form-control wisy', 'id' => 'wisy', 'value' => 
		
					'<br><br><i>Reply To '.$mess->first_name."&nbsp;".$mess->last_name.'</i></p>
					
					<span><i>Date:'.date('l jS \of F Y h:i:s A').'</i></span>
					
					<hr>
					
					<br>'.$mess->message))."<br>\n";
					
		echo form_submit('', 'Send Reply', 'class="btn btn-default pull-right"');
		
		
		echo form_close();
		
	}
	
	echo "</div>\n<div class=\"col-xs-12 col-lg-4\">\n";
	
	echo "<ul class=\"nav nav-tabs\" role=\"tablist\">\n";
	
	$tabs = array('inbox', 'sent');
	
	for($i=0;$i<count($tabs);$i++)
	
	{
		
		echo " <li role=\"presentation\" class=\"".($i==0 ? "active":NULL)."\">\n";
		
		echo anchor('#'.$tabs[$i], ucwords($tabs[$i]), array('aria-controls' => $tabs[$i], 'role' => 'tab', 'data-toggle' => 'tab'));
		
		echo "</li>\n";
	}
	
	echo "</ul>\n";
	
	echo "<div class=\"tab-content\">\n";
	
	for($i=0;$i<count($tabs);$i++)
	
	{
		
		echo "<div role=\"tabpanel\" class=\"tab-pane ".($i==0 ? "active":NULL)."\" id=\"".$tabs[$i]."\">\n";
		
		
			
			
				$this->load->view($modules.'messages_table', array('messages' => $messageBox[$i]));
				
			
		
		
		echo  "</div>\n";
		
	}
	
	
	echo  "</div>\n";
	
	
	echo "</div>\n</div>\n";

?>

