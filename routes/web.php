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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('channels', \App\Http\Controllers\ChannelController::class);
Route::get('videos/{video}', [\App\Http\Controllers\VideoController::class, 'show'])->name('video.show');

Route::middleware('auth')->group(function (){
    Route::resource('channels/{channel}/subscription', \App\Http\Controllers\SubscriptionController::class)->only('store', 'destroy');

    Route::get('upload/{channel}/videos', [\App\Http\Controllers\UploadVideoController::class, 'index'])->name('upload.videos');
    Route::post('upload/{channel}/videos', [\App\Http\Controllers\UploadVideoController::class, 'store']);
});
