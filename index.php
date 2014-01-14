<?php

$f3=require('core/base.php');

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$f3->config('api/configs/config.ini');

$f3->route('GET /',
	function($f3) {
		$f3->set('content','index.htm');
		echo View::instance()->render('layout.htm');
	}
);

$f3->run();
