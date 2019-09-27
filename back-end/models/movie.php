<?php namespace Models;

class Movie
{
    private $connection;
    private $table = 'engima.movie';
    // Attributes for MYSQL table:
    public $id_movie;
    public $nama;
    public $runtime;
    public $tanggal_rilis;
    public $sinopsis;
    public $poster;

    public function __construct($database)
    {
        $this->connection = $database;
    }
    // Register User
    public function getMoviesName($database)
    {
        $query = "SELECT nama FROM " . $this->table .";";
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_array($execute);
        if ($result) {
            return $result;
        } else {
            return '500';
        }
    }

    public function login($database)
    {
        $query = "SELECT password  FROM " . $this->table . " WHERE email = '" . $this->email . "';";
        // echo $query;
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_array($execute);
        if ($result) {
            $hashed_password = $result[0];
            $result = password_verify($this->password, $hashed_password);
            if ($result) {
                return '200';
            } else {
                return 'Wrong Password.' ;
            }
        }
        if (!$result) {
            return 'Please register yourself!' ;
        }
    }

    public function updateExpiryTime($database)
    {
        $query = "UPDATE " . $this->table . " SET token_expdate = '" . $this->token_expdate . "' WHERE email = '" . $this->email . "';";
        $result = mysqli_query($database, $query);
        if ($result) {
            return '200';
        } else {
            return '500';
        }
    }

    public function getAccessToken($database)
    {
        $query = "SELECT token  FROM " . $this->table . " WHERE email = '" . $this->email . "';";
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_array($execute);
        if ($result) {
            return $result;
        } else {
            return '500';
        }
    }

    public function validateAccessToken($database, $access_token)
    {
        $query = "SELECT token_expdate  FROM " . $this->table . " WHERE token = '" . $access_token . "';";
        $execute = mysqli_query($database, $query);
        $token_expdate_arr = mysqli_fetch_array($execute);
        if ($token_expdate_arr) {
            return $token_expdate_arr;
        } else {
            return '500';
        }
    }

    // Register validation for duplicates.
    public function validateDuplicate($database, $value, $attribute)
    {
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
