<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobOpeningController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/csrf', function() {
    return json_encode(['CSRF' => csrf_token()]);
});

Route::controller(Controller::class)->group(function() {
    Route::get('/', 'login');
    Route::get('/login', 'login');
    Route::get('/dashboard', 'dashboard');
    Route::post('/auth', 'auth');
    Route::get('/logout', 'logout');
    Route::get('/register', 'register');
    Route::post('/user/store', 'frontendregister');
    Route::get('/user/{email}/job/{job}', 'userprofile');
});

Route::controller(JobOpeningController::class)->group(function() {
    Route::get('/job/create', 'create');
    Route::get('/job/edit/{uuid}', 'edit');
    Route::get('/job', 'index');
    Route::get('/job/get_active','get_active');
    Route::post('/job/store','store');
    Route::post('/job/update/{uuid}','update');
    Route::get('/job/applied', 'applied');
    Route::get('/job/{uuid}','show');
    Route::get('/job/deactivate/{uuid}','deactivate');
    Route::get('/job/activate/{uuid}','activate');
    Route::get('/job/done/{uuid}','done');
    Route::get('/job/apply/{uuid}','apply');
});

Route::controller(JobApplicationController::class)->group(function() {
    Route::get('/user/profile', 'index');
    Route::post('/user/profile/store', 'store');
    Route::post('/user/profile/storemisc', 'storemisc');
    Route::post('/user/profile/storeedu', 'storeedu');
    Route::post('/user/profile/storeworkexp', 'storeworkexp');
    Route::post('/user/profile/storeorghist', 'storeorghist');
    Route::post('/user/profile/storeachievement', 'storeachievement');
    Route::post('/user/profile/storefamily', 'storefamily');
});
