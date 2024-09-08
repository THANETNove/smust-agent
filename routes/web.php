<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RegisterBrokerController;
use App\Http\Controllers\RentSellHouseController;
use App\Http\Controllers\UserBrokerController;
use App\Http\Controllers\ForgotYourPasswordController;
use App\Http\Controllers\FreeTrialRightsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetsCustomersWantController;
use App\Http\Controllers\PersonalWebsiteController;
use App\Http\Controllers\PostContentController;
use App\Http\Controllers\CoAgentController;
use App\Http\Controllers\ReportPropertySoldController;
use App\Http\Controllers\CaptionController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {

    return view('welcome');
});
Route::get('/HomeLogin', function () {

    return view('welcomeLogin');
});

Route::get('/HomeLogin', function () {

    return view('welcomeLogin');
});




Auth::routes();
// ส่วนของนายหน้า
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/search-data', [HomeController::class, 'index'])->name('search-data');
Route::get('/search-data', [HomeController::class, 'index'])->name('search-data');
Route::get('/search-favorites', [HomeController::class, 'indexFavorites'])->name('search-favorites');
Route::get('/reset-password', [ForgotYourPasswordController::class, 'index'])->name('reset-password');
Route::post('/reset-check-password', [ForgotYourPasswordController::class, 'resetCheck'])->name('reset-check-password');
Route::get('/reset-check-passwordId/{id}', [ForgotYourPasswordController::class, 'edit'])->name('reset-check-passwordId');
Route::put('/reset-new-password/{id}', [ForgotYourPasswordController::class, 'store'])->name('reset-new-password');
Route::get('/get-detall/{id}', [HomeController::class, 'show'])->name('get-detall');
Route::post('/home', [HomeController::class, 'index'])->name('search');
Route::get('/register-broker/{id}', [RegisterBrokerController::class, 'index'])->name('register-broker');
Route::post('/add-register-broker', [RegisterBrokerController::class, 'store'])->name('add-register-broker');
Route::get('/profile-user', [UserBrokerController::class, 'index'])->name('profile-user');
Route::post('/add-code_admin', [UserBrokerController::class, 'store'])->name('add-code_admin');
Route::get('/free-trial', [FreeTrialRightsController::class, 'index'])->name('/free-trial');
Route::get('/plans-all', [FreeTrialRightsController::class, 'plansAll'])->name('/plans-all');
Route::get('/edit-profile', [ProfileController::class, 'index'])->name('/edit-profile');
Route::put('/new-setup-profile/{id}', [ProfileController::class, 'update'])->name('new-setup-profile');
Route::get('/assets-customer', [AssetsCustomersWantController::class, 'index'])->name('assets-customer');
Route::get('/create-assets-customer', [AssetsCustomersWantController::class, 'create'])->name('create-assets-customer');
Route::post('/co-agent-store', [AssetsCustomersWantController::class, 'store'])->name('co-agent-store');
Route::post('/assets-customer', [AssetsCustomersWantController::class, 'index'])->name('assets-customer');
Route::get('/personal-website', [PersonalWebsiteController::class, 'index'])->name('personal-website');
Route::get('/create-personal', [PersonalWebsiteController::class, 'create'])->name('create-personal');
Route::post('/convenient-area', [PersonalWebsiteController::class, 'store'])->name('convenient-area');
Route::put('/convenient-area-update/{id}', [PersonalWebsiteController::class, 'update'])->name('convenient-area-update');
Route::post('/services-area', [PersonalWebsiteController::class, 'storeServices'])->name('services-area');
Route::put('/services-area-update/{id}', [PersonalWebsiteController::class, 'updateServices'])->name('services-area-update');
Route::get('create_post', [PostContentController::class, 'index'])->name('post-create');
Route::get('post-create', [PostContentController::class, 'create'])->name('create_post');
Route::put('edit-post-update/{id}', [PostContentController::class, 'update'])->name('edit-post-update');
Route::get('edit-post/{id}', [PostContentController::class, 'edit'])->name('edit-post');
Route::post('new-post-store', [PostContentController::class, 'store'])->name('new-post-store');
Route::get('destroy-post/{id}', [PostContentController::class, 'destroy'])->name('destroy-post');
Route::get('radio-updated_at/{id}', [PostContentController::class, 'updatedAt'])->name('radio-updated_at');
Route::get('/get-districts/{id}', [CoAgentController::class, 'districts'])->name('get-districts');
Route::get('/get-amphures/{id}', [CoAgentController::class, 'amphures'])->name('get-amphures');
Route::get('co-agent', [CoAgentController::class, 'index'])->name('co-agent');
Route::get('co-create', [CoAgentController::class, 'create'])->name('co-create');
Route::post('co-agent-store', [CoAgentController::class, 'store'])->name('co-agent-store');
Route::put('report-product-update/{id}', [ReportPropertySoldController::class, 'update'])->name('report-product-update');
Route::put('caption-update/{id}', [CaptionController::class, 'update'])->name('caption-update');
Route::get('click-favorite/{id}', [FavoriteController::class, 'update'])->name('click-favorite');


//ส่วนของ admin
Route::group(['middleware' => ['is_admin']], function () {
    Route::get('/create-content', [RentSellHouseController::class, 'create'])->name('create-content');
    Route::post('/add-content', [RentSellHouseController::class, 'store'])->name('add-content');
    Route::get('/edit/{id}', [RentSellHouseController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [RentSellHouseController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [RentSellHouseController::class, 'destroy'])->name('destroy');
    Route::get('/profile-admin', [RentSellHouseController::class, 'profileAdmin'])->name('profile-admin');
    Route::get('/delete-code/{id}', [RentSellHouseController::class, 'destroyCode'])->name('delete-code');
});
//  ส่วนของ owner
Route::group(['middleware' => ['is_owner']], function () {
    Route::get('/add-admin', [OwnerController::class, 'index'])->name('add-admin');
    Route::get('/change-admin/{id}', [OwnerController::class, 'changeAdmin'])->name('change-admin');
    Route::get('/cancel-admin/{id}', [OwnerController::class, 'cancelAdmin'])->name('cancel-admin');
    Route::post('/search-user', [OwnerController::class, 'index'])->name('search-user');
});