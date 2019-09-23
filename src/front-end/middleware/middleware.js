import { FRONT_END_BASE_URL, BACK_END_BASE_URL } from '../utils/const.js';
import { sendAJAXRequest } from '../utils/ajax.js';
import { getCookie } from '../utils/cookie.js';

// This function utilizes AJAX to send to backend server.
function validateAuth (access_token) {
    var url = BACK_END_BASE_URL + 'user/auth';
    sendAJAXRequest(null, "GET", url, function (response) { 
        handleAuthResponse(response);
    }, access_token);
}

function handleAuthResponse (response) {
    // 200 means successful status code!
    if (response.status_code === '200') {
        var curr_dir = window.location.href;
        console.log('curr_dir: ', curr_dir);
        if (curr_dir === FRONT_END_BASE_URL) {
            console.log('asaa');
            window.location.href = FRONT_END_BASE_URL + 'pages/home.html';
        }
    } else {
        window.location.href = FRONT_END_BASE_URL + 'pages/login.html';
    }
}

// Middleware program starts here:
var access_token = getCookie('Authorization');
if (access_token) {
    validateAuth(access_token);
} else {
    window.location.href = FRONT_END_BASE_URL+ 'pages/login.html';
}



