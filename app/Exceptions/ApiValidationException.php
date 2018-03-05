<?php

namespace App\Exceptions;

use Exception;

class ApiValidationException extends Exception
{

    private $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    public function render($request)
    {
        $response = [
            'status' => false,
            'message' => 'Error while validating request',
            'data' => [],
            'errors' => $this->errors
        ];

        return response($response, 422);
    }
}
