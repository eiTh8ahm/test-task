<?php

namespace TestTask\Exceptions;

use Exception;

class KeyDoesNotExistException extends Exception
{
    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return $this->getMessage();
    }
}