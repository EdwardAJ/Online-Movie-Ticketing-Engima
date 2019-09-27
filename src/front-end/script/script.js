var button = document.getElementById("button-buy");
var modal = document.getElementById("modal");
var seat = document.querySelectorAll("button.seat");
var not_booked = document.getElementById("booking-message").children;
var current_seatID = null;

button.onclick = function(){
    modal.style.display= "block";
}

function seatClicked(id){
    document.getElementById("movie-selected-seat").innerHTML = "Seat #" + id;

}
// window.onclick = e => {
//     console.log(e.target.id);
//     console.log('target: ', e.target.tagName);
// } 
var x = null;
window.onclick = e => {
    var x = e.target.id
}


for (i=0; i<seat.length; i++){
    seat[i].addEventListener('click', function() {
        not_booked[1].style.display = "none";
        not_booked[2].style.display = "block";
    })
}

function fetchInfo (){
   
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
}

function sendInformationToBackEnd (id) {
    var payload = makeRegisterJSON(username, email, phone, password, picture);
    var xhr = new XMLHttpRequest();
    // Call a function when the state changes.
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var response = JSON.parse(this.responseText);
            // Backend returns JSON, handled by following function:
            handleRegisterResponse(response);
        }
    }
    xhr.open("POST", 'http://localhost:8080/user/bioskop');
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(payload));
}

function makeRegisterJSON (username, email, phone, password, picture) {
    return  {
        username: username,
        email: email,
        password: password,
        picture_profile: picture,
        no_hp: phone
    }
}