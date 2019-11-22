<?php namespace Models;

class Review
{
    private $connection;
    private $table = 'engima.review';
    public $id_review;

    public function __construct($database)
    {
        $this->connection = $database;
    }
    // Get All Movies
    public function getMovieReviews($database, $params)
    {
        $query = "SELECT *
                  FROM " .  $this->table . " NATURAL JOIN engima.user WHERE
                  id_movie = '" . $params['id'] . "';";
        // echo $query;
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        if ($result) {
            return $result;
        } else {
            return '500';
        }
    }

    public function isReviewed($id_movie, $username, $database)
    {
        $query = "SELECT id_review FROM engima.review WHERE username = '" . $username . "' AND id_movie = '" . $id_movie . "';";
        // echo $query;
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        if ($result) {
            return $result[0]['id_review'];
        } else {
            return false;
        }
    }

    public function submitReview($description, $rating, $username, $id_movie, $database)
    {
        $this->getNewIDReview($database);
        $query = "INSERT INTO " . $this->table
                 . " VALUES " . "('" . $this->id_review. "', '" . $description . "', '" . $rating . "', '" . $id_movie . "', '" . $username . "')";
        // echo $query;
        if (mysqli_query($database, $query)) {
            return '200';
        } else {
            return 'Error ' . mysqli_error($database);
        }
    }

    public function delete($database, $params)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_review = '" . $params['id_review'] . "';";
        if (mysqli_query($database, $query)) {
            return '200';
        } else {
            return 'Error ' . mysqli_error($database);
        }
    }

    public function edit($description, $rating, $database, $params)
    {
        $query = "UPDATE " . $this->table
                 . " SET description =  '"  . $description . "', rating = '" . $rating . "' WHERE id_review = '". $params['id_review'] . "';";
        if (mysqli_query($database, $query)) {
            return '200';
        } else {
            return 'Error ' . mysqli_error($database);
        }
    }

    public function getNewIDReview($database)
    {
        $query = "SELECT id_review FROM " . $this->table . " ORDER BY id_review DESC LIMIT 1;";
        $execute = mysqli_query($database, $query);
        $result = mysqli_fetch_array($execute);
        $current_id =  $result[0];
        $newstring = substr($current_id, -4);
        $id_int = strval($newstring);
        $new_id = sprintf('REV%04d', $id_int + 1);
        $this->id_review = $new_id;
    }
}
