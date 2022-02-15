<?php

use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//note that the prefix is admin for all file routs
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['namespace' =>'Dashboard','middleware'=>'auth:admin','prefix'=>'admin'],function(){
            Route::get('/',[DashboardController::class ,'index'])->name('admin.dashboard'); // this frest page admin vister if authintaction
            Route::get('/logout',[LoginController::class , 'logout'])->name('admin.logout');
            Route::group(['prefix'=>'setting'],function (){
                Route::get('shipping-methods/{type}',[SettingsController::class ,'editshippings'])->name('edit.shpping');
                Route::PUT('shipping-methods/{id}',[SettingsController::class ,'updateshippings'])->name('update.shpping');
            });
            Route::group(['prefix'=>'profile'],function (){
                Route::get('edit',[ProfileController::class ,'editprofile'])->name('edit.profile');
                Route::PUT('update',[ProfileController::class ,'updateprofile'])->name('update.profile');
                // Route::PUT('update/password',[ProfileController::class ,'updatepassword'])->name('update.profile.password');
            });
        });

        Route::group(['namespace' =>'Dashboard','middleware'=>'guest:admin'],function(){
            Route::get('login',[LoginController::class , 'login'])->name('admin.login');
            Route::post('login',[LoginController::class , 'postlogin'])->name('admin.postLogin');


        });
    });
