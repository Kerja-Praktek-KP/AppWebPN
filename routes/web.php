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

Route::middleware(['auth'])->group(function () {
    Route::get('/berandaPemberiLaporan', function () {
        return view('berandaPemberiLaporan');
    });

    Route::get('/berandaPengawas', function () {
        return view('berandaPengawas');
    });

    Route::get('/berandaKoordinatorPengawas', function () {
        return view('berandaKoordinatorPengawas');
    });

    Route::get('/berandaPimpinan', function () {
        return view('berandaPimpinan');
    });
});

// rute pimpinan
Route::get('/penilaianDetailPengawas', function () {
    return view('Pimpinan.penilaianDetailPengawas');
})->name('penilaianDetailPengawasPimpinan');

Route::get('/penilaianDetailPemberiLaporan', function () {
    return view('Pimpinan.penilaianDetailPemberiLaporan');
})->name('penilaianDetailPemberiLaporanPimpinan');

Route::get('/penilaianDetailKoordinatorPengawas', function () {
    return view('Pimpinan.penilaianDetailKoordinatorPengawas');
})->name('penilaianDetailKoordinatorPengawasPimpinan');

Route::get('/berandaPimpinan', function () {
    return view('Pimpinan.beranda');
});

Route::get('/anggotaPimpinan', function () {
    return view('Pimpinan.anggota');
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
})->name('penilaianDetailPengawasKoordinatorPengawas');

Route::get('/penilaianDetailPemberiLaporan_KoordinatorPengawas', function () {
    return view('Koordinator Pengawas.penilaianDetailPemberiLaporan');
})->name('penilaianDetailPemberiLaporanKoordinatorPengawas');

Route::get('/riwayatLaporanKoordinatorPengawas', function () {
    return view('Koordinator Pengawas.riwayatLaporan');
});

// rute pengawas

Route::get('/berandaPengawas', function () {
    return view('Pengawas.beranda');
});

Route::get('/penilaianDetailPemberiLaporanPengawas', function () {
    return view('Pengawas.penilaianDetailPemberiLaporan');
});

