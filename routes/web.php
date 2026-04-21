<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', function () {
    return view('form_page1');
});

Route::get('/form/data', function () {
    return view('form_page2');
});

Route::get('/equation', function () {
    return view('equation');
});
