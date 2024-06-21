<?php

namespace App\Exceptions;

use Exception;

class InvalidUserEmailException extends Exception
{
    protected $message = 'Invalid email';
}