Route::get('/riwayatLaporanPengawas', function () {
    return view('Pengawas.riwayatLaporan');
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
Route::resource('reports', ReportController::class);
Route::resource('report_formats', ReportFormatController::class);


Route::get('formatLaporan', [ReportFormatController::class, 'index'])->name('formatLaporan.index');
Route::get('formatLaporan/download', [ReportFormatController::class, 'download'])->name('formatLaporan.download');
Route::delete('formatLaporan/destroy-all', [ReportFormatController::class, 'destroyAll'])->name('formatLaporan.destroyAll');



Route::get('/profilPemberiLaporan', [UserController::class, 'showProfile'])->name('users.profile');
Route::get('/profilPengawas', [UserController::class, 'showProfile'])->name('users.profile');
Route::get('/profilKoordinatorPengawas', [UserController::class, 'showProfile'])->name('users.profile');
Route::get('/profilPimpinan', [UserController::class, 'showProfile'])->name('users.profile');
Route::put('/users/{user}', [UserController::class, 'updateProfil'])->name('users.updateProfil');
Route::post('/users/uploadProfilePicture', [UserController::class, 'uploadProfilePicture'])->name('users.uploadProfilePicture');

// Rute Unggah Laporan Pemberi Laporan
use App\Http\Controllers\UnggahLaporanPLController;
Route::get('/unggahLaporan', [UnggahLaporanPLController::class, 'create']);
Route::post('/unggahLaporan', [UnggahLaporanPLController::class, 'store'])->name('unggahLaporanPL');
Route::get('/riwayatLaporanPemberiLaporan', [UnggahLaporanPLController::class, 'laporan'])->name('riwayatLaporanPL');
Route::get('/riwayatTLHPPemberiLaporan', [UnggahLaporanPLController::class, 'tlhp'])->name('riwayatTLHPPL');
Route::get('/riwayatLaporanPemberiLaporan/{id}', [UnggahLaporanPLController::class, 'downloadLaporan'])->name('unduhLaporan');
Route::get('/riwayatTLHPPemberiLaporan/{id}', [UnggahLaporanPLController::class, 'downloadTLHP'])->name('unduhTLHP');

// Rute Unggah Laporan Pengawas
use App\Http\Controllers\UnggahLaporanPWController;
Route::get('/unggahLaporanPengawas', [UnggahLaporanPWController::class, 'create']);
Route::post('/unggahLaporanPengawas', [UnggahLaporanPWController::class, 'store'])->name('unggahLaporanPW');
Route::get('/riwayatLaporanPengawas', [UnggahLaporanPWController::class, 'laporan'])->name('riwayatLaporanPW');
Route::get('/riwayatLaporanPengawas/{id}', [UnggahLaporanPWController::class, 'downloadLaporan'])->name('unduhLaporan');

// Rute Unggah Laporan Koordinator Pengawas
use App\Http\Controllers\UnggahLaporanKPController;
Route::get('/unggahLaporanKoordinatorPengawas', [UnggahLaporanKPController::class, 'create']);
Route::post('/unggahLaporanKoordinatorPengawas', [UnggahLaporanKPController::class, 'store'])->name('unggahLaporanKP');
Route::get('/riwayatLaporanKoordinatorPengawas', [UnggahLaporanKPController::class, 'laporan'])->name('riwayatLaporanKP');
Route::get('/riwayatLaporanKoordinatorPengawas/{id}', [UnggahLaporanKPController::class, 'downloadLaporan'])->name('unduhLaporan');

// Rute Unggah Laporan Pimpinan
use App\Http\Controllers\UnggahLaporanPimpinanController;
Route::get('/unggahLaporanKoordinatorPimpinan', [UnggahLaporanPimpinanController::class, 'create']);
Route::post('/unggahLaporanKoordinatorPimpinan', [UnggahLaporanPimpinanController::class, 'store'])->name('unggahLaporanPimpinan');
Route::get('/riwayatLaporanPimpinan', [UnggahLaporanPimpinanController::class, 'laporan'])->name('laporanPimpinan');
Route::get('/riwayatLaporanPimpinan/{id}', [UnggahLaporanPimpinanController::class, 'downloadLaporan'])->name('unduhLaporanPimpinan');

// Rute Temuan Pengawas
use App\Http\Controllers\TemuanController;
Route::get('/penilaianDetailPemberiLaporanPengawass', [TemuanController::class, 'create']);
Route::post('/penilaianDetailPemberiLaporanPengawas', [TemuanController::class, 'store'])->name('TemuanPW');
Route::get('/unduh-temuan/{id}', [TemuanController::class, 'downloadTemuan'])->name('unduhTemuan');

// Rute Pemberitahuan
use App\Http\Controllers\PemberitahuanController;
Route::get('/pemberitahuan', [PemberitahuanController::class, 'index']);

// Rute Status Pemberi Laporan
use App\Http\Controllers\StatusPLController;
Route::get('/berandaPemberiLaporan', [StatusPLController::class, 'getStatus'])->name('berandaPemberiLaporan');

// Rute Status Pengawas
use App\Http\Controllers\StatusPWController;
Route::get('/berandaPengawas', [StatusPWController::class, 'getStatus'])->name('berandaPengawas');
use App\Http\Controllers\InfoDetailUserController;
Route::get('/penilaianDetailPemberiLaporanPengawas', [InfoDetailUserController::class, 'showPemberiLaporanuntukPengawas'])->name('pengawas.pemberiLaporan');
Route::get('/penilaianDetailPemberiLaporanPengawas/{id}', [InfoDetailUserController::class, 'downloadLaporanPLuntukPengawas'])->name('pengawas.downloadLaporanPLuntukPengawas');

use App\Http\Controllers\infoDetailKPController;
Route::get('/penilaianDetailKoordinatorPengawas', [infoDetailKPController::class, 'showKoordinatorPengawas'])->name('penilaianDetailKoordinatorPengawasPimpinan');
Route::get('/penilaianDetailKoordinatorPengawas/{id}', [InfoDetailKPController::class, 'downloadLaporan'])->name('pimpinan.downloadLaporan');

// Rute Status Koordinator Pengawas
use App\Http\Controllers\StatusKPController;
Route::get('/berandaKoordinatorPengawas', [StatusKPController::class, 'getStatus'])->name('berandaKoordinatorPengawas');

Route::get('/akunPimpinan', [UserController::class, 'akunPimpinan'])->name('users.akunPimpinan');
Route::get('/akunKoordinatorPengawas', [UserController::class, 'akunKoordinatorPengawas'])->name('users.akunKoordinatorPengawas');
Route::get('/akunPemberiLaporan', [UserController::class, 'akunPemberiLaporan'])->name('users.akunPemberiLaporan');
Route::get('/akunPengawas', [UserController::class, 'akunPengawas'])->name('users.akunPengawas');
Route::get('/kelolaAkun', [UserController::class, 'kelolaAkun'])->name('kelolaAkun');
Route::get('/berandaPimpinan', [UserController::class, 'kelolaAkun'])->name('berandaPimpinan');
Route::get('/berandaKoordinatorPengawas', [UserController::class, 'kelolaAkun'])->name('berandaKoordinatorPengawas');
Route::put('/akun/{role}', [UserController::class, 'editAkunProfil'])->name('users.editAkunProfil');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');    
Route::get('/anggota', [UserController::class, 'showAnggota'])->name('anggota');

use App\Http\Controllers\InfoDetailUserControllerPengawas;
Route::get('/penilaianDetailPengawasPimpinan/{id}', [InfoDetailUserControllerPengawas::class, 'showPengawasPimpinan'])->name('penilaianDetailPengawas');
Route::get('/downloadLaporanPWuntukPimpinan/{id}', [InfoDetailUserControllerPengawas::class, 'downloadLaporanPWuntukPimpinan'])->name('downloadLaporanPWuntukPimpinan');

Route::get('/penilaianDetailPemberiLaporanPimpinan/{id}', [InfoDetailUserController::class, 'showPemberiLaporanPimpinan'])->name('penilaianDetailPemberiLaporanPimpinan');
Route::get('/penilaianDetailPemberiLaporan/{id}', [InfoDetailKPController::class, 'downloadLaporanPLuntukPimpinan'])->name('pimpinan.downloadLaporanPLuntukPimpinan');




