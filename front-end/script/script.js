import { FRONT_END_BASE_URL, BACK_END_BASE_URL } from '../utils/const.js';
import { sendAJAXRequest } from '../utils/ajax.js';
import { getCookie } from '../utils/cookie.js';

var button = document.getElementById("button-buy");
var modal = document.getElementById("modal");
var seat = document.querySelectorAll("button.seat");
var not_booked = document.getElementById("booking-message").children;
var go_transaction = document.getElementById('modal-button');
var current_seatID = null;

// Show block
button.onclick = function(){
    modal.style.display= "block";
}

//Change seat number when clicked button
function seatClicked(id){
    document.getElementById("movie-selected-seat").innerHTML = "Seat #" + id;

}

// Get id of seat
window.onclick = e => {
    current_seat = e.target.id
}

// Show movie details when clicked on seat
for (i=0; i<seat.length; i++){
    seat[i].addEventListener('click', function() {
        not_booked[1].style.display = "none";
        not_booked[2].style.display = "block";
    })
}

go_transaction.onclick = function(){
    startSendingInfo();
}

function startSendingInfo(){
    fetchInfo();
}

// Fetch information when user booked a seat and send to backend
function fetchInfo (){
    var id_schedule = 1;
    var id_movie = 1;
    var seat_booked = current_seat;
    var harga = 45000;
    var access_token = getAccessToken();
    sendInformationToBackEnd(id_schedule, id_movie, seat_booked, harga, access_token);
}

// Make JSON to send to PHP
function makeBioskopJSON (id_schedule, id_movie, id_seat, harga) {
    return  {
        id_schedule:id_schedule,
        id_movie:id_movie,
        id_seat:id_seat,
        harga: harga
    }
}

function getAccessToken () {
    return getCookie('Authorization');
}

function sendInformationToBackEnd (id_schedule, id_movie, id_seat, harga, access_token) {
    var payload = makeBioskopJSON(id_schedule, id_movie, id_seat, harga);
    var url = BACK_END_BASE_URL + 'bioskop/submit';
    sendAJAXRequest(payload, "POST", url, function(response) {
        handleBioskopResponse(response);
    }, access_token);
}

function handleBioskopResponse(response){
    if (response.status_code == '200') {
        handleSuccessResponse();
    } else {
        handleBadResponse(response);
    }
}
//    ambil value
// send value to backend
// masukin ke transaksi, seat
// transaksi ; ngirim username idseat idschedule
//  seat : ngirim idseat, id schedule, harga
// backendnya split username, idseat, idschedule (transaski) split lagi idseat, idschedule, harga (seat)
// dari js kirim ke bioskop controller.php di phpnya decode dulu trus split dimasukin array transaksion
// get row transaction bikin di transaction.php
// masukin model transaction sama masukin model seat (seat.php)
// controller getrow transaction
// di model transaction buat getrow, buat insert transaction tapi this.row dulu brp trus insert values
//  insert blabla
// var row baru = this.getrow + 1 baru bawahnya insert values
// kalo mau ambil join seat dengan schedule
// fetch url windows.href parse sampe ketemu =


// getstatus di seat.php
// join dg transaction dengan seat lalu select atribut idseat harga sama seat
// 1 tiap ke bioskop no ticket request ke ajax id filem id schedule yg di url untuk kirim ke backend
//  2select judul film from movie where id_movie = yg dikirm frontend
//  select jadwal from schedule where idschedule = yg dikirim front end