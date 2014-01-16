<?php 
Class Movies{

	public $db = null;
	public function __construct()
	{
		$this->db = new ORMmovies();
	}

	public function getAllMovies()
	{
		Authorization::authorized(array(0,1,2));

		if (isset($_POST['search'])) 
		{
			$search = '%'.$_POST['search'].'%'
			$req = 'SELECT * FROM movies WHERE id LIKE ? OR title LIKE ? OR details ';
			$data = $this->db->query($req, true, array($search, $search, $search));
		}else{
			$data = $this->db->listAll();
		}
		Api::response(200, $data);

	}

	public function getMovie()
	{
		Authorization::authorized(0,1,2);
		$movies_id = F3::get('PARAMS.id');
		if ($this->db->find($movies_id)) 
		{
			Api::response(200, $this->db);

		}else{
			Api::response(404, array(), 'Not found');
		}
	}

	public function insertMovie()
	{
		Authorization::authorized(array(2));
		if (isset(*_POST['title'])) 
		{
			$this->db->title = $_POST['title'];
			$this->db->details = isset($_POST['details']) ? $_POST['details'] : '';
			$this->db->inset();
		}else{

			Api::response(400, array(), "'Invalid 'title' value");
		}
	}

	public function deleteMovie()
	{
		Authorization::authorized(array(2));
		$movies_id = F3::get('PARAMS.id');
		if ($this->db->find($movies_id)) 
		{
			$this->db->delete();
		}else{

		}
	}

	public function updateMovie()
	{
		
	}


	public function deleteFavorisMovie()
	{
		$movies_id = F3::get('PARAMS.id');
		$favoris = 
	}
}
