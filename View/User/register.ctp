<div class="index">
	<h2><?php echo __('User Registration'); ?></h2>
	
	<?php echo $this->Form->create($this->get('modelName')); ?>
	<?php 
		echo $this->Form->input('first_name', array());
		echo $this->Form->input('last_name', array());
		echo $this->Form->input('email', array('type' => 'email'));
		echo $this->Form->input('pass', array('type' => 'password'));
		echo $this->Form->input('pass2', array('type' => 'password'));
		echo $this->Form->submit(__('Register'), array('class' => 'btn btn-primary'));
	?>
	<?php echo $this->Form->end(); ?>
	
	<?php echo $this->Html->link(__('Goto login page'),
			array('action' => 'login')
	); ?>
</div>