<?php

use Assurdeal\SailHttps\Http\Controllers\SslCheckController;
use Illuminate\Support\Facades\Route;

Route::get('sail-https/ssl-check', SslCheckController::class)
    ->name('sail-https.ssl-check');
