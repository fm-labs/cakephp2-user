<div class="index" id="users_login">
	<?php echo $this->Session->flash('auth'); ?>
	<?php if ($this->get('redirect')):?>
	<div class="login-redirect">
		<?php echo $this->Html->link($this->get('redirect')); ?>
	</div>
	<?php endif; ?>
	<div id="login_form">
		<?php echo $this->Form->create('User.UserLogin'); ?>
		<fieldset>
			<legend><?php echo __("Login");?></legend>
			<div class="row-fluid">
				<div class="span6">
				<?php echo $this->Form->input('username');	?>
				</div>
				<div class="span6">
				<?php echo $this->Form->input('password');	?>
				</div>
			</div>
			<?php
			echo $this->Form->button(__("Login"),array('class'=>'btn btn-primary btn-success'));
			?>
			<?php 
			echo $this->Html->link(__('Register'), array('action'=>'register'),array('class'=>'btn'));
			?>
		</fieldset>
		<?php echo $this->Form->end(); ?>
		
		<div class="auth_info" style="font-size: 80%; color: #CCC; margin-top: 30px;">
			<?php echo date('d.M.Y H:i:s'); ?> |
			<?php echo $this->request->clientIp(); ?><br />
			<?php echo env('HTTP_USER_AGENT') ?> 
		</div>
	</div>
	<?php debug($this->Session->read());?>
</div>