import { FRONT_END_BASE_URL, BACK_END_BASE_URL } from '../utils/const.js';
import { sendAJAXRequest } from '../utils/ajax.js';
import { getCookie } from '../utils/cookie.js';

var keyword = getKeywordParams();

var access_token = getCookie('Authorization');

getAllMoviesByKeyword(access_token, keyword);

function getAllMoviesByKeyword (access_token, keyword) {
    var url = BACK_END_BASE_URL + 'home/fetch?page=' + getPageParams() + '&keyword=' + keyword;
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

function getPageParams () {
    var url = new URL(window.location.href);
    var page = url.searchParams.get("page");
    return page;
}

function getKeywordParams () {
    var url = new URL(window.location.href);
    var keyword = url.searchParams.get("keyword");
    return keyword;
}
