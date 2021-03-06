<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/thanks', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

Route::get('/datail/:{id}',[ShopController::class,'getData']);

Route::post('/reserve',[ReserveController::class,'addReserve']);

Route::get('/mypage',[ReserveController::class,'myPage']);

Route::post('/reserved/delete/{id}',[ReserveController::class,'delete']);

Route::get('/reservationchange/{id}',[ReserveController::class,'getChange']);

Route::post('/reservationchange/{id}',[ReserveController::class,'update']);

Route::post('/favorite/add/{id}',[FavoriteController::class,'add']);

Route::post('/favorite/delete/{id}',[FavoriteController::class,'delete']);

Route::get('/evaluation/{id}',[EvaluationController::class,'index']);

Route::post('/evaluation',[EvaluationController::class,'create']);

Route::get('/owner/home',[OwnerController::class,'index']);

Route::get('/admin/home',[AdminController::class,'index']);

Route::post('/addowner',[AdminController::class,'addOwner']);

Route::post('/shopinfocreate',[OwnerController::class,'shopCreate']);

Route::get('/shopupdate/{id}',[OwnerController::class,'shopUpdate']);

Route::post('/shopupdate/{id}',[OwnerController::class,'shopInfoUpdate']);

Route::get('/reservationinfo/{id}',[OwnerController::class,'getReservation']);

Route::get('/mailform/{id}',[MailController::class,'index']);

Route::post('/mailconfirm',[MailController::class,'confirm']);

Route::post('/sendmail',[MailController::class,'send']);

Route::get('qrcode/{id}',[ReserveController::class,'showQr']);

Route::post('/pay', function (Request $request){
  $request->user()->charge($request->price, $request->paymentMethodId);
  return redirect('/');
});