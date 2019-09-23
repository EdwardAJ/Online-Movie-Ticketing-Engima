// Error IDs array to be reset and shown in HTML.
allErrorIDs = [
    'wrong-email',
    'wrong-password'
]
document.getElementById('loginButton').addEventListener('click', function () {
    startInformationSendSequence();
})

// When login button is clicked, this function is called first.
function startInformationSendSequence () {
    resetDocumentContent();
    fetchInformation();
}

// Reset all error text in HTML to ''
function resetDocumentContent () {
    allErrorIDs.forEach(wrongID => {
        document.getElementById(wrongID).innerHTML = '';
    })
}

function fetchInformation () {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    sendInformationToBackEnd(email, password);
}

// This function utilizes AJAX to send to backend server.
function sendInformationToBackEnd (email, password) {
    var payload = makeLoginJSON(email, password);
    var xhr = new XMLHttpRequest();
    // Call a function when the state changes.
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var response = JSON.parse(this.responseText);
            // Backend returns JSON, handled by following function:
            handleLoginResponse(response);
        }
    }
    xhr.open("POST", 'http://localhost:8080/user/login');
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(payload));
}

function makeLoginJSON (email, password) {
    return  {
        email: email,
        password: password
    }
}

function handleLoginResponse (response) {
    // 200 means successful status code!
    if (response.status_code == '200') {
        handleSuccessResponse(response);
    } else {
        handleBadResponse(response);
    }
}
// Annotate all wrong attributes (username, email, password, etc.)
// errorIDs is an object: key = <error-ID such as 'wrong-username' > and value = error message
function handleBadResponse (response) {
    var errorIDs = {};
    Object.keys(response['message']).forEach(key => {
        let wrongID = 'wrong-' + key;
        errorIDs[wrongID] = response['message'][key];
    })
    changeWrongContents(errorIDs);
}

// Change error text in HTML, assign it with messages from the backend.
function changeWrongContents (errorIDs) {
    Object.keys(errorIDs).forEach(wrongID => {
        document.getElementById(wrongID).innerHTML = errorIDs[wrongID];
    })
}

// User has been created in MYSQL.
function handleSuccessResponse (response) {
    document.getElementById('email').style.borderColor = "green";
    document.getElementById('password').style.borderColor = "green";
    createCookie('Authorization', response.message.access_token, 1);
}

function createCookie (name, value, days) {
    console.log('create cookie.');
    var expdate = new Date();
    expdate.setDate(expdate.getDate() + days);
    var c_value = value + ((days == null) ? "" : "; expires=" + expdate.toUTCString()) + "; path=/";
    document.cookie = name + "=" + c_value;
    console.log('cookie: ', document.cookie);
}