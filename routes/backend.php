<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthenticateController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\FaqController;
use App\Http\Controllers\backend\TestimonialController;
use App\Http\Controllers\backend\ProductCategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\FrontendSettingsController;

use App\Http\Controllers\backend\TrumbowygController;

use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\BusinessSettingController;

use App\Http\Controllers\backend\AuthorController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\PageController;

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

//authentication
Route::get('/', function () { return redirect(route('backend.login')); });
Route::get('/login', [AuthenticateController::class, 'index'])->name('backend.login');
Route::post('/login', [AuthenticateController::class, 'login'])->name('backend.login');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('backend.logout');

//dashborad
Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

//faq
Route::group(['prefix' => 'faq'], function () {
    Route::get('/index', [FaqController::class, 'index'])->name('faq.index');
    Route::get('/add', [FaqController::class, 'add'])->name('faq.add');
    Route::get('/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::post('/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/update', [FaqController::class, 'update'])->name('faq.update');
    Route::post('/delete/{id}', [FaqController::class, 'delete'])->name('faq.delete');
    Route::get('/status/{id}/{status}', [FaqController::class, 'status'])->name('faq.status');
});


// //Testimonials
// Route::group(['prefix' => 'testimonial'], function () {
//     Route::get('/index', [TestimonialController::class, 'index'])->name('testimonial.index');
//     Route::get('/add', [TestimonialController::class, 'add'])->name('testimonial.add');
//     Route::get('/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
//     Route::post('/create', [TestimonialController::class, 'create'])->name('testimonial.create');
//     Route::post('/update', [TestimonialController::class, 'update'])->name('testimonial.update');
//     Route::post('/delete/{id}', [TestimonialController::class, 'delete'])->name('testimonial.delete');
//     Route::get('/status/{id}/{status}', [TestimonialController::class, 'status'])->name('testimonial.status');
// });


Route::controller(ProductCategoryController::class)->group(function () {
    Route::get('/films-categories', 'index')->name('product-categories.index');
    Route::get('/films-categories/create', 'create')->name('product-categories.create');
    Route::post('/films-categories/store', 'store')->name('product-categories.store');
    Route::get('/films-categories/edit/{id}', 'edit')->name('product-categories.edit');
    Route::post('/films-categories/update/{id}', 'update')->name('product-categories.update');
    Route::post('/films-categories//delete/{id}',  'delete')->name('product-categories.destroy');
});

Route::controller(FrontendSettingsController::class)->group(function () {
    Route::get('/frontend-settings', 'index')->name('frontend_settings.index');
    // Route::get('/frontend-settings/create', 'create')->name('frontend_settings.create');
    // Route::post('/frontend-settings/store', 'store')->name('frontend_settings.store');
    // Route::get('/frontend-settings/edit/{id}', 'edit')->name('frontend_settings.edit');
    Route::post('/frontend-settings/update/{id}', 'update')->name('frontend_settings.update');
    // Route::post('/frontend-settings/update/', 'update')->name('frontend_settings.update');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/films', 'index')->name('products.index');
    Route::get('/films/create', 'create')->name('products.create');
    Route::post('/films/store', 'store')->name('products.store');
    Route::get('/films/edit/{id}', 'edit')->name('products.edit');
    Route::post('/films/update/{id}', 'update')->name('products.update');
    Route::post('/films/delete/{id}',  'delete')->name('products.destroy');
});

Route::controller(PageController::class)->group(function () {
    // Route::get('/custom-pages/{slug}', 'show_custom_page')->name('custom-pages.show_custom_page');
    Route::get('/index', 'index')->name('website.pages');
    Route::get('/create', 'create')->name('custom-pages.create');
    Route::post('/store', 'store')->name('custom-pages.store');
    Route::post('/custom-pages/update/{id}', 'update')->name('custom-pages.update');
    Route::get('/custom-pages/edit/{id}', 'edit')->name('custom-pages.edit');
    Route::post('/custom-pages/destroy/{id}', 'destroy')->name('custom-pages.destroy');
});


//News
Route::group(['prefix' => 'trumbowyg'], function () {
    Route::post('/upload', [TrumbowygController::class, 'upload'])->name('trumbowyg.upload');
});


//Contact
Route::group(['prefix' => 'contact'], function () {
    Route::get('/index', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/view/{id}', [ContactController::class, 'view'])->name('contact.view');
    Route::post('/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
});

//setting
Route::group(['prefix' => 'setting'], function () {
    Route::get('/index', [BusinessSettingController::class, 'index'])->name('setting.index');
    
    Route::get('/privacy-policy', [BusinessSettingController::class, 'privacy_policy'])->name('setting.privacy');
    Route::get('/terms', [BusinessSettingController::class, 'terms'])->name('setting.terms');
    Route::get('/refund-policy', [BusinessSettingController::class, 'refund_policy'])->name('setting.refund_policy');

    Route::post('/update', [BusinessSettingController::class, 'update'])->name('setting.update');
});


//clear cache
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');

    // Redirect back to the previous page
    return back()->with('status', 'Cache cleared successfully!');
})->name('clear-cache');


//Author
Route::group(['prefix' => 'author'], function () {
    Route::get('/index', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/add', [AuthorController::class, 'add'])->name('author.add');
    Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::post('/create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/update', [AuthorController::class, 'update'])->name('author.update');
    Route::post('/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');
    //Route::get('/status/{id}/{status}', [AuthorController::class, 'status'])->name('author.status');
});

//User
Route::group(['prefix' => 'profile'], function () {
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/reset/{id}', [UserController::class, 'password'])->name('user.password');
    Route::post('/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/reset', [UserController::class, 'reset'])->name('user.reset');    
});
