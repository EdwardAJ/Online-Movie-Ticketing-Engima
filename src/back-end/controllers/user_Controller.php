<?php
include_once 'src/back-end/utils/validation.php';
require_once 'src/back-end/models/user.php';
class user_Controller {
    // Handle user registration!
    public function register ($connection) {
        $user = new User($connection);
        $data = json_decode(file_get_contents("php://input"));

        // Validations
        $user->username = validateUsername($data->username);
        $user->email = validateEmail($data->email);
        $user->no_hp = validatePhone($data->no_hp);
        $user->picture_profile = validatePicture($data->picture_profile);
        $user->password = validatePassword($data->password);

        // Connecting to database
        $status = $user->register($connection);
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
                    "status_code" => 500,
                    "message" => $status
                )
            );
        }
    }
}
?>