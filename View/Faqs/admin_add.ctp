<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<?php echo $this->Html->script('ckeditor/config'); ?>
<?php echo $this->Html->css('/js/ckeditor/contents.css'); ?>
<div class="faqs form">
<?php echo $this->Form->create('Faq'); ?>
	<fieldset>
		<legend><?php echo __('Add Faq'); ?></legend>
	<?php
		echo $this->Form->input('order', array('label' => __('Order')));	
		echo $this->Form->input('question', array('label' => __('Question')));
		echo $this->Form->input('answer', array('type' => 'textarea', 'class' => 'ckeditor', 'label' => 'Answer'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>