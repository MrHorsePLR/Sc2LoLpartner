<div class="requests view">
<h2><?php echo __('Request'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($request['Request']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Profile'); ?></dt>
		<dd>
			<?php echo $this->Html->link($request['Profile']['title'], array('controller' => 'profiles', 'action' => 'view', $request['Profile']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($request['Request']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($request['Request']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($request['Request']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($request['Request']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Request'), array('action' => 'edit', $request['Request']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Request'), array('action' => 'delete', $request['Request']['id']), array(), __('Are you sure you want to delete # %s?', $request['Request']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Requests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
	</ul>
</div>
