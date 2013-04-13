<div class="services index">
	<h2><?php echo __('Services'); ?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('intro'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
             <th><?php echo $this->Paginator->sort('validated', 'Validated'); ?></th>			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($services as $service): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($service['Category']['name'], array('controller' => 'categories', 'action' => 'view', $service['Category']['id'])); ?>
		</td>
		<td><?php echo h($service['Service']['name']); ?></td>
		<td><?php echo h($service['Service']['intro']); ?></td>
		<td><?php echo $this->Text->autoLink($service['Service']['description'], array('escape' => false)); ?></td>		
		
		<td><?php echo ($service['Service']['validated'] ?
                                                $this->Html->image('test-pass-icon.png', array('alt' => __('Yes', true))) :
                                                $this->Html->image('test-fail-icon.png', array('alt' => __('No', true)))
                                        ); ?>
        </td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $service['Service']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $service['Service']['id']), null, __('Are you sure you want to delete # %s?', $service['Service']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Service'), array('action' => 'add')); ?></li>
	</ul>
</div>
