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

        'route_prefix' => 'media',

        'middleware' => [
            //
        ],

        'without_middleware' => [
            'auth:sanctum',
        ],

        'files' => [

            'route_prefix' => 'files',

            'middleware' => [
                //
            ],

            'without_middleware' => [
                'auth:sanctum',
            ],
        ],

        'images' => [

            'route_prefix' => 'images',

            'middleware' => [
                //
            ],

            'without_middleware' => [
                'auth:sanctum',
            ],
        ],
    ],
];
