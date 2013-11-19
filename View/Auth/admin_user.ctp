<div class="view backend auth">
	<h2><?php echo __('Current user')?></h2>
	<div class="actions">
		<ul class="actions">
			<li><?php echo $this->Html->link(__d('backend','Change Password'),
					array('plugin'=>'backend','controller'=>'backend_users','action'=>'passc','admin'=>true)
			); ?></li>
			<li><?php echo $this->Html->link(__d('backend','Logout'),
					array('plugin'=>'backend','controller'=>'auth','action'=>'logout','admin'=>true)
			); ?></li>
		</ul>
	</div>
	<dl>
		<?php 
		$fields = array('id','username', 'first_name','last_name','mail','last_login','published');
		foreach($fields as $field): ?>
		<dt><?php echo h(Inflector::humanize($field)); ?>&nbsp;</dt>
		<dd><?php echo $authUser[$field]; ?>&nbsp;</dd>
		<?php endforeach;?>
		
		<dt><?php echo __('Roles')?>&nbsp;</dt>
		<dd><?php 
		echo join(', ', Set::extract('/BackendUserRole/name',$authUser));
		?></dd>
	</dl>
	
	<?php debug($authUser); ?>
</div>