<?php
    class User {
        private $connection;
        private $table = 'user';
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
        public function create() {
            $query = 'INSERT_INTO' . $this->table . 'SET username = :username, password = :password, email = :email, no_hp = :no_hp, picture_profile = :picture_profile';
            $statement = $this->connection->prepare($query);

            // Prevent harmful html codes.
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->no_hp = htmlspecialchars(strip_tags($this->no_hp));
            $this->picture_profile = htmlspecialchars(strip_tags($this->picture_profile));

            // Bind data
            $statement-> bindParam(':username', $this->username);
            $statement-> bindParam(':password', $this->password);
            $statement-> bindParam(':email', $this->email);
            $statement-> bindParam(':no_hp', $this->no_hp);
            $statement-> bindParam(':picture_profile', $this->picture_profile);

            // Execute query
            if ($statement->execute()) {
                return '200';
            } else {
                printf("Error: $s.\n", $statement->error);
                return $statement->error;
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