<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('username', __('Username')); ?></th>			
			<th><?php echo $this->Paginator->sort('Role.name', __('Role')); ?></th>			
			<th><?php echo $this->Paginator->sort('last_login', __('Last Login')); ?></th>
			<th><?php echo $this->Paginator->sort('created', __('Created')); ?></th>
			<th><?php echo $this->Paginator->sort('modified', __('Modified')); ?></th>
			<th><?php echo $this->Paginator->sort('active', __('Active')); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['username']); ?></td>		
		<td><?php echo h($user['Role']['name']); ?></td>
		<td><?php echo $this->Time->format('d/m/Y H:i', $user['User']['last_login']); ?></td>		
		<td><?php echo $this->Time->format('d/m/Y H:i', $user['User']['created']); ?></td>
		<td><?php echo $this->Time->format('d/m/Y H:i', $user['User']['modified']); ?></td>		
		<td><?php echo ($user['User']['active'] ? $this->Html->image('test-pass-icon.png', array('alt' => __('Yes', true))) : $this->Html->image('test-fail-icon.png', array('alt' => __('No', true)))); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Reset Password'), array('action' => 'changePassword', $user['User']['id'])); ?>			
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Delete %s?', $user['User']['username'])); ?>
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
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
	</ul>
</div>