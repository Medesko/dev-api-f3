<?php 
class Fb {
	public $facebook = null;

	public function __construct()
	{
		require_once("src/facebook.php");
		$config = array(
		      'appId' => '578882545530358',
		      'secret' => 'f0c7d677e0387979bc1c71f1cd7ba2e7',
		      'fileUpload' => false, // optional
		      'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
		  );
		$this->facebook = new Facebook($config);
	}

	public function getLoginUrl()
	{
		header('Location:'.$this->facebook->getLoginUrl(array("scope" => "email")));
		exit();
	}

	public function getUser()
	{
		if($this->facebook->getUser() != 0){
			return $this->facebook->api('/me');
		}else{
			header('Location:'.$this->facebook->getLoginUrl(array("scope" => "email")));
			exit();
		}
	}


}
