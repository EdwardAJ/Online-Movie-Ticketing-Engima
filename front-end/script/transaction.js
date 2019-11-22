import { FRONT_END_BASE_URL, BACK_END_BASE_URL } from '../utils/const.js';
import { sendAJAXRequest } from '../utils/ajax.js';
import { getCookie } from '../utils/cookie.js';

var access_token = getCookie('Authorization');

getAllTransactions(access_token);

function getAllTransactions (access_token) {
    var url = BACK_END_BASE_URL + 'transaction/fetch';
    sendAJAXRequest(null, "GET", url, function (response) { 
        handleResponse(response);
    }, access_token);
}

// This function utilizes AJAX to send to backend server.
function handleResponse (response) {
    if (response.status_code === '200') {
        document.getElementById('page').innerHTML = response.message;
    } else {
        // Returns HTML
         window.location.href = FRONT_END_BASE_URL + 'pages/login.html';
    }
}