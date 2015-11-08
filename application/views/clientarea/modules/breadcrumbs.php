<section class="content-header white-bg-border">
          <h1><?php echo (isset($welcome_message) ? $welcome_message:error_name($this->prefix)); ?></h1>
          <ol class="breadcrumb">
            <li><a href="/clientarea/">Dashboard</a></li>
            <li><a href="/clientarea/<?php echo $this->prefix; ?>"><?php echo error_name($this->prefix); ?></a></li>
            	<?php if(!empty($this->file_ext)) { ?>
            	<li><?php echo error_name($this->file_ext); ?></li>	
            <?php } ?>
          </ol>
        </section>