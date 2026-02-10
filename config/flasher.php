<?php

return [
    'default' => 'notyf',
    'main_script' => 'vendor/flasher/flasher.min.js',
    'styles' => [
        'vendor/flasher/flasher.min.css',
    ],
    'auto_render' => true,
    'livewire' => true,
    'drivers' => [
        'notyf' => [
            'scripts' => [
                'vendor/flasher/flasher-notyf.min.js',
            ],
            'styles' => [
                'vendor/flasher/flasher-notyf.min.css',
            ],
            'options' => [
                'dismissible' => true,
                'duration' => 3000,
                'position' => ['x' => 'right', 'y' => 'top'],
            ],
        ],
    ],
];
