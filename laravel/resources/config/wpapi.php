<?php

return [
    'client' => [
        'options' => [
            'base_uri'  => env('WPAPI_URL', 'http://example.com/'),
            'verify'    => (bool) env('WPAPI_SSL', false),
            'auth'      => [ env('WPAPI_USER', 'user'), env('WPAPI_PASS', 'my secret password') ]
        ]
    ]
];