<?php

return [
    'storage' => (new \TestTask\Storage(
        (new \TestTask\PDODriver(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME))->getConnection()
    ))
];