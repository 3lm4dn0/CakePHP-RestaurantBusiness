<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('Project Head Title:', true); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		
		// Include jQuery library
		echo $this->Html->script(array('jquery.min.js', 'bootstrap.min'));

		// Include Bootstrap Twitter
		echo $this->Html->css(array('cake.generic', 'basic', 'bootstrap.min', 'bootstrap-responsive.min'));
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<?php echo $this->element('menu'); ?>
	</header>
	<nav></nav>
	<section>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->fetch('content'); ?>				
	</section>
	<aside></aside>
	<footer>
		<?php echo $this->element('footer'); ?>
	</footer>
	<?php echo $this->Js->writeBuffer(); // Write cached scripts ?>	
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>