<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Absensi;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'auth'], function () {
    Route::get('absensi', Absensi::class)->name('absensi');
});
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/dashboard', function () {
    return redirect('admin');
})->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});
