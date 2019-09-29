<?php namespace Controllers;

include_once 'utils/response.php';
require_once 'models/transaction.php';
// require_once 'models/review.php';
require_once 'models/user.php';

use Models\Transaction;
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

    public function fetch($connection){
        $access_token = $this->getHeaderAuth();
        $user = new User();
        if($this->validateAccessToken($user, $connection, $access_token)){
            $this->getAllTransaction($connection);
        }
    }
    
    public function getAllTransaction($connection)
    {
        $transaction = new Transaction();
        $transaction_arr = $transaction->getTransaction($connection);
        if($transaction_arr != '500'){
            $this->render($transaction_arr);
        }else{
            returnResponse('500','Internal Server Error');
        }
    }
    
    public function render($movies_arr)
    {
        $html .=        '<div class="section-welcome">
                            <h3> Hello, <span id="username">' . $this->username . '</span>! </h3>
                            <h4 class="tagline"> Now Playing </h4>
                        </div>';
        $html .=        '<div class="section-movies">';
        foreach ($movies_arr as $movie) {
            $html .=    '<a href="detail.html?id='. $movie['id_movie'] . '">
                            <div class="home-page-movie">
                                <img class="movie-design" src="http://localhost:8080/' . $movie['poster'] .'";">
                                <p class="movie-title">'. $movie['nama'] . '</p>
                                <div class="review">
                                    <img class="star-icon" src="../assets/star-icon.png">
                                    <p> 8.5</p>
                                </div>
                            </div>
                        </a>';
        }
        $html .=        '</div>';
        returnResponse('200', $html);
    }

}
