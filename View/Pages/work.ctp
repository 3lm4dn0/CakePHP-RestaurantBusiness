
<div class="hero-unit">
	<h2>
		<?php echo __('Work With Us')?>
	</h2>
	<p>
		<?php echo __('Work with us Description');?>
	</p>
	<p>
	
	
	<address>
		<?php echo __('email@contact');?>
	</address>
	<?php echo $this->Html->link(__('Contact Us'), 
			array('admin' => false, 'controller' => 'pages', 'action' => 'display', 'contact'),
			array('class' => 'btn btn-primary btn-large')
			) ?>
</div>
