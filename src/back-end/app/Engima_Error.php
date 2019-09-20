<?php 
    class Engima_Error {
        public function __construct ($error) {
            throw new Exception($error);
        }
    }
?>