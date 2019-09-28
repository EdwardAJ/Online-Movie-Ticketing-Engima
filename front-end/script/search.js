import { FRONT_END_BASE_URL, BACK_END_BASE_URL } from '../utils/const.js';
import { sendAJAXRequest } from '../utils/ajax.js';
import { getCookie } from '../utils/cookie.js';


document.querySelector('.search-bar').addEventListener('click', function () {
    getAllMoviesByKeyword(access_token, document.getElementById('search-input').value);
})

var access_token = getCookie('Authorization');

function getAllMoviesByKeyword (access_token, value) {
    console.log(value);
    var url = BACK_END_BASE_URL + 'home/fetch?page=1&keyword=' + value;
    sendAJAXRequest(null, "GET", url, function (response) { 
        handleResponse(response);
    }, access_token);
}

// This function utilizes AJAX to send to backend server.
function handleResponse (response) {
    if (response.status_code === '200') {
        document.querySelector('.main-section').innerHTML += response.message;
    } else {
        // Returns HTML
         window.location.href = FRONT_END_BASE_URL + 'pages/login.html';
    }
}