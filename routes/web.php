<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Mail;

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
Route::get('/create-storage-link', function () {
    try {
        $exitCode = Artisan::call('storage:link');

        if ($exitCode === 0) {
            return 'Storage link created successfully.';
        } else {
            return 'Error creating storage link. Exit code: ' . $exitCode;
        }
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');

    return 'Cache cleared successfully!';
});

// Home START
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/contact-us', [IndexController::class, 'contact_us'])->name('contact_us');
Route::get('/about-us', [IndexController::class, 'about_us'])->name('about_us');
Route::get('/works', [IndexController::class, 'works_page'])->name('works');

Route::get('/achievements-accolades', [IndexController::class, 'achievements_page'])->name('achievements');
Route::get('/gallery', [IndexController::class, 'gallery_page'])->name('gallery');
Route::get('/contact-us', [IndexController::class, 'contact_us_page'])->name('contact-us');

Route::get('/404', [IndexController::class, 'not_found'])->name('error_page');
// Route::get('/thank-you', [IndexController::class, 'thank_you'])->name('thank_you');

Route::post('/contact-save', [IndexController::class, 'contact_save'])->name('contact.create');

Route::get('/key-generate', function () {
    Artisan::call('key:generate', ['--show' => true]);
    return 'Application key generated successfully!';
});

Route::get('/send-test-email', function () {
    Mail::raw('Test email content', function ($message) {
        $message->to('khanfaisal.makent@gmail.com')
                ->subject('Test Email');
    });

    return 'Test email sent!';
});