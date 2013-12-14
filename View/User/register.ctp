<div class="index">
	<h2><?php echo __('User Registration'); ?></h2>
	
	<?php echo $this->Form->create(Configure::read('User.Auth.userModel')); ?>
	<?php 
		echo $this->Form->input('first_name',array('default'=>'Tom'));
		echo $this->Form->input('last_name',array('default'=>'Jones'));
		echo $this->Form->input('email',array('default'=>'test@example.org'));
		echo $this->Form->input('pass',array('default'=>'testtest'));
		echo $this->Form->input('pass2',array('default'=>'testtest'));
		echo $this->Form->submit(__('Register'),array('class'=>'btn btn-primary'));
	?>
	<?php echo $this->Form->end(); ?>
	
	<?php echo $this->Html->link(__('Goto login page'), 
			array('action'=>'login')
	); ?>
</div>