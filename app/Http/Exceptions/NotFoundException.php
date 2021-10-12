<?php

namespace App\Http\Exceptions;

use Exception;

class NotFoundException extends Exception
{

    /**
     * @param string $message
     * @param int $status
     */
    public function __construct($message = 'Not Found', $status = 404)
    {
        parent::__construct($message, $status);
    }

}
