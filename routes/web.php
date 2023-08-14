<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminauthController;
use App\Http\Controllers\admin\AdmindashboardController;
use App\Http\Controllers\frontend\UserauthController;
use App\Http\Controllers\frontend\DashboardController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\HomeController;



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

//===============Frontend Routes ==============
Route::get('/', [UserauthController::class, 'index'])->name('user.login');
Route::post('do-login', [UserauthController::class, 'doLogin'])->name('user.doLogin');

Route::get('registration', [UserauthController::class, 'registration'])->name('user.register');
Route::post('post-registration', [UserauthController::class, 'postRegistration'])->name('user.register.post'); 

Route::match(['get', 'post'],'forgotPassword', [UserauthController::class, 'forgotPassword'])->name('user.forgotPassword');

Route::post('checkUserEmail', [UserauthController::class, 'checkUserEmail'] )->name('user.checkUserEmail'); 
Route::match(['get', 'post'],'resetUserPassword/{token}', 
[UserauthController::class, 'resetUserPassword'])->name('user.resetUserPassword');
Route::post('updatePassword',[UserauthController::class, 'updatePassword'])->name('user.updatePassword');

Route::group(['middleware'=>'checkauth'],function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('user.dashboard'); 
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('editprofile', [UserController::class, 'editprofile'])->name('user.editprofile'); 
    Route::post('updateProfile', [UserController::class, 'updateProfile'])->name('user.updateProfile'); 
    Route::get('add_user', [UserController::class, 'addUser'])->name('user.addUser'); 
    Route::post('saveUser', [UserController::class, 'saveUser'])->name('user.saveUser'); 
    Route::post('checkPhoneNumber', [UserController::class, 'checkPhoneNumber'])->name('user.checkPhoneNumber'); 

    
    Route::get('logout', [UserauthController::class, 'logout'])->name('user.logout');
});


//===============Admin Routes ==============
Route::group(['prefix' =>'admin'],function(){
    Route::get('/', [AdminauthController::class, 'index'])->name('admin.login');
    Route::post('do-login', [AdminauthController::class, 'doLogin'])->name('admin.doLogin');
    
    Route::match(['get', 'post'],'forgotPassword', [AdminauthController::class, 'forgotPassword'])->name('admin.forgotPassword');
    Route::post('checkEmail', [AdminauthController::class, 'checkEmail'] )->name('admin.checkEmail'); 
    Route::match(['get', 'post'],'resetPassword/{token}', 
    [AdminauthController::class, 'resetPassword'])->name('admin.resetPassword');
    Route::post('updatePassword',[AdminauthController::class, 'updatePassword'])->name('admin.updatePassword');

    Route::group(['middleware'=>'adminauth'],function(){
        Route::get('dashboard', [AdmindashboardController::class, 'index'])->name('admin.dashboard'); 
        Route::get('logout', [AdminauthController::class, 'logout'])->name('admin.logout');
    });
 });

 Route::get('/test_email', [HomeController::class, 'mail']);
