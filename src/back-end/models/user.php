<?php
    class User {
        private $connection;
        private $table = 'engima.user';
        // Attributes for MYSQL table:
        public $username;
        public $email;
        public $no_hp;
        public $picture_profile;
        public $password;
        public function __construct ($database) {
            $this->connection = $database;
        }
        // Create User
        public function create($database) {
            $query = "INSERT INTO " . $this->table
                     . " VALUES " . "('" . $this->username. "', '" . $this->email . "', '" . $this->no_hp . "', '" . $this->picture_profile . "', '" . $this->password . "')";
            echo 'query: ' . $query; 
            if (mysqli_query($database, $query)) {
                return '200';
            } else {
                return 'Error ' . mysqli_error($database);
            }
        }
        // Read User
        public function read() {}
        // Update User
        public function update() {}
        // Delete User
        public function delete() {}
    }
?>