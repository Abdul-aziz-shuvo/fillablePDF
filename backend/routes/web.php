<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/print', [PDFController::class,'printPDF']);
Route::post('/capture', [PDFController::class,'capture']);