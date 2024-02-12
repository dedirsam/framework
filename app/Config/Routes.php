<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Admin\Dashboard::index');
$routes->get('/Admin/Dashboard/', 'Admin\Dashboard::index', ['filter' => 'login']);
$routes->get('/Admin/Warung/', 'Admin\Warung::index', ['filter' => 'login']);
