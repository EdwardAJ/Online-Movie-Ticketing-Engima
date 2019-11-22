<?php namespace Models;
class Transaction
{
    private $connection;
    private $table = 'engima.transaction';
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
    public function submitTransaction($database)
    {
        $this->getNewTransactionID($database);
        $query = "INSERT INTO " . $this->table
                 . " VALUES " . "(" . $this->id_transaction. ", '". $this->username. "', " . $this->id_seat . ", '" . $this->id_schedule ."')";
        if (mysqli_query($database, $query)) {
            return '200';
        } else {
            return 'Error ' . mysqli_error($database);
        }
    }

    public function getNewTransactionID($database)
    {
        $query = "SELECT COUNT(id_transaction) FROM " . $this->table . ";";
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_array($execute);
        $this->id_transaction = $result[0] + 1;
    }

    public function getTransactionByUser($username, $database)
    {
        $query = "SELECT id_schedule, date, time, id_movie, nama, poster FROM engima.movie NATURAL JOIN engima.schedule NATURAL JOIN engima.transaction WHERE username = '". $username . "';" ;
        // echo $query;
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        return $result;
    }
}
