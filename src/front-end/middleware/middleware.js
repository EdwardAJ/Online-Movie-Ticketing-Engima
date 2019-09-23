const BASE_URL = 'http://localhost:3000';

var authValidate = false;
// Check cookie.
function getCookie(c_name) {
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {
            return unescape(y);
        }
    }
}

// This function utilizes AJAX to send to backend server.
function validateAuth (access_token) {
    var xhr = new XMLHttpRequest();
    // Call a function when the state changes.
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var response = JSON.parse(this.responseText);
            // Backend returns JSON, handled by following function:
            handleAuthResponse(response);
        }
    }
    var url = BASE_URL + '/user/auth';
    xhr.open("GET", url, false);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Authorization", access_token);
    xhr.send(null);
}

function handleAuthResponse (response) {
    // 200 means successful status code!
    if (response.status_code === '200') {
        authValidate = true;
        curr_dir = window.location.href;
        if (curr_dir === BASE_URL) {
            window.location.href = BASE_URL + '/pages/home.html';
        }
    } else {
        window.location.href = BASE_URL + '/pages/login.html';
    }
}

// Middleware program starts here:
var access_token = getCookie('Authorization');
if (access_token) {
    console.log('asfafa');
    validateAuth(access_token);
}
if (!authValidate) {
    window.location.href = BASE_URL+ '/pages/login.html';
}



