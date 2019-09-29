<?php namespace Models;

class Schedule
{
    private $connection;
    private $table = 'engima.schedule';

    public function __construct($database)
    {
        $this->connection = $database;
    }
    // Get All Movies
    public function getMovieSchedules($database, $params)
    {   $curr_date = "'". $this->generateCurrentDate() . "'" ;
        $query = "SELECT id_schedule, date, time, COUNT(status) AS seat 
                  FROM " .  $this->table . " NATURAL JOIN engima.seat WHERE
                  id_movie = '" . $params['id'] . "' AND status = 0 AND DATE(date) >= ". $curr_date ." GROUP BY id_schedule ;";
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        if ($result) {
            return $result;
        } else {
            return '500';
        }
    }
    
    private function generateCurrentDate()
    {
        return date('Y-m-d');
    }
}
