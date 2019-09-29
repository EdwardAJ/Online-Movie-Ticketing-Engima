<?php namespace Models;
error_reporting(0);
class Seat
{
    private $connection;
    private $table = 'engima.seat';
    // Attributes for MYSQL table:
    public $id_seat;
    public $status;
    public $id_schedule;
    public $harga;

    public function __construct($database)
    {
        $this->connection = $database;
    }
    // Submit id_seat, id_schedule, harga
    public function submitSeat($database)
    {
        $query = "UPDATE " . $this->table
                 . " SET id_seat = " . $this->id_seat. " WHERE id_schedule = '" . $this->id_schedule . "'AND harga = " . $this->harga .";";
        echo $query;
        if (mysqli_query($database, $query)) {
            return '200';
        } else {
            return 'Error ' . mysqli_error($database);
        }
    }

    public function getStatus ($database, $params)
    {
        $query = "SELECT id_seat, harga, date, time, status FROM " . $this->table . " NATURAL JOIN " . 'engima.schedule' . " WHERE id_schedule ='". $params['schedule'] . "';";    
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        if ($result) {
            return $result;
        } else {
            return '500';
        }
    }

}
