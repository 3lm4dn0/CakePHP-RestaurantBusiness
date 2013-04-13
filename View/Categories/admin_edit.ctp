<div class="categories form">
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array(
			'autofocus' => true,
			'label' => __('Categorie Name')
			));
		echo $this->Form->input('parent_id');		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>