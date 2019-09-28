<?php namespace Controllers;

include_once 'utils/response.php';
require_once 'models/movie.php';
// require_once 'models/review.php';
require_once 'models/user.php';

use Models\Movie;
use Models\User;

class HomeController
{
    private $username;
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

    private function fetchUsername(User $user, $connection, $access_token)
    {
        $this->username = $user->fetchUsername($connection, $access_token);
    }

    public function fetch($connection, $params)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $access_token = $this->getHeaderAuth();
            $user = new User($connection);
            if ($this->validateAccessToken($user, $connection, $access_token)) {
                $this->fetchUsername($user, $connection, $access_token);
                if ($params['keyword']) {
                    $this->getAllMoviesWithKeyword($connection, $params);
                } else {
                    $this->getAllMovies($connection);
                }
            }
        } else {
            returnResponse('500', 'Invalid HTTP REQUEST.');
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

    public function getAllMoviesWithKeyword($connection, $params)
    {
        $movie = new Movie($connection);
        $movies_arr = $movie->getAllMoviesWithKeyword($connection, $params);
        // Count rows in movies_arr:
        if (count($movies_arr) != 0) {
            $count_arr = $movie->countAllMoviesWithKeyWord($connection, $params);
            $count = $count_arr[0];
            $this->renderSearchFound($movies_arr, $count, $params['keyword']);
        } else {
            $this->renderSearchNotFound($movies_arr);
        }
    }
    

    public function render($movies_arr)
    {
        $html .= '<nav class="navbar">';
        $html .=    '<div class="navbar-brand">
                        <a href="#"><span class="bold">Engi</span>ma</a>
                    </div>
                    <div class="search-section">
                        <input id="search-input" class="input search" type ="text" placeholder="Search movie">
                        <a href="search.html"> <img src="../assets/search-bar.png" class="search-bar icon-layout"> </a>
                    </div>
                    <div class="menu-list">
                        <div id="transactions" class="menu"><a href="#">Transactions</a></div>
                        <div id="logout" class="menu"><a href="#">Logout</a> </div>
                    </div>';
        $html .= '</nav>';
        $html .= '<div class="main-wrapper">';
        $html .=    '<div class="side-section-left"></div>';
        $html .=    '<div class="main-section">';
        $html .=        '<div class="section-welcome">
                            <h3> Hello, <span id="username">' . $this->username . '</span>! </h3>
                            <h4 class="tagline"> Now Playing </h4>
                        </div>';
        $html .=        '<div class="section-movies">';
        foreach ($movies_arr as $movie) {
            $html .=    '<a href="detail.html?id='. $movie['id_movie'] . '">
                            <div class="home-page-movie">
                                <img class="movie-design" src="http://localhost:8080/pictures/movies/movpos_47MetersDown.jpg">
                                <p class="movie-title">'. $movie['nama'] . '</p>
                                <div class="review">
                                    <img class="star-icon" src="../assets/star-icon.png">
                                    <p> 8.5</p>
                                </div>
                            </div>
                        </a>';
        }
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    '<div class="side-section-right"></div>';
        $html .= '</div>';
        returnResponse('200', $html);
    }

    public function renderSearchFound($movies_arr, $count, $keyword)
    {
        $html .= '<div class="section-title">';
        $html .=    '<h3> Showing search result for keyword "<span id="keyword">'. $keyword . '</span>" </h3>';
        $html .=    '<h4 class="tagline">'. $count . ' results available </h4>';
        $html .= '</div>';
        $html .= '<div class="section-search">';
        foreach ($movies_arr as $movie) {
            $html .= '<div class="search-card">';
            $html .=    '<div class="image-section">
                            <img class="movie-design" src="http://localhost:8080/pictures/movies/movpos_47MetersDown.jpg">
                        </div>';
            $html .=    '<div class="desc-section">';
            $html .=        '<h3>'. $movie['nama'] .'</h3>';
            $html .=        '<div class="review">
                                <img class="star-icon" src="../assets/star-icon.png">
                                <p class="review-score"> 8.5</p>
                             </div>';
            $html .=        '<div class="synopsis">
                                <p>'. $movie['sinopsis'] .'</p>
                            </div>';
            $html .=    '</div>';
            $html .=    '<div id="'. $movie['id_movie'] . '" class="view-detail fa-lg">
                            <p> View details </p>
                            <i class="fa fa-arrow-circle-right icon-detail"></i>
                         </div>';
            $html .= '</div>';
        }
        $html .= '</div>';
        returnSearch('200', $html, $count);
    }

    public function renderSearchNotFound() {
        $html .= '<div class="section-title">';
        $html .=    '<h3> Showing search result for keyword "<span id="keyword">'. $keyword . '</span>" </h3>';
        $html .=    '<h4 class="tagline"> 0 results available </h4>';
        $html .= '</div>';
        $html .= '<div class="section-search">';
        returnResponse('200', $html);
    }
}
