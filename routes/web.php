<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;

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

Route::post('/calculate', [CalculatorController::class, 'calculate']);
Route::get('/calculator', function () {
    return view('calculator');
});
