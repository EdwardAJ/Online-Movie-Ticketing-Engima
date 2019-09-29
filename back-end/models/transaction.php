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
        echo $query;
        if (mysqli_query($database, $query)) {
            return '200';
        } else {
            return 'Error ' . mysqli_error($database);
        }
    }

    public function getNewTransactionID($database)
    {
        $query = "SELECT count id_transaction FROM " . $this->table . "';";
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_array($execute);
        $this->id_transaction = $result[0] + 1;
    }
}
