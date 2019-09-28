<?php namespace Controllers;

include_once 'utils/response.php';
require_once 'models/seat.php';
// require_once 'models/review.php';
require_once 'models/user.php';

use Models\Movie;
use Models\User;

class BioskopController {
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

    public function submit($connection)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $access_token = $this->getHeaderAuth();
            $user = new User($connection);
            if ($this->validateAccessToken($user, $connection, $access_token)) {
                $this->fetchUsername($user, $connection, $access_token);
                $data = json_decode(file_get_contents("php://input"));
                split($data, $user, $connection);
                $this->insertInfoTransaction($connection);
                $this->insertInfoSeat($connection);
            }
        } else {
            returnResponse('500', 'Invalid HTTP REQUEST.');
        }
    }

    public function split($data, User $user, $connection){
        $transaction = [];
        $transaction['username'] = $data['username'];
        $transaction['id_seat'] = $data['id_seat'];
        $transaction['id_schedule'] = $data['id_schedule'];
        $seat['id_seat'] = $data['id_seat'];
        $seat['id_schedule'] = $data['id_schedule'];
        $seat['harga'] = $data['harga'];
    }

    public function getTransactionID(User $user, $connection){
        $user->getTransactionID($connection);
    }
}

// DONE
// backendnya split username, idseat, idschedule (transaski) split lagi idseat, idschedule, harga (seat)
// dari js kirim ke bioskop controller.php di phpnya decode dulu trus split dimasukin array transaksion

// DONE
// get row transaction bikin di transaction.php
// masukin model transaction sama masukin model seat (seat.php)
// controller getrow transaction
// di model transaction buat getrow, 
// DONE
// buat insert transaction tapi this.row dulu brp trus insert values
//  insert blabla
// var row baru = this.getrow + 1 baru bawahnya insert values


// kalo mau ambil join seat dengan schedule
// fetch url windows.href parse sampe ketemu =


// getstatus di seat.php
// join dg transaction dengan seat lalu select atribut idseat harga sama seat
// 1 tiap ke bioskop no ticket request ke ajax id filem id schedule yg di url untuk kirim ke backend
//  2select judul film from movie where id_movie = yg dikirm frontend
//  select jadwal from schedule where idschedule = yg dikirim front end