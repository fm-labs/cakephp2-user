<div class="index">
	<h2>User Registration</h2>
	
	<?php echo $this->Form->create('User'); ?>
	<?php 
		echo $this->Form->input('User.first_name',array('default'=>'Tom'));
		echo $this->Form->input('User.last_name',array('default'=>'Jones'));
		echo $this->Form->input('UserLogin.username',array('default'=>'tomjones'));
		echo $this->Form->input('UserLogin.email',array('default'=>'test@example.org'));
		echo $this->Form->input('UserLogin.pass',array('default'=>'testtest'));
		echo $this->Form->input('UserLogin.pass2',array('default'=>'testtest'));
		echo $this->Form->submit(__('Register'),array('class'=>'btn btn-primary'));
	?>
	<?php echo $this->Form->end(); ?>
	
	<?php echo $this->Html->link(__('Goto login page'), 
			array('action'=>'login'),
			array('class'=>'btn')); 
	?>
</div>