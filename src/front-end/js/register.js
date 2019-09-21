function startInformationSendingSequence () {
    fetchInformation();
}

function fetchInformation () {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var password = document.getElementById("phone").value;
    var reconfirm = document.getElementById("reconfirm").value;
    var picture = document.getElementById("pic").value;
    sendInformationToBackEnd (username, email, phone, password, picture);
}

function sendInformationToBackEnd (username, email, phone, password, picture) {
    var payload = makeRegisterJSON(username, email, phone, password, picture);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() { // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var response = this.responseText;
            console.log('response: ', JSON.parse(response));
        }
    }
    xhr.open("POST", 'http://localhost:8080/user/register');
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(payload));
}

function makeRegisterJSON (username, email, phone, password, picture) {
    return  {
        username: username,
        email: email,
        password: password,
        picture_profile: picture,
        no_hp: phone
    }
}

document.getElementById('registerButton').addEventListener('click', function () {
    sendInformationToBackEnd();
})