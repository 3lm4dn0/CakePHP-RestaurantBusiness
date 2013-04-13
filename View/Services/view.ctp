<ul class="breadcrumb">
  <li><?php echo $this->Html->Link(__('Home'),
  		 array('controller' => 'pages', 'action' => 'display', 'home')); ?>  <span class="divider">/</span></li>
  
  <li><?php echo $this->Html->Link(__('Services'),
  		 array('action' => 'index')); ?> 
  		 <span class="divider">/</span>
  </li>
  		 
  <li><?php echo $this->Html->Link($service['Category']['name'],
  		 array('action' => 'index', 'Search.category_id' => $service['Service']['category_id'])); ?> 
  		 <span class="divider">/</span>
  </li>
  		 
</ul>

<div class="hero-unit">
	<h2>
		<?php  echo $service['Service']['name']; ?>
	</h2>

	<h4>
		<?php  echo $service['Category']['name']; ?>
	</h4>

	<p>
		<?php echo $this->Text->autoLink($service['Service']['description'], array('escape' => false)); ?>
	
	
	<p>

</div>