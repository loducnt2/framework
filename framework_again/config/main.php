<?php
	
	return [
		'basePath' => '/www/framework_again/public',
		'rootDir'	=> dirname(__DIR__),
		'layout'	=> 'layouts/main',
		'session_name'	=> 'user',
		'token_name'	=> 'token',
		'db'		=> [
			'host'		=> '127.0.0.1',
			'port'		=> 3306,
			'user'		=> 'root',
			'password'	=> ''
		]
	];

	//require_once(dirname(__FILE__).'/../function/sanitize.php');
?>