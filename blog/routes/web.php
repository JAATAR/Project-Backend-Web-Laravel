<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
//Latest News

Route::get('/post_page',[HomeController::class, 'post_page']);
Route::post('/add_post',[HomeController::class, 'add_post']);
Route::get('/show_post',[HomeController::class, 'show_post']);
Route::get('/delete_post/{id}',[HomeController::class, 'delete_post']);
Route::get('/edit_page/{id}',[HomeController::class, 'edit_page']);
Route::post('/Update_post/{id}',[HomeController::class, 'update_post']);



//Contact Form

Route::get('/contacts', [ContactUsController::class, 'create'])->name('contacts.contact-us');

Route::post('/contacts', [ContactUsController::class, 'store'])->name('contacts.store');



Route::middleware(['auth','admin'])->group(function(){



});

//FAQ Page
Route::get('/faq', [FaqController::class, 'faq_page']);
Route::post('/add_category', [FaqController::class, 'add_category']);
Route::get('/show_faq',[FaqController::class, 'show_faq']);
Route::get('/delete_faq/{id}',[FaqController::class, 'delete_faq']);
Route::get('/edit_faq/{id}',[FaqController::class, 'edit_faq']);
Route::post('/update_faq/{id}',[FaqController::class, 'update_faq']);




//promote user to admin
Route::get('/admin/promote',[AdminController::class, 'showPromotion'])->name('admin.promote');
Route::post('/admin/promote',[AdminController::class, 'submitPromotion'])->name('admin.promote.submit');



Route::get('/about',function(){
    return view('about');
});

require __DIR__.'/auth.php';
