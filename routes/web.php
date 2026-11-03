<?php

use Illuminate\Support\Facades\Route;

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
    return view('frontend.beranda.index');
});
Route::get('/kamar', function () {
    return view('frontend.kamar.kamar');
});
Route::get('/fasilitas', function () {
    return view('frontend.fasilitas.fasilitas');
});
Route::get('/reservasi', function () {
    return view('frontend.reservasi.reservasi');
});
Route::get('/tentang', function () {
    return view('frontend.tentang.tentang');
});
Route::get('/ulasan', function () {
    return view('frontend.ulasan.ulasan');
});
