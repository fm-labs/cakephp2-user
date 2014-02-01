<?php $userModel = Configure::read('User.Auth.userModel'); ?>
<div class="view">
	<h2><?php echo __("Userdetails of %s %s", $user['first_name'], $user['last_name']); ?></h2>

	<dl>
		<dt><?php echo __('First Name'); ?>&nbsp;</dt>
		<dd><?php echo h($user['first_name']); ?></dd>
		<dt><?php echo __('Last Name'); ?>&nbsp;</dt>
		<dd><?php echo h($user['last_name']); ?></dd>
		<dt><?php echo __('Email'); ?>&nbsp;</dt>
		<dd><?php echo h($user['email']); ?></dd>
		<dt><?php echo __('Password'); ?>&nbsp;</dt>
		<dd><?php echo $this->Html->link(__('Change Password'), array('action' => 'password_change')); ?></dd>
	</dl>

	<?php debug($user); ?>
</div>