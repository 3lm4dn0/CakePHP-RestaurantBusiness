<div class="login">
	<?php echo $this->Form->create('Contact', array(
		'div' => false, 'url' => array('action' => 'display', 'contact'))); ?>
	<fieldset>

		<legend>
			<?php echo __('Contact')?>
		</legend>

		<div class="control-group">
			<?php echo $this->Form->text('Contact.name', array(
					'class' => 'form-horizontal',
					'div' => false,
					'lable' => __('Name'),
					'placeholder' => __('Name'),
					'class' => 'input-xxlarge',
					'autofocus' => true,
			))?>
		</div>

		<div class="control-group">
			<?php echo $this->Form->text('Contact.email', array(
					'div' => false,
					'lable' => __('Email'),
					'placeholder' => __('Email'),
					'class' => 'input-xxlarge'
			))?>
		</div>

		<div class="control-group">
			<?php echo $this->Form->textarea('Contact.message', array(
					'div' => false,
					'lable' => __('Message'),
					'placeholder' => __('Message'),
					'class' => 'input-xxlarge',
					'rows' => '5'))?>
		</div>

		<div class="control-group">
			<?php echo $this->Form->submit('Send email', array('div' => false, 'class' => 'btn'))?>
		</div>

		<?php echo $this->Form->end();?>
	</fieldset>
</div>
