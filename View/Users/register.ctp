<div class="login">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
		<div class="control-group">
	<?php		
		echo $this->Form->input('username', array(
				'label' => __('Username'),
				'placeholder' => __('Username'),
				'class' => 'input-xxlarge',
				'autofocus' => true
		));	
	?>
		</div>
		<div class="control-group">		
	<?php 
		echo $this->Form->input('password', array(
				'label' => __('Password'),
				'placeholder' => __('Password'),
				'class' => 'input-xxlarge',
				));
		
		echo $this->Form->input('repit_password', array(
				'type'=>'password',
				'label'=>__('Repit Password'),
				'placeholder' => __('Repit Password'),
				'class' => 'input-xxlarge'
				));
	?>
		</div>
		
		<div class="control-group">
	<?php 
		echo $this->Form->input('email', array(
				'label' => __('Email'),
				'class' => 'input-xxlarge',
				'placeholder' => __('Email'),
		));		
		

		echo $this->Form->input('repeat_email', array(
				'label' => __('Repeat Email'),
				'class' => 'input-xxlarge',
				'placeholder' => __('Repeat Email'),
		));
		
	?>
		</div>
		<div class="control-group">		
	<?php 
		echo $this->Form->input('first_name', array(
				'label' => __('First Name'),
				'class' => 'input-xxlarge',
				'placeholder' => __('First Name'),
		));
				
		echo $this->Form->input('last_name', array(
				'label' => __('Last Name'),
				'class' => 'input-xxlarge',
				'placeholder' => __('Last Name'),
		));
	?>
		</div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>