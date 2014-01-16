<?php 
 Class Fb_controller{

 	public $facebook = null;
 	public function __construct()
 	{
 		$this->facebook = new Fb();
 	}

 	public function getLogin()
 	{	
 		Api::response(200, $this->facebook->getLoginUrl());
 		
 	}
 }
