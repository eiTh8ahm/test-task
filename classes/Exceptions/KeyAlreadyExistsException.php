<?php

namespace TestTask\Exceptions;

use Exception;

class KeyAlreadyExistsException extends Exception
{
    /**
     * @return string
     */
    public function errorMessage()
    {
        return $this->getMessage();
    }
}