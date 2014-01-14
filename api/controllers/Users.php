<?php 
class Users {


	public function __construct(){
	}

	public function GetAllUsers()
	{
		$data['users'] = $this->user->listAll();
		Api::response(200, $data);
	}

	public function CreateUser()
	{
		


	}
	public function CreateUserFacebook()
	{
		$facebook = new Fb();

		$data_user = $facebook->getUser();
		if ($data_user === null) 
		{
			Api::response(400, array(), 'Vous devez être connecté à votre compte facebook');
		}else{
			var_dump($data_user['first_name']);
			$user = new ORMUsers();
			$user->name = $data_user['first_name'];
			$user->email = $data_user['email'];
			$user->insert();
		}
	}

   public function FindOne()
   {
   		   $find = 
           $data = $this->user->find();
           Api::response(200, $data);
   }

}
