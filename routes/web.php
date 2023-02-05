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
Route::controller(NewsController::class)->prefix('admin')->group(function() {
    Route::get('news/create', 'add');
});

use App\Http\Controllers\Admin\AAAController;
Route::controller(AAAController::class)->prefix('admin')->group(function(){
    Route::get('XXX/XXX','bbb');
});

use App\Http\Controllers\Admin\ProfileController;
Route::controller(ProfileController::class)->prefix('admin')->group(function(){
    Route::get('profile/create','add');
    Route::get('profile/edit','edit');
});