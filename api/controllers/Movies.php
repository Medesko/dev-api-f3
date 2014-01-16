<?php 
Class Movies{

	public $listMovies = null;
	public function __construct()
	{
		$this->listMovies = new ORMListMovies();
	}
	//GET
	public function getAllMovies()
	{
		Authorization::authorized(array(0,1,2));
		$movies = new ORMMovies();
		if (isset($_POST['search'])) 
		{
			$search = '%'.$_POST['search'].'%';
			$req = 'SELECT * FROM movies WHERE id LIKE ? OR title LIKE ? OR details LIKE ?';
			$data['movies'] = $movies->query($req, true, array($search, $search, $search));
		}else{
			$data['movies'] = $movies->listAll();
		}
		Api::response(200, $data);

	}

	public function getMovie()
	{
		Authorization::authorized(array(0,1,2));
		$movies = new ORMMovies();
		$movies_id = F3::get('PARAMS.id');
		if ($movies->find($movies_id)) 
		{
			Api::response(200, $movies);

		}else{
			Api::response(404, array(), 'Not found');
		}
	}
	// POST
	public function insertMovie()
	{
		$movies = new ORMMovies();
		Authorization::authorized(array(2));
		if (isset($_POST['title'])) 
		{
			$movies->title = $_POST['title'];
			$movies->details = isset($_POST['details']) ? $_POST['details'] : '';
			$movies->inset();
			Api::response(array(200));
		}else{

			Api::response(400, array(), "'Invalid 'title' value");
		}
	}
	// DELETE
	public function deleteMovie()
	{
		Authorization::authorized(array(2));
		$movies_id = F3::get('PARAMS.id');
		if ($this->movies->find($movies_id)) 
		{
			$this->movies->delete();
		}else{

		}
	}
	//PUT 
	public function updateMovie()
	{
		Authorization::authorized(array(2));
		if ($this->movies->find($movies_id)) 
		{
			if (isset($_POST['title'])) $this->movies->title = $_POST['title'];
			if (isset($_POST['details'])) $this->movies->title = $_POST['details'];
			$this->movies->update();
			Api::response(200);

		}else{
			Api::response(404, array(), 'Movies not found');
		}
	}
	// POST
	public function likedMovie() {
        $this->listMovies->addListMovie(F3::get('PARAMS.id'), 1);
    }


    public function SeeMovie() {
        Authorization::authorized(array(1,2));
        $this->listMovies->addListMovie(F3::get('PARAMS.id'), 2);
    }

    public function addFavorisMovie() {
        Authorization::authorized(array(1,2));
        $this->listMovies->addListMovie(F3::get('PARAMS.id'), 3);
    }

    // DELETE
    public function unlikedMovie() {
        Authorization::authorized(array(2));
        $this->listMovies->deleteListMovie(F3::get('PARAMS.id'), 1);                
    }

    public function deleteSeeMovie() {
        Authorization::authorized(array(2));
        $this->listMovies->deleteListMovie(F3::get('PARAMS.id'), 2);                
    }

    public function deleteFavorisMovie() {
        Authorization::authorized(array(2));
        $this->listMovies->deleteListMovie(F3::get('PARAMS.id'), 3);                
    }

}
