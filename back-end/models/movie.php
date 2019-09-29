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
        $query = "SELECT id_movie, nama, poster FROM " . $this->table .";";
        $execute = mysqli_query($database, $query);
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
        $query = "SELECT id_movie, nama, sinopsis, poster FROM " . $this->table ." WHERE nama LIKE '%". $params['keyword'] . "%' LIMIT 5 OFFSET ". $rows_skipped . ";";
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
        $query = "SELECT * FROM " . $this->table ." WHERE id_movie = '". $params['id'] . "';";
        // echo $query;
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        if ($result) {
            return $result;
        } else {
            return '500';
        }
    }

    public function getMovieDetail ($database, $params){
        // $query = "SELECT nama, date, time, harga, id_seat FROM " .$this->table . " NATURAL JOIN " . 'engima.schedule' . " NATURAL JOIN" . 'engima.seat' . "WHERE id_schedule ='". $params['schedule'] . "AND id_seat='".$params['id_seat']. "';";    
        $query = "select nama, date, time, harga, id_seat from 'engima.movie' natural join 'engima.schedule' natural join 'engima.seat' where id_schedule='sch201912281400' and id_seat='10';";
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        if ($result) {
            return $result;
        } else  {
            return '500';
        }
    }
}
