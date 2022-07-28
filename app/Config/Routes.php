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
$routes->setDefaultController('Auth');
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
$routes->get('/', 'Auth::index');
$routes->get('/auth/login', 'Auth::login');

// dashboard
$routes->get('/dashboard', 'Dashboard::index');

// barang
$routes->get('/barang', 'Barang::index');
$routes->post('/barang', 'Barang::save');
$routes->delete('/barang/(:any)', 'Barang::delete/$1');

// supplier
$routes->get('/supplier', 'Supplier::index');
$routes->post('/supplier', 'Supplier::save');
$routes->delete('/supplier/(:num)', 'Supplier::delete/$1');

// satuan
$routes->get('/satuan', 'Satuan::index');
$routes->post('/satuan', 'Satuan::save');
$routes->delete('/satuan/(:num)', 'Satuan::delete/$1');

// jenis
$routes->get('/jenis', 'Jenis::index');
$routes->post('/jenis', 'Jenis::save');
$routes->delete('/jenis/(:num)', 'Jenis::delete/$1');

// kategori
$routes->get('/kategori', 'Kategori::index');
$routes->post('/kategori', 'Kategori::save');
$routes->delete('/kategori/(:num)', 'Kategori::delete/$1');

// obat
$routes->get('/obat', 'Obat::index');
$routes->get('/obat/add', 'Obat::create');
$routes->post('/obat', 'Obat::save');
$routes->delete('/obat/(:num)', 'Obat::delete/$1');
$routes->get('/obat/(:num)/edit', 'Obat::edit/$1');
$routes->put('/obat/(:num)', 'Obat::update/$1');
$routes->get('/obat/(:num)', 'Obat::show/$1');

// user
$routes->get('/user', 'User::index');
$routes->get('/user/add', 'User::create');
$routes->post('/user', 'User::save');
$routes->delete('/user/(:num)', 'User::delete/$1');
$routes->get('/user/(:num)/edit', 'User::edit/$1');
$routes->put('/user/(:num)', 'User::update/$1');

// transaksi
$routes->get('/transaksi', 'Transaksi::index');
$routes->get('/transaksi/addcart', 'Transaksi::addcart');

// obat masuk
$routes->get('/obatmasuk', 'ObatMasuk::index');
$routes->get('/obatmasuk/add', 'ObatMasuk::create');
$routes->post('/obatmasuk', 'ObatMasuk::save');

// obat keluar
$routes->get('/obatkeluar', 'ObatKeluar::index');
$routes->get('/obatkeluar/add', 'ObatKeluar::create');
$routes->post('/obatkeluar', 'ObatKeluar::save');

// laporan
$routes->get('/laporanobatmasuk', 'Laporan::obatMasuk');
$routes->get('/obatmasukpdf', 'Laporan::obatMasukPdf');
$routes->get('/laporanobatkeluar', 'Laporan::obatKeluar');
$routes->get('/obatkeluarpdf', 'Laporan::obatKeluarPdf');

// laporan stok obat
$routes->get('/laporan', 'Laporan::index');
$routes->get('/obatpdf', 'Laporan::getObatPdf');
$routes->get('/laporan/sell', 'Laporan::sell');
$routes->get('/laporan/sellpdf', 'Laporan::sellPdf');
$routes->get('/laporan/stok', 'Laporan::stok');


$routes->get('/profile', 'Profile::index');
$routes->get('/editprofile', 'Profile::editProfile');
$routes->post('/updateprofile', 'Profile::updateProfile');
$routes->get('/changepassword', 'Profile::changePassword');
$routes->post('/updatepassword', 'Profile::updatePassword');

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
