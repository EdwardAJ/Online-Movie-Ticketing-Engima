var button = document.getElementById("button-buy");
var modal = document.getElementById("modal");

button.onclick = function(){
    modal.style.display= "block";
}

function seatClicked(id){
    document.getElementById("movie-selected-seat").innerHTML = "Seat #" + id;
}