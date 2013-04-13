<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username', array(
				'label' => __('Username'), 
				'disabled' => true));
		
		echo $this->Form->input('email', array(
				'label' => __('Email'),
				'placeholder' => __('Email'),
		));				
		
		echo $this->Form->input('repeat_email', array(
				'label' => __('Repeat Email'),
				'placeholder' => __('Repeat Email'),
		));
		
		echo $this->Form->input('first_name', array(
				'label' => __('First Name'),
				'placeholder' => __('First Name'),
		));
		
		echo $this->Form->input('last_name', array(
				'label' => __('Last Name'),
				'placeholder' => __('Last Name'),
		));		
						
		echo $this->Form->input('role_id', array(
				'type'=>'select', 
				'label'=>__('Role'),
				'autofocus' => true,		 
				'options'=> $roles, 
				'selected'=> $this->data['User']['role_id']
				));
				
		echo $this->Form->input('active', array(
				'label' => __('Active')
				));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>