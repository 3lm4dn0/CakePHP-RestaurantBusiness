<div class="container-fluid">
	<div class="row-fluid">
		<div class="span3">
			<?php echo $this->element('sidebar');?>
		</div>
		<div class="span9">
			<h2>
				<?php echo __('Services'); ?>
			</h2>
			<table class="table table-hover">
				<tr>
					<th width="20%"><?php echo $this->Paginator->sort('Category', __('Category')); ?>
					</th>
					<th width="20%"><?php echo $this->Paginator->sort('name', __('Service')); ?>
					</th>
					<th />
					<th width="20%" class="actions"></th>
				</tr>
				<?php foreach ($services as $service): ?>
				<tr>
					<td><?php echo $this->Html->link($service['Category']['name'], array('action' => 'index', 'Search.category_id' => $service['Category']['id'])); ?>
					</td>
					<td><?php echo h($service['Service']['name']); ?></td>
					<td><?php echo h($service['Service']['intro']); ?></td>
					<td class="actions"><?php echo $this->Html->link(__('View'), array('action' => 'view', $service['Service']['id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<p>
				<?php
				echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}')
	));
	?>
			</p>
			<div class="paging">
				<?php
				echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
				echo $this->Paginator->numbers(array('separator' => ''));
				echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
			</div>
		</div>
	</div>
</div>
