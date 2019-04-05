<?php

namespace TestTask\Exceptions;

use Exception;

class StorageIsFullException extends Exception
{
    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return $this->getMessage();
    }
}