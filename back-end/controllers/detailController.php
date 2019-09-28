<?php namespace Controllers;

include_once 'utils/response.php';
require_once 'models/movie.php';
require_once 'models/review.php';
require_once 'models/user.php';
require_once 'models/schedule.php';

use Models\Movie;
use Models\User;
use Models\Schedule;
use Models\Review;

class DetailController
{
    private $movie;
    private $schedules;
    private $reviews;
    private function getHeaderAuth()
    {
        foreach (getallheaders() as $name => $value) {
            if ($name === 'Authorization') {
                return $value;
            }
        }
    }

    private function validateAccessToken(User $user, $connection, $access_token)
    {
        $token_expdate_arr = $user->validateAccessToken($connection, $access_token);
        $token_expdate = $token_expdate_arr[0];
        if ($token_expdate_arr !== '500') {
            if ($this->validateExpDate($token_expdate)) {
                // returnResponse('200', 'Access Token Valid.');
                return true;
            }
        } else {
            returnResponse('500', 'Invalid Access Token.');
            return false;
        }
    }

    private function validateExpDate($token_expdate)
    {
        $validate = true;
        if ($token_expdate < $this->generateCurrentDate()) {
            $validate = false;
            returnResponse('500', 'Expired Access Token.');
        }
        return $validate;
    }

    private function generateCurrentDate()
    {
        return date('Y-m-d H:i:s');
    }

    public function fetch($connection, $params)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $access_token = $this->getHeaderAuth();
            $user = new User($connection);
            $movie = new Movie($connection);
            if ($this->validateAccessToken($user, $connection, $access_token)) {
                if ($params['id']) {
                    $this->getAllAttributesOneMovie($connection, $params);
                    $this->getMovieSchedules($connection, $params);
                    $this->getMovieReviews($connection, $params);
                }
            }
        } else {
            returnResponse('500', 'Invalid HTTP REQUEST.');
        }
    }

    public function getAllAttributesOneMovie($connection, $params)
    {
        $movie = new Movie($connection);
        $movies_arr = $movie->getAllAttributes($connection, $params);
        if ($movies_arr != '500') {
            $this->movie = $movies_arr;
        } else {
            returnResponse('500', 'Internal Server Error.');
        }
    }

    public function getMovieSchedules($connection, $params)
    {
        $schedule = new Schedule($connection);
        $schedule_arr = $schedule->getMovieSchedules($connection, $params);
        if ($schedule_arr != '500') {
            $this->schedules = $schedule_arr;
        } else {
            returnResponse('500', 'Internal Server Error.');
        }
    }

    public function getMovieReviews($connection, $params)
    {
        $review = new Review($connection);
        $review_arr = $review->getMovieReviews($connection, $params);
        if ($schedule_arr != '500') {
            $this->reviews = $schedule_arr;
        } else {
            returnResponse('500', 'Internal Server Error.');
        }
    }
}
