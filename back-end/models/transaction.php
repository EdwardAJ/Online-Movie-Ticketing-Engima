<?php namespace Models;
class Transaction
{
    private $connection;
    private $table = 'engima.movie';
    // Attributes for MYSQL table:
    public $id_transaction;
    public $username;
    public $id_seat;
    public $id_schedule;

    public function __construct($database)
    {
        $this->connection = $database;
    }
    // Submit username, id_seat, id_schedule
    public function getTransaction($database){
        $query = "SELECT username, time, date, nama, poster from" .$this->table ."NATURAL JOIN 'engima.schedule' NATURAL JOIN 'engima.movie';";
        $execute = $mysqli_query($database,$query);
        $result = $mysqli_fetch_array($execute);

        if($result){
            return $result;
        }
    }
}
