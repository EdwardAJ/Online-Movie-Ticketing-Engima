var button = document.getElementById("button-buy");
var modal = document.getElementById("modal");
var seat = document.querySelectorAll("button.seat");
var not_booked = document.getElementById("booking-message").children;

button.onclick = function(){
    modal.style.display= "block";
}

function seatClicked(id){
    document.getElementById("movie-selected-seat").innerHTML = "Seat #" + id;
}

for (i=0; i<seat.length; i++){
    seat[i].addEventListener('click', function() {
        not_booked[1].style.display = "none";
        not_booked[2].style.display = "block";
    })
}

