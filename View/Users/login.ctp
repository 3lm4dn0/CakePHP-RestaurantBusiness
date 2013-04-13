<div class="login">
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php 
        	echo $this->Form->input('User.username', array(
        			'label' => __('Username'),
        			'placeholder' => __('Username'),
        			'class' => 'input-xxlarge',
        			'autofocus' => true)        			
        	);
        	echo $this->Form->input('User.password', array(
					'label' => __('Password'), 
					'class' => 'input-xxlarge',
					'placeholder' => __('Password')));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>