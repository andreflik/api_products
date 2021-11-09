<?php

namespace App\API;

class ApIError {

    public static function errorMessage($message, $code) {
        return [
            'msg' => $message,
            'code' => $code
        ];
    }

}