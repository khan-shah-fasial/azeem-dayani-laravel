<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\backend\ProductController;
use Illuminate\Support\Facades\DB;
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
    //Artisan::call('route:cache');
    //Artisan::call('key:generate');

    return 'Cache cleared successfully!';
});

// Home START
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/filter-products/{categoryId}', [ProductController::class, 'filterProductsByCategory']);

Route::get('/contact-us', [IndexController::class, 'contact_us'])->name('contact_us');
Route::get('/about-us', [IndexController::class, 'about_us'])->name('about_us');
Route::get('/what-we-do', [IndexController::class, 'what_we_do'])->name('what_we_do');

Route::get('/career', [IndexController::class, 'career'])->name('career');
Route::get('/partner-with-us', [IndexController::class, 'partner_with_us'])->name('partner_with_us');
Route::get('/categories', [IndexController::class, 'products_category'])->name('products_category');
Route::get('/products', [IndexController::class, 'products_s'])->name('products_s');


$slug = DB::table('products')->pluck('slug')->toArray();
if (!empty($slug)) {
Route::get('/product/{slug}', [IndexController::class, 'product_detail'])
    ->where('slug', implode('|', $slug ))
    ->name('product.detail');
}

$page_slug = DB::table('pages')->pluck('slug')->toArray();
if (!empty($page_slug)) {
Route::get('/{page_slug}', [IndexController::class, 'page_detail'])
    ->where('slug', implode('|', $page_slug ))
    ->name('page.detail');
}

Route::post('/form-save', [IndexController::class, 'Form_Save'])->name('form.save'); 

// Route::get('/faq', [IndexController::class, 'faq'])->name('faq');
// Route::get('/privacy-policy', [IndexController::class, 'privacy_policy'])->name('privacy-policy');

// Route::get('/terms', [IndexController::class, 'terms_page'])->name('terms');
// Route::get('/refund-policy', [IndexController::class, 'refund_policy'])->name('refund-policy');

Route::get('/404', [IndexController::class, 'not_found'])->name('error_page');
Route::get('/thank-you', [IndexController::class, 'thank_you'])->name('thank_you');
Route::get('/cookie-policy', [IndexController::class, 'cookie_policy'])->name('cookie-policy');
Route::post('/contact-save', [IndexController::class, 'contact_save'])->name('contact.create');
Route::post('/comment-save', [IndexController::class, 'comment_save'])->name('comment.create');

Route::get('/search', [IndexController::class, 'search'])->name('search');
// Home END




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