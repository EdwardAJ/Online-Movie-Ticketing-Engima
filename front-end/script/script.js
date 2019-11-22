import { FRONT_END_BASE_URL, BACK_END_BASE_URL } from '../utils/const.js';
import { sendAJAXRequest } from '../utils/ajax.js';
import { getCookie } from '../utils/cookie.js';

var button = document.getElementById("button-buy");
var modal = document.getElementById("modal");
var go_transaction = document.getElementById('modal-button');

var current_seat = null;


//Change seat number when clicked button
// Get id of seat
window.onclick = e => {
    current_seat = e.target.id
    if (e.target.id >= 1 && e.target.id <= 30 ){
        handleSeatOnClick();
        document.getElementById('movie-selected-title').innerHTML = document.getElementById('movie-title').innerHTML;
        document.getElementById('movie-selected-time').innerHTML = document.getElementById('show-time').innerHTML;
        document.getElementById('movie-selected-seat').innerHTML = "Seat #" + e.target.id;
    }
}

button.onclick = function(){
    startSendingInfo();
}

function handleSeatOnClick () {
    var seat = document.querySelectorAll("button.seat");
    var not_booked = document.getElementById("booking-message").children;
    // Show movie details when clicked on seat
    var i;
    for (i=0; i<seat.length; i++){
        seat[i].addEventListener('click', function() {
            not_booked[1].style.display = "none";
            not_booked[2].style.display = "block";
        })
    }
}

go_transaction.onclick = function(){
    startSendingInfo();
}

function startSendingInfo(){
    sendInfo();
}

// Fetch information when user booked a seat and send to backend
function sendInfo (){
    var id_schedule = getSchedule();
    var seat_booked = current_seat;
    var harga = 45000;
    var access_token = getCookie('Authorization');
    sendInformationToBackEnd(id_schedule, seat_booked, harga, access_token);
}

// Make JSON to send to PHP
function makeBioskopJSON (id_schedule, id_seat, harga) {
    return  {
        id_schedule: id_schedule,
        id_seat:id_seat,
        harga: harga
    }
}


function sendInformationToBackEnd (id_schedule, id_seat, harga, access_token) {
    var payload = makeBioskopJSON(id_schedule, id_seat, harga);
    console.log(payload);
    var url = BACK_END_BASE_URL + 'bioskop/submit';
    sendAJAXRequest(payload, "POST", url, function(response) {
        handleBioskopResponse(response);
        console.log('response: ', response);
    }, access_token);
}

function handleBioskopResponse(response){
    if (response.status_code == '200') {
        handleSuccessResponse();
    } else {
        handleBadResponse(response);
    }
}

function handleSuccessResponse () {
    modal.style.display= "block"; //show block
    document.getElementById(e.target.id).disabled = true;
}

function getSchedule() {
    var url = new URL(window.location.href);
    var keyword = url.searchParams.get("schedule");
    return keyword;
}