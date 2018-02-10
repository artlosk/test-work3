<?php

return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=test-work',
            'username' => 'root',
            'password' => '',
            'tablePrefix' => '',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
    ],
];
 