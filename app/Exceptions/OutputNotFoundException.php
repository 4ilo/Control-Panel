<?php

namespace App\Exceptions;

use Exception;

class OutputNotFoundException extends Exception
{
    public function render()
    {
        $response = [
            'status' => false,
            'message' => 'Output not found',
            'data' => [],
            'errors' => ['Output not found']
        ];

        return response($response, 404);
    }

    public function report()
    {

    }
}
