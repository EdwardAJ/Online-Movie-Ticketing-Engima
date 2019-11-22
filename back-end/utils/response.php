<?php
function returnResponse($status_code, $message)
{
    echo json_encode(
        array(
            "status_code" => $status_code,
            "message" => $message
        )
    );
}

function returnBioskopResponse($status_code, $body, $movie)
{
    echo json_encode(
        array(
            "status_code" => $status_code,
            "body" => $body,
            "movie" => json_encode($movie, JSON_UNESCAPED_SLASHES)
        )
    );
}

function returnSearch($status_code, $message, $count)
{
    echo json_encode(
        array(
            "status_code" => $status_code,
            "message" => $message,
            "count" => $count
        )
    );
}
