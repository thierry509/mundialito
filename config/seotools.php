<?php

return [
    'meta' => [
        'defaults' => [
            'title' => 'Titre par défaut',
            'description' => 'Description par défaut',
            'separator' => ' - ',
            'keywords' => [],
        ],
    ],

    'opengraph' => [
        'defaults' => [
            'title' => 'Titre par défaut',
            'description' => 'Description par défaut',
            'url' => null,
            'type' => 'article',
            'images' => [asset('/mundialito.jpg')],
        ],
    ],

    'twitter' => [
        'defaults' => [
            'card' => 'summary_large_image',
            'site' => '@votrecompte',
        ],
    ],
];
