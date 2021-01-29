<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Anggota');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('login', 'Auth::login', ['as' => 'view_login']);
$routes->post('login', 'Auth::auth', ['as' => 'auth']);

$routes->group('admin', function ($routes) {

	$routes->group('petugas', ['filter' => 'login'], function ($routes) {
		$routes->get('', 'Petugas::index', ['as' => 'view_petugas']);
		$routes->get('add', 'Petugas::add', ['as' => 'add_petugas']);
		$routes->post('save', 'Petugas::save', ['as' => 'save_petugas']);
		$routes->delete('(:any)', 'Petugas::delete/$1', ['as' => 'del_petugas']);
		$routes->get('edit/(:any)', 'Petugas::edit/$1', ['as' => 'edit_petugas']);
		$routes->post('ubah', 'Petugas::update', ['as' => 'ubah_petugas']);
	});

	$routes->group('anggota', ['filter' => 'login'], function ($routes) {
		$routes->get('', 'Anggota::index', ['as' => 'view_anggota']);
		$routes->get('add', 'Anggota::add', ['as' => 'add_anggota']);
		$routes->post('save', 'Anggota::save', ['as' => 'save_anggota']);
		$routes->delete('(:any)', 'Anggota::delete/$1', ['as' => 'del_anggota']);
		$routes->get('edit/(:any)', 'Anggota::edit/$1', ['as' => 'edit_anggota']);
		$routes->post('ubah', 'Anggota::update', ['as' => 'ubah_anggota']);
	});

	$routes->group('buku', ['filter' => 'login'], function ($routes) {
		$routes->get('', 'Buku::index', ['as' => 'view_buku']);
		$routes->get('add', 'Buku::add', ['as' => 'add_buku']);
		$routes->post('save', 'Buku::save', ['as' => 'save_buku']);
		$routes->delete('(:any)', 'Buku::delete/$1', ['as' => 'del_buku']);
		$routes->get('edit/(:any)', 'Buku::edit/$1', ['as' => 'edit_buku']);
		$routes->post('ubah', 'Buku::update', ['as' => 'ubah_buku']);
	});

	$routes->group('pinjam', ['filter' => 'login'], function ($routes) {
		$routes->get('', 'Pinjam::index', ['as' => 'view_pinjam']);
		$routes->get('add', 'Pinjam::add', ['as' => 'add_pinjam']);
		$routes->post('save', 'Pinjam::save', ['as' => 'save_pinjam']);
		$routes->delete('(:any)', 'Pinjam::delete/$1', ['as' => 'del_pinjam']);
		$routes->get('edit/(:any)', 'Pinjam::edit/$1', ['as' => 'edit_pinjam']);
		$routes->post('ubah', 'Pinjam::update', ['as' => 'ubah_pinjam']);
	});

	$routes->get('logout', 'Auth::logout', ['as' => 'logout']);
});


if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
