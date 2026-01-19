<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatapassController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\LogPerangkatController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\NewProjectController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SlaController;
use App\Http\Controllers\LaporanPMController;
use App\Http\Controllers\PmLibertaController;
use App\Http\Controllers\logspareController;
use App\Http\Controllers\SiteReviewController;
use App\Http\Controllers\LaporanInstalasiController;
use App\Http\Controllers\SummaryTiketController;
use App\Http\Controllers\SparetrackerController;
use App\Http\Controllers\MyDashboardController;
use App\Http\Controllers\JadwalPiketController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\BMSDashboardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ProjectTimelineController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route My dashboard
    Route::get('/mydashboard', [MyDashboardController::class, 'index'])->name('mydashboard');


    // Chat Routes
    Route::get('/chat/fetch', [ChatController::class, 'fetch']);
    Route::post('/chat/send', [ChatController::class, 'send']);

// ✅ Landing page (semua tombol menu ada di sini)
Route::get('/', function () {
    return view('aboutus');
})->name('aboutus');
// Landingpages
Route::get('/landingpage', function () {
    return view('landingpage');
})->name('landingpage');
// ✅ Route login guest-only
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

// ✅ Route login fallback (view only, opsional)
//Route::get('/login', fn() => view('session.login-session'))->name('login');

