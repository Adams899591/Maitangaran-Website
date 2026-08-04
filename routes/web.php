<?php

use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix("page")->group(function(){
    Route::get('/home', Home::class)->name("home");
});
