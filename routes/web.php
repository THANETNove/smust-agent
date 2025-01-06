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
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

use App\Models\Province;
use App\Models\Amphure;
use App\Models\District;



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

    /*   $welcomeQuery = DB::table('rent_sell_home_details')
        ->where('rent_sell_home_details.status_home', 'on')
        ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
        ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
        ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
        ->select(
            'rent_sell_home_details.*',
            'provinces.name_th AS provinces_name_th',
            'districts.name_th AS districts_name_th',
            'amphures.name_th AS amphures_name_th'
        )
        ->orderBy('rent_sell_home_details.id', 'DESC')
        ->limit(13) // จำกัดผลลัพธ์เป็น 12 รายการ
        ->get(); */


    /* $provinces = Province::pluck('name_th', 'id');
    $amphures = Amphure::pluck('name_th', 'id');
    $districts = District::pluck('name_th', 'id');
 */
    $provinces = Cache::remember('provinces', 60 * 60, function () {
        return DB::table('provinces')->pluck('name_th', 'id');
    });

    $amphures = Cache::remember('amphures', 60 * 60, function () {
        return DB::table('amphures')->pluck('name_th', 'id');
    });

    $districts = Cache::remember('districts', 60 * 60, function () {
        return DB::table('districts')->pluck('name_th', 'id');
    });


    $welcomeQuery = DB::table('rent_sell_home_details')
        ->where('status_home', 'on')
        ->orderBy('id', 'DESC')
        ->limit(13)
        ->get()
        ->map(function ($item) use ($provinces, $amphures, $districts) {
            $item->provinces_name_th = $provinces[$item->provinces] ?? null;
            $item->amphures_name_th = $amphures[$item->amphures] ?? null;
            $item->districts_name_th = $districts[$item->districts] ?? null;
            return $item;
        });


    $professionals = DB::table('website_professionals')
        ->first();
    $asked = DB::table('frequently_asked_questions')
        ->get();
    $words = DB::table('words_smust_users')
        ->get();


    return view('welcome', compact('welcomeQuery', 'professionals', 'asked', 'words'));
});






Route::get('/home-login', function () {

    return view('welcomeLogin');
});
/* Route::get('/co-agent-succeed', function () {
    $member = DB::table('rent_sell_home_details')
        ->where('rent_sell_home_details.status_home', 'on')
        ->where('rent_sell_home_details.id', '1892')
        ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
        ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
        ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
        ->select(
            'rent_sell_home_details.*',
            'provinces.name_th AS provinces_name_th',
            'districts.name_th AS districts_name_th',
            'amphures.name_th AS amphures_name_th'
        )
        //->orderBy('rent_sell_home_details.id', 'DESC')
        ->first(); // ดึงแค่แถวเดียว

    $countUser = DB::table('users')->count();
    return view('co-agent.succeed', compact('member', 'countUser'));
});


 */


Auth::routes();
// ส่วนของนายหน้า
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/search-data', [HomeController::class, 'index'])->name('search-data');
Route::get('/search-data', [HomeController::class, 'index'])->name('search-data');
Route::get('/search-favorites', [HomeController::class, 'indexFavorites'])->name('search-favorites');
Route::get('/new-wealth', [HomeController::class, 'newWealth'])->name('new-wealth');
Route::get('/new-co-agent', [HomeController::class, 'newCoAgent'])->name('new-co-agent');
Route::get('/help-co-agent', [HomeController::class, 'helpCoAgent'])->name('help-co-agent');
Route::get('/delete-help-co-agent', [HomeController::class, 'deleteHelpCoAgent'])->name('delete-help-co-agent');
Route::get('/search-name', [HomeController::class, 'indexName'])->name('search-name');
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
Route::post('/assets-customer-store', [AssetsCustomersWantController::class, 'store'])->name('assets-customer-store');
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
Route::get('co-users', [CoAgentController::class, 'coUsers'])->name('co-users');
Route::post('submit-data', [CoAgentController::class, 'submitData'])->name('submit-data');
Route::get('destroy-announcement/{id}', [CoAgentController::class, 'destroy'])->name('destroy-announcement');
Route::put('report-product-update/{id}', [ReportPropertySoldController::class, 'update'])->name('report-product-update');
Route::put('caption-update/{id}', [CaptionController::class, 'update'])->name('caption-update');
Route::get('click-favorite/{id}', [FavoriteController::class, 'update'])->name('click-favorite');
Route::get('house-condo', [WelcomeController::class, 'houseCondo'])->name('house-condo');
Route::post('house-condo', [WelcomeController::class, 'houseCondo'])->name('house-condo');
Route::get('house-condo-details/{id}', [WelcomeController::class, 'houseCondoDetails'])->name('house-condo-details');
Route::get('skilled-brokers', [WelcomeController::class, 'skilledBrokers'])->name('skilled-brokers');
Route::get('contact-premium', [WelcomeController::class, 'contactPremium'])->name('contact-premium');
Route::post('contact-premium', [WelcomeController::class, 'contactPremium'])->name('contact-premium');
Route::get('premium-agent-home/{id}', [WelcomeController::class, 'premiumAgentHome'])->name('premium-agent-home');
Route::get('view-all-assets/{id}', [WelcomeController::class, 'viewAllAssets'])->name('view-all-assets');
Route::get('interested-more', [WelcomeController::class, 'interestedMore'])->name('interested-more');


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
