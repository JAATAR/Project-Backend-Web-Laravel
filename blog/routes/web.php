<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

Route::get('/post_page',[HomeController::class, 'post_page']);
Route::post('/add_post',[HomeController::class, 'add_post']);
Route::get('/show_post',[HomeController::class, 'show_post']);
Route::get('/delete_post/{id}',[HomeController::class, 'delete_post']);
Route::get('/edit_page/{id}',[HomeController::class, 'edit_page']);
Route::post('/Update_post/{id}',[HomeController::class, 'update_post']);





Route::get('/contacts', [ContactUsController::class, 'create'])->name('contacts.contact-us');

Route::post('/contacts', [ContactUsController::class, 'store'])->name('contacts.store');



Route::middleware(['auth','admin'])->group(function(){



});

//FAQ Page
Route::get('/faq', [FaqController::class, 'showFaqPage'])->name('faq.faqPage');

//category create
Route::get('/faq/create', [FaqController::class, 'createCategory'])->name('faq.create-category');

//store category
Route::post('/faq/create/store', [FaqController::class, 'storeCategory'])->name('faq.store-category');

//item form
Route::get('/faq/{category}/create-item', [FaqController::class, 'createItem'])->name('faq.create-item');

//item store
Route::post('/faq/{category}/create-item', [FaqController::class, 'storeItem'])->name('faq.store-item');

//delete category
Route::delete('/faq/category/{category}', [FaqController::class, 'deleteCategory'])->name('faq.delete-category');

// Delete Item
Route::delete('/faq/item/{item}', [FaqController::class, 'deleteItem'])->name('faq.delete-item');



//promote user to admin
Route::post('/users/{user}/promote', [UserController::class, 'promoteUser'])->name('users.promote');



Route::get('/about',function(){
    return view('about');
});

require __DIR__.'/auth.php';
