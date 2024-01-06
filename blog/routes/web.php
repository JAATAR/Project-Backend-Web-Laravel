<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\DashboardController;

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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');
    Route::get('/profile/{user}', [DashboardController::class, 'showProfile'])->name('profile.profile');

});

/*

Route::get('post', [PostController::class,'post'])->
middleware([ 'auth','admin']);

Route::get('/post_details/{id}', [PostController::class,'post_details']);

Route::get('/create_post', [PostController::class,'create_post']) ->middleware('auth');

Route::post('/user_post', [PostController::class,'user_post']);

Route::get('/post_page', [AdminController::class,'post_page']);

Route::post('/add_post', [AdminController::class,'add_post']);

Route::get('/show_post', [AdminController::class,'show_post']);

Route::get('/delete_post/{id}', [AdminController::class,'delete_post']);

Route::get('/edit_page/{id}', [AdminController::class,'edit_page']);

Route::post('/update_post/{id}', [AdminController::class,'update_post']);

*/



Route::get('/contacts', [ContactController::class, 'create'])->name('contacts.contact-us');

Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');



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


//create post
Route::get('/posts/create', [PostController::class, 'showPostForm'])->name('posts.create');
Route::get('/posts', [PostController::class, 'store'])->name('posts.store');

//edit post
Route::get('/posts/{post}/edit', [PostController::class, 'editPost'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'updatePost'])->name('posts.update');

//delete post
Route::delete('post/{post}', [PostController::class, 'deletePost'])->name('posts.delete');

//promote user to admin
Route::post('/users/{user}/promote', [UserController::class, 'promoteUser'])->name('users.promote');



Route::get('/about',function(){
    return view('about');
});

require __DIR__.'/auth.php';
