<?php namespace Controllers;

include_once 'utils/response.php';
require_once 'models/seat.php';
// require_once 'models/review.php';
require_once 'models/user.php';
require_once 'models/seat.php';
require_once 'models/transaction.php';

use Models\Movie;
use Models\User;
use Models\Seat;
use Models\Transaction;

class BioskopController {
    private $transaction = [];
    private $seat = [];
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

    public function submit($connection)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $access_token = $this->getHeaderAuth();
            $user = new User($connection);
            $transaction = new Transaction($connection);
            $seat = new Seat($connection);
            if ($this->validateAccessToken($user, $connection, $access_token)) {
                $this->fetchUsername($user, $connection, $access_token);
                $data = json_decode(file_get_contents("php://input"));
                $this->split($seat, $transaction, $data, $connection);
                $resTrans = $this->insertInfoTransaction($this->username, $transaction, $connection);
                $resSeat = $this->insertInfoSeat($seat, $connection);
                if ($resTrans && $resSeat) {
                    returnResponse('200', 'Data have been inserted.');
                } else {
                    returnResponse('500', 'Internal Server Error.');
                }
            }
        } else {
            returnResponse('500', 'Invalid HTTP REQUEST.');
        }
    }

    public function split(Seat $seat, Transaction $transaction, $data, $connection){
        $transaction->id_seat = $data->id_seat;
        $transaction->id_schedule = $data->id_schedule;
        $seat->id_seat = $data->id_seat;
        $seat->id_schedule = $data->id_schedule;
        $seat->harga = $data->harga;
    }

    public function getTransactionID(User $user, $connection){
        $user->getTransactionID($connection);
    }

    public function fetch($connection, $params) //ngambil semua data kursi, schedule
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $access_token = $this->getHeaderAuth();
            $user = new User($connection);
            $seat = new Seat($connection);
            if ($this->validateAccessToken($user, $connection, $access_token)) {
                if ($params['schedule']) {
                    $this->getAllSeatStatus($connection, $params, $seat);
                } else {
                    returnResponse('500', 'Invalid Params.');
                }
            }
        } else {
            returnResponse('500', 'Invalid HTTP REQUEST.');
        }
    }

    
    public function getAllSeatStatus ($connection, $params, Seat $seat)
    {
        $seats_arr = $seat->getStatus($connection, $params);
        if ($seats_arr != '500') {
            $this->render($seats_arr);
        } else {
            returnResponse('500', 'Internal Server Error.');
        }
    }

    public function render($seats_arr)
    {   
        for ($i = 0; $i < 3; $i++) {
            $html .= '<div class="seat-row">';
            for ($j = $i*10 + 1; $j <= $i*10 + 10; $j++) {
                if ($seats_arr[$j - 1]['status'] == 0) {
                    $html .=  '<button class="seat" value ='.$j.' id="'.$j.'" type="submit"">'.$j.'</button>';
                } else {
                    $html .=  '<button class="seat" value ='.$j.' id="'.$j.'" type="submit" disabled">'.$j.'</button>';
                }
            }
            $html .= '</div>';
        }
        returnResponse('200', $html);
    }

    public function insertInfoSeat (Seat $seat, $connection){
        $result = $seat->submitSeat($connection);
        if ($result === '200') {
            return true;
        } else {
            return false;
        }
    }

    public function insertInfoTransaction ($username, Transaction $transaction, $connection){
        $transaction->username = $username;
        $result = $transaction->submitTransaction($connection);
        if ($result === '200') {
            return true;
        } else {
            return false;
        }
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
// window.location.search


// getstatus di seat.php
// join dg transaction dengan seat lalu select atribut idseat harga sama seat
// 1 tiap ke bioskop no ticket request ke ajax id filem id schedule yg di url untuk kirim ke backend
//  2select judul film from movie where id_movie = yg dikirm frontend
//  select jadwal from schedule where idschedule = yg dikirim front end