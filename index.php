<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

define('ROOT_PATH', dirname(__FILE__));

env();

(new \TestTask\Boot\Boot)->init();