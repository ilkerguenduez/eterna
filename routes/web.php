<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiDataController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fetch-data', [ApiDataController::class, 'fetchData']);
