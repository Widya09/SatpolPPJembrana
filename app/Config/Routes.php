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
$routes->get('/', 'Login::index');
$routes->post('/login', 'Login::ceklogin');
$routes->get('admin/home', 'Home::index');
$routes->get('/admin/pengaduan', 'Pengaduan::index');

$routes->get('create-db', function () {
    $forge = \Config\Database::forge();
    if ($forge->createDatabase('db_satpolta')) {
        echo 'Database created!';
    }
});
$routes->get('admin/pengaduan/detail/(:num)', 'Pengaduan::getDetail/$1');
$routes->get('admin/pengaduan/add', 'Pengaduan::create');

$routes->post('admin/pengaduan', 'Pengaduan::store');
$routes->get('admin/pengaduan/edit/(:any)', 'Pengaduan::edit/$1');
$routes->post('admin/pengaduan/update/(:any)', 'Pengaduan::update/$1');
$routes->delete('admin/pengaduan/delete/(:num)', 'Pengaduan::delete/$1');
$routes->delete('admin/pengaduan/remove/(:num)', 'Pengaduan::remove/$1');

$routes->get('/petugas/home', 'Verifikasi::index');
$routes->get('/petugas/verifikasi', 'Verifikasi::tampil');
$routes->get('petugas/verifikasi/addverif/(:num)', 'Verifikasi::tambah/$1');
$routes->post('petugas/verifikasi/terverif/(:num)', 'Verifikasi::terverif/$1');


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
