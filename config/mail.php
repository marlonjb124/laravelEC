<?php

// config/mail.php

return [
    'driver' => env('MAIL_MAILER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
    'port' => env('MAIL_PORT', 587),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'example@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
];

