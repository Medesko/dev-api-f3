<?php

class ORMListMovies extends ORM {
        public function __construct($w = null) {
                $this->setTableName('listmovies');
                parent::__construct($w);
        }
      	public function showListMovies(id, $genre) {
      	       $user = new ORMUsers();
      	       if($id == 'me') Authorization::authorized(array(1,2));
      	       if($user->find($id)) {
      	               $listMovies = new ORMListMovies();
      	               $listMovies->setJoinTable('movies', 'listmovies.movie', 'movies.id');
      	               Api::response(200, $listMovies->findAll(array('user' => $user->id, 'genre' => $genre)));
      	       } else {
      	               Api::response(404, array(), 'Not Found');
      	       }
         }
         

      	public function insertListMovie($id, $genre) {
      	   $movie = new ORMMovies();
      	   if($movie->find($id)) {
      	           $user = new ORMUsers();
      	           $listMovies = new ORMListMovies();
      	           $user->find(array('token' => $_REQUEST['access_token']));
      	           if($listMovies->find(array('movie' => $id, 'user' => $user->id, 'genre' => $genre))) {
      	                   $genreName = ($genre == 1) ? 'Liked' : ($genre == 2 ? 'Seen' : 'To see');
      	                   Api::response(409, array(), "Movie already in '".$genreName."' list");
      	           } else {
      	                   $listMovies->movie = $id;
      	                   $listMovies->user = $user->id;
      	                   $listMovies->genre = $genre;
      	                   $listMovies->insert();
      	                   Api::response(200);
      	           }
      	   } else {
      	           Api::response(404, array(), 'Not Found');
      	   }
      	}

      	public function deleteListMovie($id, $genre) {
                  $listMovies = new ORMListMovies();
                  $user = new ORMUsers();
                  $user->find(array('token' => $_REQUEST['access_token']));
                  if($listMovies->find(array('movie' => $id, 'user' => $user->id, 'genre' => $genre))) {
                          $listMovies->delete();
                          Api::response(200);
                  } else {
                          $genreName = ($genre == 1) ? 'Liked' : ($genre == 2 ? 'Seen' : 'To see');
                          Api::response(404, array(), "Movie not found in '".$genreName."' list");
                  }
          }
}
?>
