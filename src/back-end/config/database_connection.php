<?php
    class Database {
        // Engima Database Parameters
        private $host = 'localhost';
        private $user_name = 'root';
        private $password = '';
        private $db_name = 'engima';
        public $connection;
        // Connect Database
        public function connect() {
            $this->connection = null;
            try {
                $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8');
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        }
    }
?>