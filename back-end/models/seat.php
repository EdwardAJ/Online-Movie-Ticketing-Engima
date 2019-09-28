<?php namespace Models;
class Seat
{
    private $connection;
    private $table = 'engima.movie';
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
        $query = "INSERT INTO " . $this->table
                 . " VALUES " . "('" . $this->id_seat. "', '" . $this->id_schedule . "', '" . $this->harga ."')";
        if (mysqli_query($database, $query)) {
            return '200';
        } else {
            return 'Error ' . mysqli_error($database);
        }
    }

    public function getStatus ($database){
        $query = "SELECT id_seat, harga, status FROM" . $this->table . "NATURAL JOIN" . 'engima.transaction' . "')";
        // $query = "SELECT id_seat, harga, status FROM" .
        $execute = $mysqli_query($database,$query);
        $result = $mysqli_fetch_array($execute);
    }
}
