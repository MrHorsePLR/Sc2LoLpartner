<div class='users form'>
	<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo ('Register new user'); ?></legend>
		<?php
			echo $this->Form->input('username');
			echo $this->Form->input('email');
		?>
		<div class="required">
			<?php echo $this->Form->input('password1', array('type' => 'password','label' => 'Password')); ?>
		</div>
		<div class="required">
			<?php echo $this->Form->input('password2', array('type' => 'password','label' => 'Verify password')); ?>
		</div>
	</fieldset>
<?php echo $this->Form->end('Submit'); ?>
</div>
