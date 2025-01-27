<?php 
require_once('echoRes.php');

function echoValidationError($code, $message, $errors) {
    echoRes([
        'error' => [
            'code' => $code,
            'message' => $message,
            'errors' => [
                // доделать
            ]

        ]
    ]);
}
