<?php
include_once 'src/back-end/utils/response.php';
require_once 'src/back-end/models/user.php';

class user_Controller {
    private $is_register_validated = true;
    private $register_error_array = array(
    );

    public function register ($connection) {
        $user = new User($connection);
        $data = json_decode(file_get_contents("php://input"));
        $this->validateUserAttributes($user, $data);
        if ($this->is_register_validated) {
            // Check for duplicates in the MYSQL table
            $this->validateDuplicatedUserAttributes($user, $connection);
            if ($this->is_register_validated) {
                // Generate picture.
                $user->picture_profile_path = $this->generatePicture($user->picture_profile, $user->username);
                $status = $user->register($connection);
                if ($status == '200') {
                    returnResponse($status, 'User has been successfully created.');
                } else {
                    returnResponse('500', $status);
                }
            }
        }
        if (!$this->is_register_validated) {
            returnResponse('500', $this->register_error_array);
        }
    }

    private function validateUserAttributes (User $user, $data) {
        $user->username = $this->validateUsername($data->username);
        if (!$user->username) {
            $this->setUsernameError();
        }
        $user->email = $this->validateEmail($data->email);
        if (!$user->email) {
            $this->setEmailError();
        }
        $user->no_hp = $this->validatePhone($data->no_hp);
        if (!$user->no_hp) {
            $this->setPhoneError();
        }
        $user->picture_profile = $this->validatePicture($data->picture_profile);
        if (!$user->picture_profile) {
            $this->setPictureError();
        }
        $user->password = $this->validatePassword($data->password);
        if (!$user->password) {
            $this->setPasswordError();
        }
    }

    private function validateUsername ($username) {
        $validated = false;
        if (preg_match('/^[a-zA-Z0-9_]+$/', $username)) { 
            $validated = $username;
        }
        return $validated;
    }

    private function validateEmail ($email) {
        $validated = false;
        if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
            $validated = $email;
        }
        return $validated;
    }

    private function validatePhone ($no_hp) {
        $validated = false;
        if (preg_match("/^(\d{9}|\d{12})$/", $no_hp)) {
            $validated = $no_hp;
        }
        return $validated;
    }

    private function validatePicture ($picture_profile) {
        $validated = false;
        if ($picture_profile) {
            $validated = $picture_profile;
        }
        return $validated;
    }

    private function validatePassword ($password) {
        $validated = false;
        if ($password) {
            $validated = password_hash($password, PASSWORD_DEFAULT);
        }
        return $validated;
    }
    // https://stackoverflow.com/questions/15153776/convert-base64-string-to-an-image-file
    private function generatePicture ($picture_data, $filename) {
        $full_path = 'src/back-end/pictures/users/' . $filename;
        $file = fopen($full_path, "wb");
        $data = explode(',', $picture_data);
        // Remove file headers.
        fwrite($file, base64_decode($data[1]));
        fclose($file);
        return $full_path;
    }

    private function setUsernameError () {
        $this->register_error_array['username'] = 'Username can only contain letters, numbers, and underscores.';
        $this->is_register_validated = false;
    }

    private function setEmailError () {
        $this->register_error_array['email'] = 'Invalid Email Format.';
        $this->is_register_validated = false;
    }

    private function setPhoneError () {
        $this->register_error_array['no_hp'] = 'Phone number can only contain numbers (9-12 digits).';
        $this->is_register_validated = false;
    }

    private function setPictureError () {
        $this->register_error_array['picture_profile'] = 'Picture profile is required.';
        $this->is_register_validated = false;
    }

    private function setPasswordError () {
        $this->register_error_array['password'] = 'Password is required.';
        $this->is_register_validated = false;
    }

    private function setDuplicatedValueError ($value, $value_string) {
        $this->register_error_array[$value_string] = $value_string . ' ' .  $value . ' already exists. Please use another ' . $value_string . '.';
        $this->is_register_validated = false;
    }

    private function validateDuplicatedUserAttributes (User $user, $connection) {
        if (!$user->validateDuplicate($connection, $user->username, 'username')) {
            $this->setDuplicatedValueError ($user->username, 'username');
        }
        if (!$user->validateDuplicate($connection, $user->email, 'email')) {
            $this->setDuplicatedValueError ($user->email, 'email');
        }
        if (!$user->validateDuplicate($connection, $user->no_hp, 'no_hp')) {
            $this->setDuplicatedValueError ($user->no_hp, 'no_hp');
        }
    }
}
?>