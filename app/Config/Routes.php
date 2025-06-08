<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Account Routes
$routes->group('account', function ($routes) {
    $routes->get('settings', 'Account::settings');
    $routes->post('update-profile', 'Account::updateProfile');
    $routes->post('change-password', 'Account::changePassword');
});

// Admin Routes
$routes->group('admin', ['filter' => 'group:admin'], function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    
    // User Management
    $routes->get('users', 'Admin\Users::index');
    $routes->get('users/create', 'Admin\Users::create');
    $routes->post('users/store', 'Admin\Users::store');
    $routes->get('users/edit/(:num)', 'Admin\Users::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\Users::update/$1');
    $routes->get('users/delete/(:num)', 'Admin\Users::delete/$1');
});

// Auth Routes (Shield)
service('auth')->routes($routes);
