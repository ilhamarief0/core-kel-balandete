<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\ContactUsController as BackendContactUsController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\InformasiKelurahanController;
use App\Http\Controllers\backend\MasterDataStatistikKelurahanController;
use App\Http\Controllers\backend\NewsController;
use App\Http\Controllers\Backend\PositionController;
use App\Http\Controllers\backend\ServiceController;
use App\Http\Controllers\backend\TeamController;
use App\Http\Controllers\backend\UsersController;
use App\Http\Controllers\backend\WebsiteSettingController;
use App\Http\Controllers\ckEditorUploadController;
use App\Http\Controllers\frontend\AboutController as FrontendAboutController;
use App\Http\Controllers\frontend\AdministrasiController;
use App\Http\Controllers\frontend\ContactUsController;
use App\Http\Controllers\frontend\InformasiKelurahanController as FrontendInformasiKelurahanController;
use App\Http\Controllers\frontend\LandingPageController;
use App\Http\Controllers\frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\frontend\ServiceController as FrontendServiceController;
use App\Http\Controllers\frontend\TeamController as FrontendTeamController;
use Illuminate\Support\Facades\Route;

Route::post('uploadckEditorImage', [ckEditorUploadController::class, 'upload'])->name('uploadCkeditorImage');

Route::get('informasiKelurahan/{slug}', [FrontendInformasiKelurahanController::class, 'detail'])->name('informasiKelurahan.detail');
Route::get('news/{slug}', [FrontendNewsController::class, 'detail'])->name('news.detail');
Route::get('news', [FrontendNewsController::class, 'index'])->name('news.index');
Route::get('service/{service}', [FrontendServiceController::class, 'index'])->name('service.index');
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage.index');
Route::get('about', [FrontendAboutController::class, 'index'])->name('about.index');
Route::get('team', [FrontendTeamController::class, 'index'])->name('team.index');
Route::get('contactus', [ContactUsController::class, 'index'])->name('contactus.index');
Route::post('contactus/submit', [ContactUsController::class, 'submit'])->name('contactus.submit');

Route::get('administrasi', [AdministrasiController::class, 'index'])->name('administrasi.index');

Route::name('auth.')->group(function(){

  Route::post('login', [LoginController::class,'LoginAction'])->name('login.LoginAction');
  Route::post('logout', [LogoutController::class, 'logout'])->name('logout.action');
  Route::get('login', [LoginController::class, 'index'] )->name('login.index');
});

Route::middleware('auth')->prefix('backend/')->name('backend.')->group(function(){

  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
  Route::resource('users', UsersController::class);
  Route::resource('websiteSetting', WebsiteSettingController::class);
  Route::resource('news', NewsController::class);

  Route::get('banner/dataTable', [BannerController::class, 'dataTable'])->name('banner.dataTable');
  Route::post('banner/delete', [BannerController::class, 'delete'])->name('banner.delete');
  Route::resource('banner', BannerController::class);

  Route::resource('service', ServiceController::class);

    Route::prefix('jabatan')->name('jabatan.')->group(function () {
        Route::get('/', [PositionController::class, 'index'])->name('index');
        Route::post('/', [PositionController::class, 'store'])->name('store');
        Route::put('/{id}', [PositionController::class, 'update'])->name('update');
        Route::delete('/{id}', [PositionController::class, 'destroy'])->name('destroy');
        Route::post('/update-order', [PositionController::class, 'updateOrder'])->name('update-order');
        Route::post('/update-division-order', [PositionController::class, 'updateDivisionOrder'])->name('update-division-order');
    });

    Route::resource('contactus', BackendContactUsController::class);
    Route::get('contact/dataTable', [BackendContactUsController::class, 'dataTable'])->name('contactus.dataTable');
    Route::post('contactus/markAsRead', [BackendContactUsController::class, 'markAsRead'])->name('contactus.markAsRead');

    Route::resource('about', AboutController::class);
    Route::resource('team', TeamController::class);

    Route::get('masterData/statistikKelurahan', [MasterDataStatistikKelurahanController::class, 'index'])->name('masterdata.statistik.index');
    Route::get('informasiKelurahan/dataTable', [InformasiKelurahanController::class, 'dataTable'])->name('informasiKelurahan.dataTable');
    Route::resource('informasiKelurahan', InformasiKelurahanController::class);
});

