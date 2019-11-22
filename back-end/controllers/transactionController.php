<?php namespace Controllers;

include_once 'utils/response.php';
require_once 'models/transaction.php';
require_once 'models/review.php';
require_once 'models/user.php';

use Models\Transaction;
use Models\User;
use Models\Review;

class TransactionController
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

    private function fetchUsername(User $user, $connection, $access_token)
    {
        $this->username = $user->fetchUsername($connection, $access_token);
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
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $user = new User($connection);
            $access_token = $this->getHeaderAuth();
            if ($this->validateAccessToken($user, $connection, $access_token)) {
                $this->fetchUsername($user, $connection, $access_token);
                $this->getAllTransactionFromUser($this->username, $connection);
            }
        }
    }
    
    public function getAllTransactionFromUser($username, $connection)
    {
        $transaction = new Transaction($connection);
        $transaction_arr = $transaction->getTransactionByUser($username, $connection);
        $this->render($transaction_arr, $username, $connection);
    }
    
    public function render($transaction_arr, $username, $connection)
    {
        $review = new Review($connection);
        $html .= '<div class="section-title">';
        $html .=    '<h3> Transaction History </h3>';
        $html .= '</div>';
        $html .= '<div class="section-search">';
        for ($i = 0; $i < count($transaction_arr); $i++) {
            $html .= '<div class="search-card">';
            $html .=    '<div class="image-section">
                            <img class="movie-design" src="http://localhost:8080/' . $transaction_arr[$i]['poster'] .'";">
                        </div>';
            $html .=    '<div class="trans-desc-section">';
            $html .=        '<h3>'. $transaction_arr[$i]['nama'] .'</h3>';
            $html .=        '<div class="synopsis">
                                <p> Schedule: '. $transaction_arr[$i]['date'] . ' '. $transaction_arr[$i]['time'] . ' </p>
                            </div>';
            $html .=    '</div>';
            $html .=    '<div id="'. $transaction_arr[$i]['id_movie'] . '" class="button-transaction">';
            if ($review->isReviewed($transaction_arr[$i]['id_movie'], $username, $connection)) {
                $id_review = $review->isReviewed($transaction_arr[$i]['id_movie'], $username, $connection);
                $html .= '<div class="flex-button">';
                $html .=    '<button class="delete-button"> <a href="review.html?delete=true&id_review='. $id_review. '"> Delete Review </a> </button>';
                $html .=    '<button class="edit-button"> <a href="review.html?delete=false&id_review='. $id_review . '"> Edit Review </a> </button>';
                $html .= '</div>';
            } else {
                $html .= '<button class="add-button"> ' . '<a href="review.html?id='. $transaction_arr[$i]['id_movie'] . '"> Add Review </a> </button>';
            }
            $html .=    '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
        returnResponse('200', $html);
    }
}
