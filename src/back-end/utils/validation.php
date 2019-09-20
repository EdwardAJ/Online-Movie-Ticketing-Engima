<?php
    function validateUsername ($username) {
        $validated = false;
        if (preg_match('/^[a-zA-Z0-9_]+$/', $username)) { 
            $validated = $username;
        }
        return $validated;
    }

    function validateEmail ($email) {
        $validated = false;
        if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
            $validated = $email;
        }
        return $validated;
    }

    function validatePhone ($no_hp) {
        $validated = false;
        if (preg_match("/^(\d{9}|\d{12})$/", $no_hp)) {
            $validated = $no_hp;
        }
        return $validated;
    }

    function validatePicture ($picture_profile) {
        $validated = false;
        if ($picture_profile) {
            $validated = $picture_profile;
        }
        return $validated;
    }

    function validatePassword ($password) {
        $validated = false;
        if ($password) {
            $validated = password_hash($password, PASSWORD_DEFAULT);
        }
        return $validated;
    }
?>