// ✅ Route halaman tujuan (butuh auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [SessionsController::class, 'destroy'])->name('logout');

    // Data Site
    Route::get('/tables', [SiteController::class, 'index'])->name('tables');
    Route::get('/datacreate', [SiteController::class, 'create'])->name('datacreate');
    Route::get('/dataupdate/{id}', [SiteController::class, 'edit'])->name('edit');
    Route::post('/store', [SiteController::class, 'store'])->name('store');
    Route::post('/update/{id}', [SiteController::class, 'update'])->name('update');
    Route::get('/dataexport', [SiteController::class, 'dataexport'])->name('dataexport');
    Route::post('/dataimport', [SiteController::class, 'dataimport'])->name('dataimport');
    Route::any('/tiket/rekap', fn () => redirect()->route('tiket'));

    // Tiket
    Route::get('/tiket', [TiketController::class, 'index'])->name('tiket');
    Route::post('/tiket', [TiketController::class, 'store'])->name('tiket.store');
    Route::put('/tiket/{id}', [TiketController::class, 'update'])->name('tiket.update');
    Route::put('/tiket/{id}/update-status', [TiketController::class, 'updateStatus'])->name('tiket.updateStatus');
    Route::get('/tiket/delete/{id}', [TiketController::class, 'delete'])->name('tiket.delete');
    Route::get('/tiket/detail/{id}', [TiketController::class, 'detailTiket'])->name('tiket.detail');
    Route::get('/close/tiket', [TiketController::class, 'closeTiket'])->name('close.tiket');
    Route::get('/tiket/close/{id}', [TiketController::class, 'close'])->name('tiket.close');
    Route::get('/get-datasite/{id}', [TiketController::class, 'getDataSite']);
    Route::get('/get-datasite-list', [TiketController::class, 'getDatasiteList']);
    Route::get('/api/tiket/datasites/{id}', [TiketController::class, 'getDataSiteById']);
    Route::post('/tiketimport', [TiketController::class, 'tiketimport'])->name('tiketimport');
    Route::get('/tiketexport', [TiketController::class, 'tiketexport'])->name('tiketexport');
    Route::get('/download/tiket/{status_tiket}', [TiketController::class, 'downloadDataSiteByTiketStatus'])->name('download.tiket');
    Route::get('/download-data-site', [TiketController::class, 'exportByTiketStatus']);
    Route::get('/tiket/filter', [TiketController::class, 'filter'])->name('tiket.filter');
    Route::post('/close_tiket/update-tanggal/{id}', [TiketController::class, 'updateTanggalClose'])->name('close.tiket.updateTanggal');
    Route::put('/tiket/update-plan/{id}', [TiketController::class, 'updatePlan'])->name('tiket.updatePlan');
    Route::get('/tiket/{id}', [TiketController::class, 'show']);

    // SLA
    Route::get('/sla', [SlaController::class, 'index'])->name('sla.index');
    Route::post('/sla/store', [SlaController::class, 'store'])->name('sla.store');
    Route::post('/sla/import', [SlaController::class, 'import'])->name('sla.import');
    Route::post('/import-sla', [SlaController::class, 'import'])->name('import.excel');
    Route::post('/sla/update-inline/{id}', [SlaController::class, 'updateInline'])->name('sla.update-inline');

    // Route BMSDashboard
    Route::get('/BMSDashboard', [BMSDashboardController::class, 'index'])->name('BMSDashboard');

    // Download File
    Route::get('/download_file', [FileController::class, 'index'])->name('file.index');
    Route::post('/file-upload', [FileController::class, 'store'])->name('file.upload');
    Route::get('/file-download/{id}', [FileController::class, 'download'])->name('file.download');
    Route::delete('/file/{id}', [FileController::class, 'destroy'])->name('file.destroy');

    // Tambahan Export
    Route::get('/export/tiket', [FileController::class, 'exportTiket'])->name('export.tiket');
    Route::get('/export/datasite', [FileController::class, 'exportDatasite'])->name('export.datasite');
    Route::get('/download/log_perangkat', [FileController::class, 'downloadLogPerangkat'])->name('download.log_perangkat');
    Route::get('/download/datapass', [FileController::class, 'downloadDataPass'])->name('download.datapass');

    // ToDo List
    Route::get('/todolist', [TaskController::class, 'index'])->name('todolist.index');
    Route::post('/todolist/store', [TaskController::class, 'store'])->name('todolist.store');
    Route::post('/todolist/{id}/move', [TaskController::class, 'move']);
    Route::post('/todolist/{id}/update', [TaskController::class, 'update']);
    Route::delete('/todolist/{id}/delete', [TaskController::class, 'destroy']);

    // New Project
    Route::get('/newproject', [NewProjectController::class, 'index'])->name('newproject.index');

    // Card
    Route::post('/cards/store', [CardController::class, 'store'])
    ->name('cards.store');
    Route::delete('/cards/delete/{id}', [CardController::class, 'destroy'])
    ->name('cards.destroy');

    // Log Pergantian Perangkat
    Route::get('/log_perangkat', [LogPerangkatController::class, 'index'])->name('log_perangkat.index');
    Route::post('/log_perangkat/store', [LogPerangkatController::class, 'store'])->name('log_perangkat.store');
    Route::post('/log_perangkat/update/{id}', [LogPerangkatController::class, 'update'])->name('log_perangkat.update');
    Route::get('/log_perangkat/delete/{id}', [LogPerangkatController::class, 'destroy'])->name('log_perangkat.destroy');
    Route::post('/log_perangkat/import', [LogPerangkatController::class, 'import'])->name('log_perangkat.import');
    Route::get('/log_perangkat/export', [LogPerangkatController::class, 'export'])->name('log_perangkat.export');
    Route::get('/log_perangkat', [LogPerangkatController::class, 'search'])->name('log_perangkat');
    Route::get('/sparetracker', [LogPerangkatController::class, 'sparetracker'])->name('sparetracker');

    // Datapass
    Route::get('/datapass', [DatapassController::class, 'index'])->name('datapass.index');
    Route::post('/datapass', [DatapassController::class, 'store'])->name('datapass.store');
    Route::put('/datapass/{id}', [DatapassController::class, 'update'])->name('datapass.update');
    Route::delete('/datapass/{id}', [DatapassController::class, 'destroy'])->name('datapass.destroy');
    Route::post('/datapass/import', [DatapassController::class, 'import'])->name('datapass.import');
    Route::get('/datapass/export', [DatapassController::class, 'export'])->name('datapass.export');
    Route::get('/datapass/search', [DatapassController::class, 'search'])->name('datapass.search');

    // User Profile
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::put('/profile/update', [InfoUserController::class, 'update'])->name('profile.update');
    Route::post('/user/update-photo', [InfoUserController::class, 'updatePhoto'])->name('user.updatePhoto');

    // PM Liberta
    Route::get('/pmliberta', [PmLibertaController::class, 'index'])->name('pmliberta');
    Route::get('/pmliberta/create', [PmLibertaController::class, 'create'])->name('pmliberta.create');
    Route::post('/pmliberta/store', [PmLibertaController::class, 'store'])->name('pmliberta.store');
    Route::get('/pmliberta/{id}/edit', [PmLibertaController::class, 'edit'])->name('pm-liberta.edit');
    Route::put('/pmliberta/{id}', [PmLibertaController::class, 'update'])->name('pmliberta.update');
    Route::delete('/pmliberta/{id}', [PmLibertaController::class, 'destroy'])->name('pmliberta.destroy');
    Route::post('/pmliberta/import', [PmLibertaController::class, 'import'])->name('pmliberta.import');
    Route::get('/pmliberta/export', [PmLibertaController::class, 'export'])->name('pmliberta.export');
    Route::get('/summary', [PmLibertaController::class, 'summary'])->name('summary');
    Route::get('/summary/search', [PmLibertaController::class, 'ajaxSearch']);
    Route::get('/get-datasite/{id}', [App\Http\Controllers\PmLibertaController::class, 'getDataSite']);

    // Sparetracker
    Route::get('/logtracker', [LogspareController::class, 'index'])->name('logtracker');
    Route::get('/logtracker/create', [LogspareController::class, 'create'])->name('logtracker.create');
    Route::post('/logtracker/import', [LogspareController::class, 'import'])->name('logtracker.import');
    Route::get('/logtracker/export', [LogspareController::class, 'export'])->name('logtracker.export');
    Route::put('/logtracker/update', [LogspareController::class, 'update'])->name('logtracker.update');
    Route::delete('/sparetracker/{id}', [LogspareController::class, 'destroy'])->name('sparetracker.destroy');
    Route::get('/logtracker/create', [LogspareController::class, 'create'])->name('logtracker.create');
    Route::post('/logtracker/store', [LogspareController::class, 'store'])->name('logtracker.store');

    // New Project Routes
    Route::get('/newproject', [NewProjectController::class, 'index'])->name('newproject');
    Route::post('/newproject', [NewProjectController::class, 'store'])->name('newproject.store');
    Route::delete('/newproject/{id}', [NewProjectController::class, 'destroy'])->name('newproject.destroy');

    // Site Review
    Route::get('/sitereview', [SiteReviewController::class, 'index'])->name('sitereview.index');
    Route::post('/sitereview/filter', [SiteReviewController::class, 'filter'])->name('sitereview.filter');
    Route::post('/sitereview/store-site', [SiteReviewController::class, 'storeSite'])->name('sitereview.storeSite');

    //Route Laporan Instalasi
    Route::get('/laporaninstalasi', [LaporanInstalasiController::class, 'index'])->name('laporaninstalasi');
    Route::post('/laporaninstalasi/upload-foto', [LaporanInstalasiController::class, 'uploadFoto'])->name('laporan.upload_foto');
    Route::post('/laporan-instalasi/store', [LaporanInstalasiController::class, 'store'])->name('laporaninstalasi.store');
    Route::post('/laporan-instalasi/approve',[LaporanInstalasiController::class, 'approve'])->name('laporaninstalasi.approve');
    Route::post('/laporan-instalasi/reject',[LaporanInstalasiController::class, 'reject'])->name('laporaninstalasi.reject');
    Route::get('/laporan-instalasi/download-word', [LaporanInstalasiController::class, 'downloadWord'])->name('laporan.downloadWord');

    // Route Project Timeline
    Route::get('/timeline', [ProjectTimelineController::class, 'index'])->name('timeline.index');
    Route::post('/timeline/store', [ProjectTimelineController::class, 'store'])->name('timeline.store');

    // Route Jadwal Piket
    Route::get('/jadwal-piket', [JadwalPiketController::class, 'index'])->name('jadwal.piket');

    Route::get('/jadwalpiket', [JadwalPiketController::class, 'index'])->name('jadwal.piket.index');
    Route::post('/jadwal-piket/update', [JadwalPiketController::class, 'update'])->name('jadwal.piket.update');
    Route::post('/jadwal/generate/{tahun}/{bulan}', [JadwalPiketController::class, 'generate'])->name('jadwal.generate');
    Route::get('/jadwal/export-excel', [JadwalPiketController::class, 'exportExcel']);

    // Route Summary Tiket
    Route::get('/summarytiket', [SummaryTiketController::class, 'index'])->name('summarytiket');

    //Route Summary Sparepart
    Route::get('/summaryspare', [SparetrackerController::class, 'summary'])->name('summaryspare');

    Route::get('/aboutus', function () {return view('aboutus');
});
    // Users (Role-based)
    Route::middleware('role:superadmin')->group(function () {
        Route::get('/users', [InfoUserController::class, 'index'])->name('users');
        Route::post('/user', [InfoUserController::class, 'save']);
        Route::put('/user/{id}', [InfoUserController::class, 'saveUpdate']);
        Route::get('/user/delete/{id}', [InfoUserController::class, 'delete'])->name('user.delete');
        Route::get('/api/user/{id}', [InfoUserController::class, 'getUser']);
    });
        Route::middleware(['auth'])->group(function () {
        Route::get('/laporanPM', [LaporanPMController::class, 'index'])->name('laporanPM');
        Route::get('/laporanPM/create', [LaporanPMController::class, 'create'])->name('laporanPM.create');
        Route::post('/laporanPM', [LaporanPMController::class, 'store'])->name('laporanPM.store');
        Route::post('/laporanPM/import', [LaporanPMController::class, 'import'])->name('laporanPM.import');
        Route::get('/laporanPM/export', [LaporanPMController::class, 'export'])->name('laporanPM.export');
        Route::get('/laporanPM/search', [LaporanPMController::class, 'search'])->name('laporanPM.search');

        // Route edit & update
        Route::get('/laporanPM/{id}/edit', [LaporanPMController::class, 'edit'])->name('laporanPM.edit');
        Route::put('/laporanPM/{id}', [LaporanPMController::class, 'update'])->name('laporanPM.update');
    });   
});

