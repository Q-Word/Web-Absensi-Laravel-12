<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Absensi;

Route::group(['middleware' => 'auth'], function() {
    Route::get('absensi', Absensi::class)->name('absensi');

});

Route::get('/', function () {
    return view('welcome');
});
