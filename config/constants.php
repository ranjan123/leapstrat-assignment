<?php

// Define constants used in the application

return [
    'search-response-fields' => [
        'users' => ['id', 'title', 'first', 'last'],
        'user_details' =>  ['gender'],
        'user_location' => ['city', 'country']
    ],
    'api-endpoint' => env('API_ENDPOINT', 'https://randomuser.me/api/')
];