<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('auth', 'Auth::index');
$routes->get('sign-up', 'Auth::signup');
$routes->post('sign-up', 'Auth::register');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout', ['filter' => 'login']);
$routes->get('jadwal', 'Home::jadwal');

//must be logged
$routes->get('jadwal-saya', 'Home::jadwalSaya', ['filter' => 'pelanggan']);
$routes->get('booking', 'Home::bookingPage', ['filter' => 'pelanggan']);
$routes->get('profil', 'Home::profil', ['filter' => 'pelanggan']);
$routes->post('profil/update', 'Home::updateProfil', ['filter' => 'pelanggan']);
$routes->post('profil/ganti-password', 'Home::updatePassword', ['filter' => 'pelanggan']);
$routes->post('booking', 'Home::booking', ['filter' => 'pelanggan']);
$routes->post('ajax/booking-form', 'Ajax::form', ['filter' => 'pelanggan']);
$routes->post('ajax/cek-jadwal', 'Ajax::cekJadwal', ['filter' => 'pelanggan']);
$routes->post('ajax/detail-transaksi', 'Ajax::detailTransaksi', ['filter' => 'pelanggan']);
$routes->post('ajax/get-feedback', 'Ajax::getFeedback', ['filter' => 'pelanggan']);
$routes->get('pesanan-saya', 'Home::pesananSaya', ['filter' => 'pelanggan']);
$routes->post('bayar', 'Home::uploadBayar', ['filter' => 'pelanggan']);
$routes->post('batal', 'Home::batal', ['filter' => 'pelanggan']);
$routes->post('feedback', 'Home::feedback', ['filter' => 'pelanggan']);
$routes->post('ajax/notifikasi/admin', 'Ajax::notifikasiAdmin', ['filter' => 'admin']);
$routes->post('ajax/notifikasi/pelanggan', 'Ajax::notifikasiPelanggan', ['filter' => 'pelanggan']);
$routes->post('ajax/notifikasi/read/(:num)', 'Ajax::read/$1', ['filter' => 'login']);

$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('ganti-password', 'Admin::gantiPassword');
    $routes->post('ganti-password', 'Admin::updatePassword');

    $routes->get('pelanggan', 'Admin::pelanggan');
    $routes->get('lapangan', 'Lapangan::index');
    $routes->get('lapangan/form', 'Lapangan::form');
    $routes->post('lapangan', 'Lapangan::save');

    $routes->get('fasilitas', 'Fasilitas::index');
    $routes->post('fasilitas/hapus', 'Fasilitas::delete');
    $routes->post('fasilitas/save', 'Fasilitas::insert');
    $routes->post('fasilitas/update', 'Fasilitas::update');

    $routes->get('transaksi', 'Transaksi::index');
    $routes->get('transaksi/(:num)', 'Transaksi::jadwal/$1');
    $routes->get('transaksi-pelanggan/(:num)', 'Transaksi::byPelanggan/$1');

    $routes->get('feedback', 'Feedback::index');

    $routes->get('transaksi-fasilitas', 'Transaksi::fasilitas');
    $routes->get('transaksi-fasilitas/(:num)', 'Transaksi::detailSewa/$1');
    $routes->get('sewa-fasilitas', 'Transaksi::sewaFasilitas');
    $routes->post('sewa', 'Transaksi::prosesSewa');

    $routes->get('jadwal', 'Jadwal::index');
    $routes->get('jadwal/hari-ini', 'Jadwal::today');
    $routes->get('jadwal/selesai', 'Jadwal::done');
    $routes->post('jadwal/checkin', 'Jadwal::checkin');
    $routes->post('jadwal/selesai', 'Jadwal::selesai');
    $routes->post('verifikasi', 'Transaksi::verifikasi');
    $routes->get('laporan', 'Laporan::keuangan');
    $routes->get('laporan/cetak', 'Laporan::cetak');

    $routes->get('log', 'Admin::log');
});
