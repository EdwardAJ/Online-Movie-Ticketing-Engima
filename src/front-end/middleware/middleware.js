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

var authValidate = false;
var cookie = getCookie('Authorization');
if (cookie) {
    authValidate = false;
}
if (!authValidate) {
    console.log('aaa');
    window.location.href = 'http://localhost:3000/pages/login.html';
}



