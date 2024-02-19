<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Admin\Dashboard::index');
$routes->get('/Admin/Dashboard/', 'Admin\Dashboard::index', ['filter' => 'login']);
$routes->get('/Admin/Warung/', 'Admin\Warung::index', ['filter' => 'login']);
// Kategori
$routes->get('/Admin/Kategori/', 'Admin\Kategori::index', ['filter' => 'login']);
$routes->post('Admin/Kategori/add', 'Admin\Kategori::add', ['filter' => 'login']);
$routes->get('Admin/Kategori/fetch', 'Admin\Kategori::fetch', ['filter' => 'login']);
$routes->get('Admin/Kategori/ajax_edit/(:num)', 'Admin\Kategori::ajax_edit/$1', ['filter' => 'login']);
$routes->post('Admin/Kategori/delete/(:num)', 'Admin\Kategori::delete/$1', ['filter' => 'login']);
$routes->get('Admin/Kategori/detail/(:num)', 'Admin\Kategori::detail/$1', ['filter' => 'login']);
$routes->post('Admin/Kategori/update', 'Admin\Kategori::update', ['filter' => 'login']);
// BRI
$routes->get('Admin/BRI/', 'Admin\BRI::index', ['filter' => 'login']);
$routes->post('Admin/BRI/isi', 'Admin\BRI::isi', ['filter' => 'login']);
$routes->post('Admin/BRI/ajax_edit/(:num)', 'Admin\BRI::ajax_edit/$1', ['filter' => 'login']);
$routes->post('Admin/BRI/rubah', 'Admin\BRI::rubah', ['filter' => 'login']);
// $routes->post('Admin/Kategori/add', 'Admin\Kategori::add', ['filter' => 'login']);
// $routes->get('Admin/Kategori/fetch', 'Admin\Kategori::fetch', ['filter' => 'login']);
// $routes->post('Admin/Kategori/delete/(:num)', 'Admin\Kategori::delete/$1', ['filter' => 'login']);
// $routes->get('Admin/Kategori/detail/(:num)', 'Admin\Kategori::detail/$1', ['filter' => 'login']);
