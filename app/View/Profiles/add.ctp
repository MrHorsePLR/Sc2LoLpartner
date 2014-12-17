<div class="profiles form">
	
<?php echo $this->Form->create('Profile'); ?>
		echo $javascript->link('prototype', false);
	<fieldset>
		<legend><?php echo __('Add Profile'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('url');
		echo $this->Form->input('game_id', array(
   			'label' => __('Game', true),
   			'empty' => __('select a game', true)));
		
		if(isset($league)){
		echo $this->Form->input('league_id', array(
   			'label' => __('League', true),
   			'empty' => __('No', true),
   			'div' => array(
       		'id' => 'PostSeriesDiv')
   		));
		}
		echo $ajax->observeField('GameLeagueId', array(
  			 	'frequency' => '1',
   				'update' => 'GameLeagueDiv',
   				'url' => array(
       				Configure::read('Routing.admin') => false,
       				'controller' => 'league',
       				'action' => 'lists')
	  			));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Games'), array('controller' => 'games', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Game'), array('controller' => 'games', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requests'), array('controller' => 'requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
