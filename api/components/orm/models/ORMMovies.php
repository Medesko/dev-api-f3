<?php

class ORMMovies extends ORM {
        public function __construct() {
                parent::__construct();
                $this->setTableName('movies');
        }
}

?>
