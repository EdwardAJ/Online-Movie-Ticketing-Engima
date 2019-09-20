<?php
    function returnResponse ($status_code, $message) {
        echo json_encode(
            array(
                "status_code" => $status_code,
                "message" => $message
            )
        );
    }
?>