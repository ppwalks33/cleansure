<?php /*echo sprintf($this->lang->line('brief_heading'), 'Machinery'); */ ?>



<div id="message">

		<?php if ($this->session->flashdata('warning')) 

			{
 		
		
 				echo "<div class=\"alert alert-warning\" role=\"alert\">
		 
		    		 <span class=\"glyphicon glyphicon-info-sign\"></span>".$this->session->flashdata('warning')."
		 			
		 			</div>";
			}

		?>

</div>

<?php echo form_open($_SERVER['REQUEST_URI'], array('role' => 'form', 'class' => 'customer_form', 'id' => 'machinery')); ?>

<div class="box box-primary">
	<div class="box-header with-border">
		 <h3 class="box-title">Add Machinery</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			
            <h4>Machinery Information</h4>
            <hr />
            
            <?php $atts = array(
		
	
			array('name' => 'identifier', 'class' => $class, 'placeholder' => 'Identifier...', 'value' => '', 'label' => 'Machinery Identifier'),
			
			
			array('name' => 'serial', 'class' => $class, 'placeholder' => 'Serial Number...', 'value' => '', 'label' => 'Serial Number'),
			
			array('name' => 'log_num', 'class' => $class, 'placeholder' => 'Log Number...', 'value' => '', 'label' => 'Log Number'),
			
			array('name' => 'type', 'class' => $class, 'placeholder' => 'Type of Machine...', 'value' => '', 'label' => 'Machinery Type'),
			
			array('name' => 'desc', 'class' => $class, 'placeholder' => 'Any Notes...', 'value' => '', 'rows' => '3', 'label' => 'Machinery Notes'),
			
			array('name' => 'age', 'class' => $class, 'placeholder' => 'Age When Aquired?', 'value' => '', 'label' => 'Age When Aquired'),
		
		);
		
		
		for($i=0;$i<6;$i++) 
		
		{
			if($i < 4)
			
			{
			  echo '<div class="form-group"><label>'.$atts[$i][label].'</label>';
			  echo form_input($atts[$i])."\n";
			  echo '</div>';
			  
			}
			
			elseif($i == 4)
			
			{
				echo '<div class="form-group"><label>'.$atts[$i][label].'</label>';	
				echo form_textarea($atts[$i])."<br>\n";
				echo '</div>';
			}
		}
		
		?>
		</div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <h4>Purchase Information</h4>
            <hr />
           <div class="form-group"> 
            <label>Date Aquired</label>
          <?php $this->load->view('modules/datepicker'); ?>
          </div>
            <?php
        	echo '<div class="form-group"><label>'.$atts[5][label].'</label>';	
        	echo form_input($atts[5])."<br>\n";
        	echo '</div>';
        ?>
        <div class="form-group">
        <label class="checkbox">
        	
          <?php 
          
          		echo form_hidden('second_hand', false);
			
				$data = array(
    						  'name'        => 'second_hand',
                              'value'       => true,
    						  'checked'     => false
     						  );
			
				echo form_checkbox($data)."&nbsp;Was the machinery purchased second hand?";
				
				?>

        </label>
        
        </div>
        <div class="form-group">
        
        <label class="checkbox">
        	
          <?php 
          
          	    echo form_hidden('appearance', false);
			
				$data = array(
    						  'name'        => 'appearance',
                              'value'       => true,
    						  'checked'     => false
     						  );
			
				echo form_checkbox($data)."&nbsp;Appearance Acceptable?";;
				
				?>
          
        </label>
        
        </div>
        
        
      
		</div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <h4>Safety Information</h4>
            <hr />
            <div class="form-group clickBoxAlign">
            <label class="checkbox">
        	
          <?php 
          
                echo form_hidden('pat_tested', false);
			
				$data = array('name'        => 'pat_tested', 
							  'id'          => 'pat_tested',                              
                              'value'       => true,                             
    						  'checked'     => false   						  
     						  );
			
				echo form_checkbox($data)."&nbsp;PAT Tested Yet?";
		?>
          
        </label>
        
        </div>
        <div class="form-group">
        <label>PAT Test Date</label>
        
         <?php $this->load->view('modules/datepicker'); ?>
        
        </div>		
       			
		</div>
    </div>
    <div class="box-footer">
    <button class="btn btn-success pull-right" type="submit"><span class="fa fa-plus"></span> Add Machinery</button>
    </div>
</div>



<?php echo form_close(); ?>
