<?php

namespace App\Exceptions\Task;

use App\Exceptions\DomainException;

class TaskDoesNotExistException extends DomainException
{
    public function __construct(string $message = 'The task does\'t exists', $code = 404, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
