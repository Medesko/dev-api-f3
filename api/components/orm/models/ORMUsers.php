<?php

class ORMUsers extends ORM {
        public function __construct() {
                parent::__construct();
                $this->setTableName('users');
        }
}

?>
