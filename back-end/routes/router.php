<?php

require_once 'controllers/user_Controller.php';
require_once 'app/Engima_Error.php';

class Router {
    public function route ($controller, $action, $connection) {
        $controller_class_name = $controller . '_Controller';
        // Instantiate object with error handling
        try {
            if (class_exists($controller_class_name)) {
                $object = new $controller_class_name();
                // Call object's method.
                if (method_exists($object, $action)) {
                    $object->$action($connection);
                } else {
                    $error = new Engima_Error('Action not found!');
                }
            } else {
                $error = new Engima_Error('Class not found');
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
?>