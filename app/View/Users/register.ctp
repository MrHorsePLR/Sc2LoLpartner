<div class='users form'>
	<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
		<?php
			echo $this->Form->input('username');
			echo $this->Form->input('email');
		?>
		<div class="required">
			<?php echo $this->Form->input('password1', array('type' => 'password','label' => 'Contraseña')); ?>
		</div>
		<div class="required">
			<?php echo $this->Form->input('password2', array('type' => 'password','label' => 'Confirmar contraseña')); ?>
		</div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
