<?php

use Illuminate\Support\Facades\Route;

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


// USING REST ROUTING

Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);

Route::get('/email', function() {
  return new App\Mail\NewUserWelcomeMail();
} );

Route::get('/profile/{user}/index', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.show');
// {user} is an arguement that is passed in the ProfileController class' index function
// this si the home page of the active user on instagram

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/p/create', [App\Http\Controllers\PostController::class, 'create'])->name('p.create');

Auth::routes();
Route::post('/p', [App\Http\Controllers\PostController::class, 'store'])->name('p.store');

Auth::routes();
Route::get('/p/{posts}/{user}/show', [App\Http\Controllers\PostController::class, 'show'])->name('p.show');

Auth::routes();
Route::get('/p/{post}/{user}/createComment', [App\Http\Controllers\CommentController::class, 'create'])->name('p.create');

Auth::routes();
Route::post('/p/{post}/{user}/storeComment', [App\Http\Controllers\CommentController::class, 'store'])->name('p.store');

Auth::routes();
Route::get('/p/{posts}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('p.destroy');

Route::get('/p/{comment}/{post}/editComment', [App\Http\Controllers\CommentController::class, 'edit'])->name('p.edit');

Route::patch('/p/{comment}/{post}/updateComment', [App\Http\Controllers\CommentController::class, 'update'])->name('p.update');

Route::post('/React/{user}/{post}/store', [App\Http\Controllers\ReactController::class, 'store'])->name('React.store');

Route::post('/commentReact/{comment}/store', [App\Http\Controllers\CommentReactController::class, 'store'])->name('commentReact.store');

Auth::routes();
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

Auth::routes();
Route::patch('/profile/{user}/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Auth::routes();
Route::post('/follow/{user}/store', [App\Http\Controllers\FollowsController::class, 'store'])->name('follow.store');

Auth::routes();
Route::get('/p/{posts}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');

Auth::routes();
Route::patch('/p/{posts}/update', [App\Http\Controllers\PostController::class, 'update'])->name('p.update');

Auth::routes();
Route::get('/p/{comment}/{post}/destroyComment', [App\Http\Controllers\CommentController::class, 'destroy'])->name('p.destroy');

Auth::routes();
Route::get('/p/{post}/{comment}/createReply', [App\Http\Controllers\ReplyController::class, 'create'])->name('p.create');

Auth::routes();
Route::post('/p/{post}/{comment}/storeReply', [App\Http\Controllers\ReplyController::class, 'store'])->name('p.store');

Auth::routes();
Route::get('/p/{reply}/{comment}/{post}/editReply', [App\Http\Controllers\ReplyController::class, 'edit'])->name('p.edit');

Auth::routes();
Route::patch('/p/{reply}/{comment}/{post}/updateReply', [App\Http\Controllers\ReplyController::class, 'update'])->name('p.update');

Auth::routes();
Route::get('/p/{reply}/{comment}/{post}/destroyReply', [App\Http\Controllers\ReplyController::class, 'destroy'])->name('p.destroy');


Auth::routes();
Route::get('/p/{comment}', [App\Http\Controllers\CommentController::class, 'showReacts'])->name('p.show');
