<?php

return [
    'host'       => env('MAIL_HOST'),
    'port'       => 993,
    'encryption' => 'ssl',
    'username'   => env('MAIL_USERNAME'),
    'password'   => env('MAIL_PASSWORD'),
];
