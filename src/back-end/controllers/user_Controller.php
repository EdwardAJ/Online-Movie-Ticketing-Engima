<?php
include_once 'src/back-end/handler/validation.php';
include_once 'src/back-end/utils/response.php';
require_once 'src/back-end/models/user.php';

class user_Controller {
    public $register_error_array = array(
    );

    public function register ($connection) {
        $isValidated = true;
        $user = new User($connection);
        $data = json_decode(file_get_contents("php://input"));

        $user->username = validateUsername($data->username);
        $user->email = validateEmail($data->email);
        $user->no_hp = validatePhone($data->no_hp);
        $user->picture_profile = validatePicture($data->picture_profile);
        $user->password = validatePassword($data->password);

        $this->setRegisterError($user->username, $user->email, $user->no_hp, $user->picture_profile, $user->password);
        foreach ($this->register_error_array as $val) {
            if ($val != '') {
                $isValidated = false;
            }
        }
        // Connecting to database
        if ($isValidated) {
            $status = $user->register($connection);
            if ($status == '200') {
                returnResponse($status, 'User has been successfully created.');
            } else {
                returnResponse('500', $status);
            }
        } else {
            returnResponse('500', $this->register_error_array);
        }
    }

    public function setRegisterError($username, $email, $no_hp, $picture_profile, $password) {
        if (!$username) {
            $this->register_error_array['username'] = 'Username can only contain letters, numbers, and underscores.';
        }
        if (!$email) {
            $this->register_error_array['email'] = 'Invalid Email Format.';
        }
        if (!$no_hp) {
            $this->register_error_array['no_hp'] = 'Phone number can only contain numbers (9-12 digits).';
        }
        if (!$picture_profile) {
            $this->register_error_array['picture_profile'] = 'Picture profile is required.';
        }
        if (!$password) {
            $this->register_error_array['password'] = 'Password is required.';
        }
    }
}
?>