<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allowed-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database_connection.php';
include_once '../../models/user.php';

$database = new Database();
$msg = '';
// Connect to database
$connection = $database->connect();
$product= new User($connection);
$data = json_decode(file_get_contents("php://input"));
// Validation of user's attributes:
// Username validation:
$user->username = $data->username;
if(preg_match('/^[a-zA-Z0-9]$/', $user->username)) { 
    $msg = "Username can only contain letters, numbers, and underscores.";
}
// Email validation:
$user->email = $data->email;
if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $user->email)) {
    $msg = "Invalid Email Format";
}
// Phone number validation:
$user->no_hp = $data->no_hp;
if (!preg_match("/^(\d{9}|\d{12})$/")) {
    $msg = "Phone number can only contain numbers (9-12 digits).";
}
$user->picture_profile = $data->picture_profile;
if (!$user->picture_profile) {
    $msg = "Picture profile is required.";
}
$user->password = password_hash($data->password, PASSWORD_DEFAULT);
if (!$user->picture_profile) {
    $msg = "Password is required.";
}
// Return 200 response
if ($msg != '') {
    $response = [
        "status" => "OK",
        "message" => "User Created."
    ]
}
?>