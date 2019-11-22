import { FRONT_END_BASE_URL } from '../utils/const.js';
import { eraseCookie } from '../utils/cookie.js';

document.getElementById('logout').addEventListener('click', function () {
    eraseCookie("Authorization");
    console.log(document.cookie);
    window.location.href = FRONT_END_BASE_URL + 'pages/login.html';
})

document.getElementById('transactions').addEventListener('click', function () {
    window.location.href = FRONT_END_BASE_URL + 'pages/transaction.html';
})
