<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\ContactController;

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

Route::get('/test', function () {
    return view('test');
});

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts/create', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::post('/contacts/edit/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::get('/contacts/delete', [ContactController::class, 'deleteIndex'])->name('contacts.delete');
Route::post('/contacts/delete/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
