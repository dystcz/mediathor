<?php

declare(strict_types=1);

/**                     __              ______  __
 *  /'\_/`\           /\ \  __        /\__  _\/\ \
 * /\      \     __   \_\ \/\_\     __\/_/\ \/\ \ \___     ___   _ __
 * \ \ \__\ \  /'__`\ /'_` \/\ \  /'__`\ \ \ \ \ \  _ `\  / __`\/\`'__\
 *  \ \ \_/\ \/\  __//\ \L\ \ \ \/\ \L\.\_\ \ \ \ \ \ \ \/\ \L\ \ \ \/
 *   \ \_\\ \_\ \____\ \___,_\ \_\ \__/.\_\\ \_\ \ \_\ \_\ \____/\ \_\
 *    \/_/ \/_/\/____/\/__,_ /\/_/\/__/\/_/ \/_/  \/_/\/_/\/___/  \/_/
 */

return [
    'media' => [
        'routes' => [
            'prefix' => 'media',
            'middleware' => [
                //
            ],
            'without_middleware' => [
                'auth:sanctum',
            ],
        ],
        'files' => [
            'routes' => [
                'prefix' => 'files',
                'middleware' => [
                    //
                ],
                'without_middleware' => [
                    'auth:sanctum',
                ],
            ],
        ],
        'images' => [
            'routes' => [
                'prefix' => 'images',
                'middleware' => [
                    //
                ],
                'without_middleware' => [
                    'auth:sanctum',
                ],
            ],
            'widescreen_ratio' => [
                'width' => 1.0,
                'height' => 1.0,
            ],
        ],
    ],
];
