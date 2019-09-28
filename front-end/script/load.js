import { FRONT_END_BASE_URL, BACK_END_BASE_URL } from '../utils/const.js';
import { sendAJAXRequest } from '../utils/ajax.js';
import { getCookie } from '../utils/cookie.js';


// Pre load event: LOAD BEFORE DOM IS LOADED:
var access_token = getCookie('Authorization');
var keyword = getKeywordParams();

getAllMoviesByKeyword(access_token, 1, keyword);

// On click event:
window.onclick = e => {
    console.log(e.target.id);
    if (e.target.id >= 1 && e.target.id <= 5) {
        getAllMoviesByKeyword(access_token, e.target.id, keyword);
    }
}

function getAllMoviesByKeyword (access_token, page, keyword) {
    var url = BACK_END_BASE_URL + 'home/fetch?page=' + page  + '&keyword=' + keyword;
    sendAJAXRequest(null, "GET", url, function (response) {
        handleResponse(response);
        console.log(response);
    }, access_token);
}

// This function utilizes AJAX to send to backend server.
function handleResponse (response) {
    if (response.status_code === '200') {
        showPaginationButtons(Math.ceil(response.count / 5));
        document.getElementById('page').innerHTML = response.message;
    } else {
        // Returns HTML
        window.location.href = FRONT_END_BASE_URL + 'pages/login.html';
    }
}

function getKeywordParams () {
    var url = new URL(window.location.href);
    var keyword = url.searchParams.get("keyword");
    return keyword;
}

function showPaginationButtons (page_count) {
    var html_element = '';
    for (let id = 1; id <= page_count; id++) {
        html_element += '<button id=' + id + ' class="seat" type="submit"> ' + id + ' </button>';
    }
    console.log(html_element);
    document.getElementById('buttons').innerHTML = html_element;
}