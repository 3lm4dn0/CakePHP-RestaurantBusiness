<?php

function _isAdmin($params)
{
	$array_list = array('users',
			'saves',
			'characters',
			'keywords'
			);
			
	if(
			isset($params['admin']) &&
			in_array($params['controller'], $array_list)
	){
		return 'active';
	}

	return '';
}

function _isManager($params)
{
	$array_list = array('binary_files',
			'binary_texts',
			'fixed_texts',
			'attachments',
			'reviews'
			);
	
	if(
			isset($params['admin']) &&
			in_array($params['controller'], $array_list)
	){
		return 'active';
	}
	
	return '';	
}

?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
        <div class="container">

			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>          
		 	<?php echo $this->Html->link(
		 			__('Home Page Title', true), 
		 			array('admin' => false, 'plugin' => false, 'controller' => 'pages', 'action' => 'display', 'home'),
		 			array('class' => 'brand')); 
		 	?>
	
			<div class="nav-collapse collapse">
			
				<ul class="nav">
				
					<li>			
					<?php echo $this->Html->link(
							__('Who we are'),
							array('admin' => false, 'plugin' => false, 'controller' => 'pages', 'action' => 'display', 'whoweare'));
					?>
					</li>
			
					<li>
						<?php echo $this->Html->link(
								__('The Team'),
								array('admin' => false, 'plugin' => false, 'controller' => 'pages', 'action' => 'display', 'theteam'));
						?>
					</li>				
	
					<li>
						<?php echo $this->Html->link(
								__('Services'),
								array('admin' => false, 'plugin' => false, 'controller' => 'services', 'action' => 'index'));
						?>
					</li>								
					
					<li>
						<?php echo $this->Html->link(
								__('FAQ'),
								array('admin' => false, 'plugin' => false, 'controller' => 'faqs', 'action' => 'index'));
						?>
					</li>		
					
					<li>
					<?php echo $this->Form->create(null, 
							array(
								'div' => false,
								'class' => 'form-search navbar-form pull-right',
								'url' => array('controller' => 'services', 'action' => 'search')));
					?>			
					<div class="input-append">
						<?php 
						echo $this->Form->input(
										'Search.service', 
										array('label' => false, 				
												'div' => false,
												'type' => 'text',
												'class' => 'span2 search-query', 
												'placeholder' => __('Search'),
												'maxlength' => 50));
						?>	
						<?php echo $this->Form->submit(__('Search'), array('div' => false, 'class' => 'btn')); ?>
						<?php echo $this->Form->end();?>						
					</div>
					</li>					
					
				<?php $id = $this->Session->read('Auth.User.id');?>
				<?php if($id): ?>
					<?php $role_id = $this->Session->read('Auth.User.role_id');?>
										
					<?php /* Manager Menu */?>
					<?php if($role_id <= 2):?>	
					<li class="dropdown <?=_isManager($this->params);?>">
					
						<?php echo $this->Html->link(
									__('Manage')."<b class='caret'></b>",
									'#', 
									array('escape' => false, 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')
								);
							?>
						<ul class="dropdown-menu">
						
							<li>
								<?php echo $this->Html->link(
										__('Manage Categories'),
										array('admin' => true, 'plugin' => false, 'controller' => 'categories', 'action' => 'index'));
								?>
							</li>
							
							<li>
								<?php echo $this->Html->link(
										__('Manage Services'),
										array('admin' => true, 'plugin' => false, 'controller' => 'services', 'action' => 'index'));
								?>
							</li>																			

							<?php /* Admin Menu */?>
							<?php if($role_id == 1):?>					
									<li>
										<?php echo $this->Html->link(
												__('Admin Users'),
												array('admin' => true, 'plugin' => false, 'controller' => 'users', 'action' => 'index'));
										?>
									</li>		
									
									<li>
										<?php echo $this->Html->link(
												__('Admin FAQ'),
												array('admin' => true, 'plugin' => false, 'controller' => 'faqs', 'action' => 'index'));
										?>
									</li>
							<?php endif;?>
						
						</ul>		
					</li>
					<?php endif;?>				
					
					
					<?php /* User Menu */?>
					<li class="dropdown">
								
						<?php echo $this->Html->link(
								$this->Session->read('Auth.User.username')."<b class='caret'></b>",
								'#',
								array('escape' => false, 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
						?>		
						<ul class="dropdown-menu">
							<li>
								<?php echo $this->Html->link(
										__('Change Password'),
										array('admin' => false, 'plugin' => false, 'controller' => 'users', 'action' => 'changePassword'));
								?>
							</li>
						</ul>
					</li>
										
					<li class="user-menu">
						<?php echo $this->Html->link(
								__('Logout'),
								array('admin' => false, 'plugin' => false, 'controller' => 'users', 'action' => 'logout'));
						?>
					</li>					
				<?php else: ?>
					<li>
						<?php echo $this->Html->link(
								__('Sign out'),
								array('admin' => false, 'plugin' => false, 'controller' => 'users', 'action' => 'register'));
						?>		
					</li>
				
					<li>
						<?php echo $this->Html->link(
								__('Sign in'),
								array('admin' => false, 'plugin' => false, 'controller' => 'users', 'action' => 'login'));
						?>		
					</li>
				<?php endif;?>
				</ul>
			</div>	
		</div>
	</div>
</div>