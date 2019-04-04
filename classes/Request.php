<?php

namespace TestTask;

class Request
{

    /**
     * @var
     */
    public $type;

    /**
     * @var
     */
    public $postData;

    /**
     * @var
     */
    public $getData;

    /**
     * @var
     */
    public $serverData;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->serverData = $_SERVER;
        $this->type       = $_SERVER['REQUEST_METHOD'];
        $this->postData   = $_POST;
        $this->getData    = $_GET;
    }

    /**
     * @return array
     */
    public function all()
    {
        return array_merge($this->getData, $this->postData);
    }

    /**
     * @param $key
     *
     * @return null
     */
    public function input($key)
    {
        $value = null;

        if (isset($this->getData[$key]) && ! empty($this->getData[$key])) {
            $value = $this->getData[$key];
        }

        if (isset($this->postData[$key]) && ! empty($this->postData[$key])) {
            $value = $this->postData[$key];
        }

        return $value;
    }

    /**
     * @return $this
     */
    public function getInstance()
    {
        return $this;
    }
}