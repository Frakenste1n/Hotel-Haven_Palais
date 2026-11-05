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
    return view('user.beranda.index');
});
Route::get('/kamar', function () {
    return view('user.kamar.kamar');
});
Route::get('/fasilitas', function () {
    return view('user.fasilitas.fasilitas');
});
Route::get('/reservasi', function () {
    return view('user.reservasi.reservasi');
});
Route::get('/tentang', function () {
    return view('user.tentang.tentang');
});
Route::get('/ulasan', function () {
    return view('user.ulasan.ulasan');
});
Route::get('/login', function () {
    return view('user.login.login');
});
Route::get('/login/register', function () {
    return view('user.login.register');
});
Route::get('/beranda/listkamar', function () {
    return view('user.beranda.listkamar');
});
