<?php

return [
    'meta' => [
        'defaults' => [
            'title' => 'Mondialito',
            'description' => 'site web officiel du mondialito',
            'separator' => ' - ',
        ],
    ],

    'opengraph' => [
        'defaults' => [
            'title' => 'Mondialito',
            'description' => 'site web officiel du mondialito',
            'url' => null,
            'type' => 'article',
            'images' => [
                env('APP_URL') . '/images/mundialito.jpg'
            ],
        ],
    ],

    'twitter' => [
        'defaults' => [
            'card' => 'summary_large_image',
            'site' => '@votrecompte',
        ],
    ],
];
