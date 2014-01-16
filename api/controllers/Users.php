<?php 
class Users {

	public $facebook = null;

	public function __construct() 
	{
		$this->facebook = new Fb();
	}
	//API - RESTless  GET
	public function fbConnect($f3, $json)
	{
		$facebook = new Fb();
		$data_user = $facebook->getUser();
		if ($data_user === null) 
		{
			$this->facebook->getUser();

		}else{
			$user = new ORMUsers();
			if (!$user->find(array('email'=>$data_user['email']))) 
			{
				$user->first_name = $data_user['first_name'];
				$user->first_name = $data_user['last_name'];
				$user->email = $data_user['email'];
				$user->token = md5(uniqid($data_user['email']));
				$register = $user->insert();

			}
				// $json = $f3->mock('GET /users/login');
				$f3->set('content','dashboard.php');
				echo View::instance()->render('layout.php');
		}
	}
	//API - RESTless  POST
	public function insertUser() 
	{	
		Authorization::authorized(array(2));
		if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
		{
			$user = new ORMUsers();
			$email = $_POST['email'];
			if($user->find(array('email' => $email))) 
			{
				Api::response(409, array(), 'Email exists');
			}else {
				$user->first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
				$user->last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
				$user->role = isset($_POST['status']) ? $_POST['status'] : 1;
				$user->email = $email;
				$user->token = md5(uniqid($email));
				$user->insert();
				Api::response(200, array());
			}
		} else {
			Api::response(400, array(), "Invalid 'email' value");
		}
	}
	//API - RESTless  GET
	public function getAllUsers()
	{
		Authorization::authorized(array(2));
		$user = new ORMUsers();
		$data['users'] = $user->listAll();
		Api::response(200, $data);
	}
	//API - RESTless  Get
	public function getUser()
	{
		Authorization::authorized(array(1,2));
		$user = new ORMUsers();
		$user_id = F3::get('PARAMS.id');
		if ($user_id == 'me') 
		{
			Api::response(200, $user->find(array('token'=>$_REQUEST['token_access'])));
		}else{
			if ($user->find(array('token'=>$_REQUEST['token_access'], 'id'=>$user_id))) 
			{
				Api::response(200, $user);
			}else{
				Authorization::authorized(array(2));
				if ($user->find($user_id)) 
				{
					Api::response(200, $user);
				}else{
					Api::response(404, array(), 'User does not exist');
				}
			}
		}
	}
	//API - RESTless  Delete
	public function deleteUser()
	{
		Authorization::authorized(array(2));
		$user = new ORMUsers();
		$user_id = F3::get('PARAMS.id');
		if ($user->find($user_id)) 
		{
			$user->delete();
			Api::response(200);
		}else{
			Api::response(400, array(), 'User does not exist');
		}
	}

	//API - RESTless  PUT
	public function updateUser()
	{
		Authorization::authorized(array(2));
		$User = new ORMUsers();
		$user_id = F3::get('PARAMS.id');
		if ($user->find($user_id)) 
		{
			if(isset($_POST['first_name'])) $user->first_name = $_POST['first_name'];
			if(isset($_POST['last_name'])) $user->first_name = $_POST['last_name'];
			if(isset($_POST['role'])) $user->first_name = $_POST['role'];
			if(isset($_POST['token'])) $user->token = $_POST['token'];
			if (isset($_POST['email'])) 
			{
				if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
				{
					if($user->query('SELECT * FROM users WHERE email=? && id!=?', false, array($_POST['email'], $user_id)))
					{
						Api::response(200, array(), 'Email exists');
					}else{

						$user->email = $_POST['email'];
					}
				}else{
						Api::response(404, array(), "Invalid 'email' value");
				}
			}
			$user->update();
			Api::response(200);
		}else{
			Api::response(400, array(), 'User does not exist');
		}
	}
}
