<?php
    class User {
        private $connection;
        private $table_name = 'user';
        // Attributes for MYSQL table:
        public $username;
        public $email;
        public $no_hp;
        public $picture_profile;
        public $password;
        public function __construct ($connection) {
            $this->connection = $connection;
        }
        // Create User
        public function create() {}
        // Read User
        public function read() {}
        // Update User
        public function update() {}
        // Delete User
        public function delete() {}
    }
?>