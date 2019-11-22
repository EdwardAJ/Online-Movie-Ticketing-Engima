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
    // Get All Movies
    public function getAllMovies($database)
    {
        $query = "SELECT * FROM engima.movie as movie NATURAL JOIN (SELECT id_movie, ROUND(AVG(rating),2 ) as rating FROM review GROUP BY id_movie) as review; ";
        // $query = "SELECT id_movie, nama, poster FROM " . $this->table .";";
        $execute = mysqli_query($database, $query);
        // echo $query;
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        if ($result) {
            return $result;
        } else {
            return '500';
        }
    }
    public function getAllMoviesWithKeyword($database, $params)
    {
        $rows_skipped = ($params['page'] - 1) * 5;
        $query = "SELECT id_movie, nama, sinopsis, poster, rating FROM " . $this->table . " NATURAL JOIN (SELECT id_movie, ROUND(AVG(rating),2 ) as rating FROM review GROUP BY id_movie) as review " . " WHERE nama LIKE '%". $params['keyword'] . "%' LIMIT 5 OFFSET ". $rows_skipped . ";";
        // echo $query;
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        if ($result) {
            return $result;
        }
    }

    public function countAllMoviesWithKeyWord($database, $params)
    {
        $query = "SELECT COUNT(id_movie) FROM " . $this->table ." WHERE nama LIKE '%". $params['keyword'] . "%';";
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_array($execute);
        if ($result) {
            return $result;
        } else {
            return '500';
        }
    }

    public function getAllAttributes($database, $params)
    {
        $query = "SELECT * FROM " . $this->table ." NATURAL JOIN (SELECT id_movie, ROUND(AVG(rating),2 ) as rating FROM review GROUP BY id_movie) as review " . " WHERE id_movie = '". $params['id'] . "';";
        // echo $query;
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        if ($result) {
            return $result;
        } else {
            return '500';
        }
    }
}
