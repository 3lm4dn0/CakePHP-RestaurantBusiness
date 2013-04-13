<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<?php echo $this->Html->script('ckeditor/config'); ?>
<?php echo $this->Html->css('/js/ckeditor/contents.css'); ?>
<div class="services form">
<?php echo $this->Form->create('Service'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Service'); ?></legend>
	<?php
		echo $this->Form->input('id');

		$validated_label = $this->Html->tag('span', __('Validated'), array('class' => 'label_checkbox', 'title' => __('Edit Title Validated')));
		echo $this->Form->input('validated', array('label' => $validated_label));

		echo $this->Form->input('name', array(
				'type' => 'text',
				'autofocus' => true,
				'class' => 'input-xxlarge',			
				'label' => __('Service Name')
				));

		echo $this->Form->input('intro', array(
				'type' => 'textarea',
				'class' => 'input-xxlarge',
				'label' => __('Service Intro')
		));

		echo $this->Form->input('category_id');

		echo $this->Form->input('description', 
array('type' => 'textarea', 'class' => 'ckeditor', 'label' => __('Description')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>