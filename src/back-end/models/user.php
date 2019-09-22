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
        // Register User
        public function register($database) {
            $query = "INSERT INTO " . $this->table
                     . " VALUES " . "('" . $this->username. "', '" . $this->email . "', '" . $this->no_hp . "', '" . $this->picture_profile . "', '" . $this->password . "')";
            if (mysqli_query($database, $query)) {
                return '200';
            } else {
                return 'Error ' . mysqli_error($database);
            }
        }

        // Register validation for duplicates.
        public function validateDuplicate ($database , $value, $attribute) {
            $query = "SELECT " . $attribute . " FROM " . $this->table . " WHERE  "
                     . $attribute . " =  " . "'" . $value . "'";
            $execute = mysqli_query($database, $query);
            $result = mysqli_fetch_array($execute);
            if ($result) {
                return false;
            } else {
                return true;
            }
        }
    }
?>