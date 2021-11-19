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
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET'], '/succ', 'App\Controller\IndexController@apiSucc');
Router::addRoute(['GET'], '/fail', 'App\Controller\IndexController@apiFail');
Router::addRoute(['GET'], '/exception', 'App\Controller\IndexController@apiExcep');
Router::addRoute(['GET'], '/valid', 'App\Controller\IndexController@apiValid');
Router::addRoute(['GET'], '/validfail', 'App\Controller\IndexController@apiValidFail');

Router::get('/favicon.ico', function () {
    return '';
});
