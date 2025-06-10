<?php

return [
    'meta' => [
        'defaults' => [
            'title' => 'Mondialito',
            'description' => 'Description par défaut',
            'separator' => ' - ',
            'keywords' => ['tournoi', 'foot', 'Gonaïves', 'Mundialito'],
        ],
    ],

    'opengraph' => [
        'defaults' => [
            'title' => 'Mondialito',
            'description' => 'Description par défaut',
            'url' => null,
            'type' => 'article',
            'images' => [
                public_path('mundialito.jpg')
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
