import { FRONT_END_BASE_URL, BACK_END_BASE_URL } from '../utils/const.js';
import { sendAJAXRequest } from '../utils/ajax.js';
import { getCookie } from '../utils/cookie.js';

var access_token = getCookie('Authorization');

getAllSeats(access_token); // Get seats before loading

function getAllSeats (access_token) {
    var url = BACK_END_BASE_URL + 'bioskop/fetch';
    sendAJAXRequest(null, "GET", url, function (response) { 
        handleResponse(response);
    }, access_token);
}

// This function utilizes AJAX to send to backend server.
function handleResponse (response) {
    if (response.status_code === '200') {
        document.querySelector('.seat-row').innerHTML = response.message;
    } 
    else {
        Returns HTML
         window.location.href = FRONT_END_BASE_URL + 'pages/bioskop-noticket.html';
        // alert(response.message);
    }
}