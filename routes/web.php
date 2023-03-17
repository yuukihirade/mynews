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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Admin\NewsController;
Route::controller(NewsController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('news/create', 'add')->name('news.add');
    Route::post('news/create', 'create')->name('news.create');
    Route::get('news', 'index')->name('news.index');
    Route::get('news/edit', 'edit')->name('news.edit');
    Route::post('news/edit', 'update')->name('news.update');
    Route::get('news/delete', 'delete')->name('news.delete');
});

// use App\Http\Controllers\Admin\AAAController;
// Route::controller(AAAController::class)->prefix('admin')->group(function(){
//     Route::get('XXX/XXX','bbb');
// });

use App\Http\Controllers\Admin\ProfileController;
Route::controller(ProfileController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::get('profile/create','add')->name('profile.add');
    Route::get('profile', 'index')->name('profile.index');
    Route::post('profile/create','create')->name('profile.create');
    Route::get('prlfile/edit','edit')->name('profile.edit');
    Route::post('profile/edit','update')->name('profile.update');
    Route::get('profile/delete', 'delete')->name('profile.delete');
});

use App\Http\Controllers\Admin\TweetController;
Route::controller(TweetController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::get('tweet/create','add')->name('tweet.add');
    Route::post('tweet/create','create')->name('tweet.create');
    Route::get('tweet', 'index')->name('tweet.index');
    Route::get('tweet/edit', 'edit')->name('tweet.edit');
    Route::post('tweet/edit', 'update')->name('tweet.update');
    Route::get('tweet/delete', 'delete')->name('tweet.delete');
});

use App\Http\Controllers\NewsController as PublicNewsController;
Route::get('/',[PublicNewsController::class, 'index'])->name('news.index');

use App\Http\Controllers\ProfileController as PublicProfileController;
Route::get('/profile', [PublicProfileController::class, 'index'])->name('profile.index');

use App\Http\Controllers\TweetController as PublicTweetController;
Route::get('/tweet', [PublicTweetController::class, 'index'])->name('tweet.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
