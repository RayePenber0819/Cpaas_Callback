<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakutenSmsCallbackController;

Route::post('/rakuten/sms/callback', [RakutenSmsCallbackController::class, 'store']);
