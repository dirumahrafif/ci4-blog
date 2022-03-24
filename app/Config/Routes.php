<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->add('admin/logout', 'Admin/Admin::logout');

$routes->group('admin', ['filter' => 'noauth'], function ($routes) {
    $routes->add('', 'Admin/Admin::login');
    $routes->add('login', 'Admin/Admin::login');
    $routes->add('lupapassword', 'Admin/Admin::lupapassword');
    $routes->add('resetpassword', 'Admin/Admin::resetpassword');
});

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->add('sukses', 'Admin/Admin::sukses');

    $routes->add('article', 'Admin/Article::index');
    $routes->add('article/tambah', 'Admin/Article::tambah');
    $routes->add('article/edit', 'Admin/Article::edit');

    $routes->add('page', 'Admin/Page::index');
    $routes->add('page/tambah', 'Admin/Page::tambah');
    $routes->add('page/edit', 'Admin/Page::edit');

    $routes->add('socials', 'Admin/Socials::index');

    $routes->add('akun', 'Admin/Akun::index');
});

$routes->add('article/(:any)', 'Article::index/$1');
$routes->add('page/(:any)', 'Page::index/$1');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
