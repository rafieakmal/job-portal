<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\OauthController;
use Laravel\Socialite\Facades\Socialite;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CandidateController::class)->group(function () {
    Route::POST('/candidate/validation', 'validateUser');
    Route::POST('/candidate/registration', 'registration');
    Route::POST('/candidate/login', 'login');
    Route::POST('/candidate/send-code', 'sendCode');
    Route::POST('/candidate/get-code', 'getCode');
    Route::POST('/candidate/verify-code', 'verifyCode');
    Route::POST('/candidate/resend-code', 'generateNewCode');
    Route::POST('/candidate/reset-password', 'reset');
    Route::GET('/candidate/redirect/reset-password', 'redirectResetPassword')->name('password.reset');
    Route::POST('/candidate/reset-password-link', 'sendPasswordResetLink');
});

Route::controller(OauthController::class)->group(function () {
    Route::POST('/google-redirect', 'googleRedirect')->name('google.redirect');
    Route::GET('/google-callback', 'googleCallback')->name('google.callback');
});