<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlbumController;

use App\Http\Controllers\collections\PhotoController;

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


Route::group(['middleware'=>'auth'],function()
{

    Route::resource('album',AlbumController::class);


    Route::resource('photos',PhotoController::class);
    
    Route::post('deleteAll',[AlbumController::class,'deleteAll'])->name('deleteAll');
});






