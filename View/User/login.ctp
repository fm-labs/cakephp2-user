<div class="index" id="users_login">
	<?php echo $this->Session->flash('auth'); ?>
	<div id="login_form">
		<?php echo $this->Form->create(Configure::read('User.Auth.userModel')); ?>
		<fieldset>
			<legend><?php echo __("Login");?></legend>
			<div class="row-fluid">
				<div class="span6">
				<?php echo $this->Form->input('email');	?>
				</div>
				<div class="span6">
				<?php echo $this->Form->input('password');	?>
				</div>
			</div>
			<?php
			echo $this->Form->button(__("Login"), array('class' => 'btn btn-primary btn-success'));
			?>
			<?php 
			echo $this->Html->link(__('Register'), array('action' => 'register'), array('class' => 'btn'));
			?>
		</fieldset>
		<?php echo $this->Form->end(); ?>
		
		<div class="auth_info" style="font-size: 80%; color: #CCC; margin-top: 30px;">
			<?php echo date('d.M.Y H:i:s'); ?> |
			<?php echo $this->request->clientIp(); ?><br />
			<?php echo env('HTTP_USER_AGENT') ?> 
		</div>
	</div>

	<?php if (Configure::read('debug') > 0): ?>
	<pre>You can modify this page by creating a file in

		/app/Views/Plugin/User/View/User/login.ctp<br />
	</pre>
	<?php endif; ?>
	<?php debug($this->Session->read());?>
</div>