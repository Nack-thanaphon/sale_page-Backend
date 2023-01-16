<?php

/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;



return static function (RouteBuilder $routes) {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */

    $routes->setRouteClass(DashedRoute::class);
    $routes->connect('/', ['controller' => 'users', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'users', 'action' => 'logout']);
    $routes->connect('/register', ['controller' => 'users', 'action' => 'register']);
    $routes->connect('/forgetpassword', ['controller' => 'users', 'action' => 'forgetpassword']);
    // $routes->connect('/api/product', ['controller' => 'api', 'action' => 'product']);
    // $routes->connect('/api/posts', ['controller' => 'api', 'action' => 'posts']);
    // $routes->connect('/api/branch', ['controller' => 'api', 'action' => 'branch']);

    // $routes->scope('/', function (RouteBuilder $routes) {
    //     $routes->connect(
    //         '/posts/{id}-{slug}', // For example, /blog/3-CakePHP_Rocks
    //         ['controller' => 'posts', 'action' => 'view'],
    //         ['routeClass' => 'ADmad/I18n.I18nRoute']
    //     )
    //         ->setPass(['id', 'slug'])
    //         ->setPatterns([
    //             'id' => '[0-9]+',
    //         ]);

    //     $routes->connect(
    //         '/verification/{token}', // For example, /blog/3-CakePHP_Rocks
    //         ['controller' => 'users', 'action' => 'verification']
    //     )
    //         ->setPass(['token']);

    //     $routes->connect(
    //         '/resetpassword/{token}', // For example, /blog/3-CakePHP_Rocks
    //         ['controller' => 'users', 'action' => 'resetpassword']
    //     )
    //         ->setPass(['token']);

    //     $routes->connect(
    //         '/products/{id}/{slug}', // For example, /blog/3-CakePHP_Rocks
    //         ['controller' => 'products', 'action' => 'view'],
    //         ['routeClass' => 'ADmad/I18n.I18nRoute']
    //     )
    //         ->setPass(['id', 'slug'])
    //         ->setPatterns([
    //             'id' => '[0-9]+',
    //         ]);
    // });


    $routes->prefix('Admin', function (RouteBuilder $routes) {

        $routes->connect('/', ['controller' => 'dashboard', 'action' => 'index']);
        $routes->connect('/users', ['controller' => 'users', 'action' => 'index']);
        $routes->connect('/posts', ['controller' => 'posts', 'action' => 'index']);
        $routes->connect('/postcover', ['controller' => 'posts', 'action' => 'postcover']);
        $routes->connect('/dashboard', ['controller' => 'dashboard', 'action' => 'index']);
        $routes->connect('/branch', ['controller' => 'branch', 'action' => 'index']);
        $routes->connect('/contact', ['controller' => 'contact', 'action' => 'index']);
        $routes->connect('/products', ['controller' => 'products', 'action' => 'index']);
        $routes->connect('/carts', ['controller' => 'cart', 'action' => 'index']);
        $routes->connect('/orders', ['controller' => 'orders', 'action' => 'index']);
        $routes->fallbacks(DashedRoute::class);
    });
};
