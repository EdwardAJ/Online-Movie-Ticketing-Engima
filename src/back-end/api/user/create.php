<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allowed-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database_connection.php';
include_once '../../models/user.php';


/*
 *  Database initialization
 */
$database = new Database();
$error = '';
$connection = $database->connect();

/*
 * User initialization
 */
$user = new User($connection);

/*
 * Fetch data from frontend
 */
$data = json_decode(file_get_contents("php://input"));

/*
 * Validation of user's attributes
 */

// Username validation:
if (!preg_match('/^[a-zA-Z0-9]$/', $data->username)) { 
    $error = "Username can only contain letters, numbers, and underscores.";
} else {
    $user->username = $data->username;
}
// Email validation:
if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $data->email)) {
    $error = "Invalid Email Format";
} else {
    $user->email = $data->email;
}

// Phone number validation:
if (!preg_match("/^(\d{9}|\d{12})$/", $data->no_hp)) {
    $error = "Phone number can only contain numbers (9-12 digits).";
} else {
    $user->no_hp = $data->no_hp;
}

if (!$data->picture_profile) {
    $error = "Picture profile is required.";
} else {
    $user->picture_profile = $data->picture_profile;
}

// Do not store user's password directly!
if (!$data->password) {
    $error = "Password is required.";
} else {
    $user->password = password_hash($data->password, PASSWORD_DEFAULT);
}

/*
 * Return JSON to frontend! [PLAN TO REFACTOR]
 */

if ($error != '') {
    // Call user's create method.
    $status = $user->create();
    if ($status == '200') {
        echo json_encode(
            array(
                "status_code" => 200,
                "message" => "User has been successfully created."
            )
        );
    } else {
        echo json_encode(
            array(
                "status_code" => 200,
                "message" => $status
            )
        );
    }
} else {
    echo json_encode(
        array(
            "status_code" => 500,
            "message" => $error
        )
    );
}
?>