<?php

namespace TestTask\Exceptions;

use Exception;

class KeyDoesNotExist extends Exception
{
    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return $this->getMessage();
    }
}