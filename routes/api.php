<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


// URUNLER KISMI
Route::group(["prefix"=>"urunler","namespace"=>"urunler","as"=>"urunler."],function (){
    Route::get("",[\App\Http\Controllers\api\urunler\indexController::class,'index'])->name('');
});

// SEPET KISMI
Route::group(["prefix"=>"sepet","namespace"=>"sepet","as"=>"sepet."],function (){
    Route::get("",[\App\Http\Controllers\api\sepet\indexController::class,'index'])->name('');
    Route::post("ekle",[\App\Http\Controllers\api\sepet\indexController::class,'store'])->name('store');
    Route::get("navbar-sepet",[\App\Http\Controllers\api\sepet\indexController::class,'getNavbarSepet'])->name('navbar_sepet');
    Route::post("guncelle/{id}",[\App\Http\Controllers\api\sepet\indexController::class,'guncelle'])->name('guncelle');
    Route::delete("kaldir/{id}",[\App\Http\Controllers\api\sepet\indexController::class,'delete'])->name('delete');
});
