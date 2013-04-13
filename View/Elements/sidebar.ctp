<?php

/**
 * Return class activate if user select category_id
 * @param array $params
 * @param int $id
 * @return string return class="activate"
 */
function isActivate($params, $id)
{	
	if( isset($params['named']['Search.category_id'])
			&&
		($params['named']['Search.category_id'] == $id)
	){
		return 'class="active"';
	}	
	
	return '';
}
?>
<?php if(isset($sidebar_list)):?>
<div class="row-fluid">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header"><?php __('Categories'); ?></li>
			<?php 
			foreach($sidebar_list as $id => $value): ?>
			
				<li <?=isActivate($this->params, $id)?>>
					<?php 
						echo $this->Html->link($value, 
							array('controller' => 'services', 'action' => 'index', 'Search.category_id' => $id)
						);
					?>
				</li>
				
			<?php endforeach;?>			
		</ul>
	</div>
</div>
<?php endif;?>