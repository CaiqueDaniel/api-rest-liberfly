<?php

return [
    'bearer_token' => [
        'type' => 'apiKey',
        'description' => 'Enter token in format (Bearer <token>)',
        'name' => 'Authorization',
        'in' => 'header',
    ],
];
