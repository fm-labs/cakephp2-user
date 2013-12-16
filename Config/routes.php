<?php
Router::connect('/users/login',
	array('plugin' => 'user', 'controller' => 'user', 'action' => 'login'));
Router::connect('/users/logout',
	array('plugin' => 'user', 'controller' => 'user', 'action' => 'logout'));