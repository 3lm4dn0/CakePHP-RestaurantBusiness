<div class="categories form">
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Category'); ?></legend>
	<?php
		echo $this->Form->input('name', array(
			'autofocus' => true,
			'label' => __('Categorie Name')
			));
		echo $this->Form->input('parent_id', array(
			'empty' => __('Select Category Parent'),
			'options' => $parents,
			));		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>