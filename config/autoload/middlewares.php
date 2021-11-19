<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
$middlewares = [
    'http' => [
    ],
];

if (env('MIDDLEWARE_ENABLE_CORS')) {
    $middlewares['http'][] = \App\Middleware\CorsMiddleware::class;
}

return $middlewares;
