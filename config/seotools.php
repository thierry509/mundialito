<?php

return [
    'meta' => [
        'defaults' => [
            'title' => 'Mondialito',
            'description' => 'site web officiel du mondialito',
            'separator' => ' - ',
            'keywords' => ['tournoi', 'foot', 'Gonaïves', 'Mundialito'],
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
