<?php namespace Controllers;

include_once 'utils/response.php';
require_once 'models/movie.php';
// require_once 'models/review.php';
require_once 'models/user.php';

use Models\Movie;
use Models\User;

class HomeController
{
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

    public function fetch($connection)
    {
        $access_token = $this->getHeaderAuth();
        $user = new User($connection);
        if ($this->validateAccessToken($user, $connection, $access_token)) {
            $this->getAllMovies($connection);
        }
    }

    public function getAllMovies($connection)
    {
        $movie = new Movie($connection);
        $movies_arr = $movie->getAllMovies($connection);
        if ($movies_arr != '500') {
            $this->render($movies_arr);
        } else {
            returnResponse('500', 'Internal Server Error.');
        }
    }

    public function render($movies_arr)
    {
        $html .= '<nav class="navbar">';
        $html .=    '<div class="navbar-brand">
                        <a href="#"><span class="bold">Engi</span>ma</a>
                    </div>
                    <div class="search-section">
                        <input class="input search" type ="text" placeholder="Search movie">
                        <a href="search.html"> <img src="../assets/search-bar.png" class="search-bar icon-layout"> </a>
                    </div>
                    <div class="menu-list">
                        <div id="transactions" class="menu"><a href="#">Transactions</a></div>
                        <div id="logout" class="menu"><a href="#">Logout</a> </div>
                    </div>';
        $html .= '</nav>';
        returnResponse('200', $html);
    }
}
