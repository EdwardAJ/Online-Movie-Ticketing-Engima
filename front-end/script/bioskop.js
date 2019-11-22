import { FRONT_END_BASE_URL, BACK_END_BASE_URL } from '../utils/const.js';
import { sendAJAXRequest } from '../utils/ajax.js';
import { getCookie } from '../utils/cookie.js';

var access_token = getCookie('Authorization');
const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
getAllSeats(access_token); // Get seats before loading

function getAllSeats (access_token) {
    var url = BACK_END_BASE_URL + 'bioskop/fetch?schedule=' + getSchedule();
    console.log('url; ', url);
    sendAJAXRequest(null, "GET", url, function (response) { 
        handleResponse(response);
    }, access_token);
}

// This function utilizes AJAX to send to backend server.
function handleResponse (response) {
    if (response.status_code === '200') {
        document.querySelector('.seat-selection').innerHTML = response.body;
        setMovieHTML(response.movie);
    } 
    else {
         window.location.href = FRONT_END_BASE_URL + 'pages/login.html';
        // alert(response.message);
    }
}

function setMovieHTML (movieContents) {
    var movieAttr = JSON.parse(movieContents);
    document.getElementById('movie-title').innerHTML = movieAttr['nama'];
    var dateTime = movieAttr['date'] + "T" + movieAttr['time'];
    console.log(dateTime);
    var date = new Date(dateTime);
    var day = date.getDate();
    var year = date.getFullYear();
    var month = date.getMonth()+1;
    var minute = date.getMinutes();
    var second = date.getSeconds();
    var dateStr = monthNames[month - 1]+ "  " + day + ", " +year + " - " + minute + ":" + second;
    console.log(dateStr);
    document.getElementById('show-time').innerHTML = dateStr;
}

function getSchedule() {
    var url = new URL(window.location.href);
    var keyword = url.searchParams.get("schedule");
    return keyword;
}