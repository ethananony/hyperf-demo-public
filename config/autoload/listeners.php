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
$listeners = [
    \App\Listener\FetchModeListener::class,
];

if (env('LISTENER_ENABLE_DBLOG')) {
    $listeners[] = \App\Listener\DbQueryExecutedListener::class;
}

return $listeners;
