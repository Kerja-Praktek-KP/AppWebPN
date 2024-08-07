<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('login');
}); 

Route::get('/login', function () {
    return view('login');   
}); 

use App\Http\Controllers\UserController;
Route::post('/login', [UserController::class, 'login']);

// rute pimpinan

Route::get('/penilaianDetailKoordinatorPengawas', function () {
    return view('Pimpinan.penilaianDetailKoordinatorPengawas');
});

Route::get('/penilaianDetailPengawas', function () {
    return view('Pimpinan.penilaianDetailPengawas');
});

Route::get('/penilaianDetailPemberiLaporan', function () {
    return view('Pimpinan.penilaianDetailPemberiLaporan');
});

Route::get('/berandaPimpinan', function () {
    return view('Pimpinan.beranda');
});

Route::get('/anggotaPimpinan', function () {
    return view('Pimpinan.anggota');
});

Route::get('/profilPimpinan', function () {
    return view('Pimpinan.profil');
});

Route::get('/unggahLaporanPimpinan', function () {
    return view('Pimpinan.unggahLaporan');
});

Route::get('/riwayatLaporanPimpinan', function () {
    return view('Pimpinan.riwayatLaporan');
});

// rute pemberi laporan

Route::get('/berandaPemberiLaporan', function () {
    return view('Pemberi Laporan.berandaPemberiLaporan');
});

Route::get('/riwayatLaporanPemberiLaporan', function () {
    return view('Pemberi Laporan.riwayatLaporanPemberiLaporan');
});

Route::get('/riwayatTLHPPemberiLaporan', function () {
    return view('Pemberi Laporan.riwayatTLHPPemberiLaporan');
});

Route::get('/pemberitahuan', function () {
    return view('Pemberi Laporan.pemberitahuan');
});

Route::get('/profilPemberiLaporan', function () {
    return view('Pemberi Laporan.profil');
}); 

Route::get('/unggahLaporan', function () {
    return view('Pemberi Laporan.unggahLaporan');
});

Route::get('/profilPemberiLaporan', function () {
    return view('Pemberi Laporan.profilPemberiLaporan');
});

// rute koordinator pengawas

Route::get('/berandaKoordinatorPengawas', function () {
    return view('Koordinator Pengawas.beranda');
});

Route::get('/unggahLaporanKoordinatorPengawas', function () {
    return view('Koordinator Pengawas.unggahLaporan');
});

Route::get('/anggotaKoordinatorPengawas', function () {
    return view('Koordinator Pengawas.anggota');
});

Route::get('/penilaianDetailPengawas_KoordinatorPengawas', function () {
    return view('Koordinator Pengawas.penilaianDetailPengawas');
});

Route::get('/penilaianDetailPemberiLaporan_KoordinatorPengawas', function () {
    return view('Koordinator Pengawas.penilaianDetailPemberiLaporan');
});

Route::get('/profilKoordinatorPengawas', function () {
    return view('Koordinator Pengawas.profil');
});

Route::get('/riwayatLaporanKoordinatorPengawas', function () {
    return view('Koordinator Pengawas.riwayatLaporan');
});
//rute pengawas

Route::get('/berandaPengawas', function () {
    return view('Pengawas.beranda');
});

Route::get('/penilaianDetailPemberiLaporan_Pengawas', function () {
    return view('Pengawas.penilaianDetailPemberiLaporan');
});

Route::get('/riwayatLaporanPengawas', function () {
    return view('Pengawas.riwayatLaporan');
});

Route::get('/profilPengawas', function () {
    return view('Pengawas.profil');
});

Route::get('/unggahLaporanPengawas', function () {
    return view('Pengawas.unggahLaporan');
});

// rute super admin

Route::get('/kelolaAkun', function () {
    return view('Super Admin.kelolaAkun');
});

Route::get('/anggotaDivisi', function () {
    return view('Super Admin.anggota');
});

Route::get('/tambahPengguna', function () {
    return view('Super Admin.tambahPengguna');
});

Route::get('/formatLaporan', function () {
    return view('Super Admin.formatLaporan');
});

Route::get('/akunPimpinan', function () {
    return view('Super Admin.akunPimpinan');
});

Route::get('/akunKoordinatorPengawas', function () {
    return view('Super Admin.akunKoordinatorPengawas');
});

Route::get('/akunPengawas', function () {
    return view('Super Admin.akunPengawas');
});

Route::get('/akunPemberiLaporan', function () {
    return view('Super Admin.akunPemberiLaporan');
});


use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportFormatController;

// Route::middleware(['auth'])->group(function () {
//     Route::resource('users', UserController::class)->except(['show']);
//     Route::resource('reports', ReportController::class);
//     Route::resource('report_formats', ReportFormatController::class)->except(['edit', 'update']);
// });

Route::resource('users', UserController::class);
Route::resource('report_formats', ReportFormatController::class);
