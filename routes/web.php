<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;

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
    return view('auth.home');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';


Route::get('/',[ShopController::class,'index']);
Route::get('/owner/home',[OwnerController::class,'index']);
Route::get('/admin/home',[AdminController::class,'index']);
Route::get('reservationdatails/{id}',[ReserveController::class,'reservationDatails'])->name('reservationdatails');




