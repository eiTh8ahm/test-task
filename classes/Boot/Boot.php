<?php

namespace TestTask\Boot;

class Boot
{
    /**
     * init
     */
    public function init()
    {
        (new Router);
    }
}